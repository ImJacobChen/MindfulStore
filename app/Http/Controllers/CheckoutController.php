<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
    public function order(Request $request) 
    {
        if (!$request->has('payment_method_nonce')) {

            return redirect('checkout');

        }

        $delivery = $request->input('delivery');

        if ($delivery == "standard") {
            $deliveryPrice = 1.99;
        } elseif ($delivery == "express") {
            $deliveryPrice = 4.99;
        }

        // TODO: Create order in database

        $result = Braintree_Transaction::sale([
            'amount' => Cart::total() + $deliveryPrice,
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => 'true',
            ]
        ]);

        var_dump($result);
        die();
    } 
}
