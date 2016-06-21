<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Event;
use App\Events\OrderWasCreated;
use App\Events\OrderFailed;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Address;
use App\Order;
use App\Product;
use Braintree_Transaction;
use Cart;

class CheckoutController extends Controller
{
	/**
     * Direct the user to the checkout details
     * page
     *
     * @return view
     */
    public function index(Request $request) 
    {
    	$userCartItems = Cart::content();
    	$cartTotal = Cart::total();

		  return view('checkout.details', compact('userCartItems', 'cartTotal')); 
	}

    /**
      * 
      */
    public function order(Request $request, Customer $customer, Address $address, Cart $cart) 
    {
        if (!$request->has('payment_method_nonce')) {
            return redirect('checkout');
        }

        //TODO: Validation

        $delivery = $request->input('delivery');

        if ($delivery == "standard") {
            $deliveryPrice = 1.99;
        } elseif ($delivery == "express") {
            $deliveryPrice = 4.99;
        }

        $hash = bin2hex(random_bytes(32));

        $customer = $customer->firstOrCreate([
          'email' => $request->input('email'),
          'name' => $request->input('name'),
        ]);

        $address = $address->firstOrCreate([
          'address1' => $request->input('address1'),
          'address2' => $request->input('address2'),
          'city' => $request->input('city'),
          'postal_code' => $request->input('postal_code'),
          'country' => $request->input('country'),
        ]);

        $order = $customer->orders()->create([
          'hash' => $hash,
          'paid' => false,
          'total' => Cart::total() + $deliveryPrice,
          'address_id' => $address->id,
        ]);
        


        $content = Cart::content();

        $products = [];
        $quantitys = [];
        foreach ($content as $row) {
          $products[] = $row->product;
          $quantitys[] = ['quantity' => $row->qty];
        }

        $order->products()->saveMany($products, $quantitys);


        $result = Braintree_Transaction::sale([
            'amount' => Cart::total() + $deliveryPrice,
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => 'true',
            ]
        ]);

        if ($result->success == false) {
          Event::fire(new OrderFailed($order));

          return redirect('checkout')->with('error_message', 'Your payment failed :(. Please contact us or try again.');
        }

        Event::fire(new OrderWasCreated($order, $result->transaction->id));

        return redirect()->route('checkout.summary', $order->hash);
    }

    public function summary($hash, Request $request, Order $order) 
    {
      $order = $order->with(['address', 'products'])->where('hash', $hash)->first();

      if (!$order) {
        return redirect('/')->with('error_message', 'That order does not exist.');
      }

      return view('checkout.summary', compact('order'));
    } 
}
