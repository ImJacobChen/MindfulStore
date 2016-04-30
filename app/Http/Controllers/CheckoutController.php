<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cart;
use App\Paypal;
use App\Order;

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
     * Create a new order class and direct the user
     * to the checkout review page
     *
     * @return \Illuminate\Http\Response
     */
    public function review(Request $request)
    {   
        $messages = [
          'delivery-postcode.required' => 'We need a postcode!',
          'delivery-first-name.required' => 'We need your first name!',
          'delivery-last-name.required' => 'We need your last name!',
          'delivery-address-line-1.required' => 'We need the 1st line of your address!',
          'delivery-town-city.required' => 'We need a town or city!',
          'delivery-country.required' => 'We need to know your country!',
          'delivery-phone.required' => 'Please enter a phone number',
          'delivery-email.required' => 'Please enter an email address.',

          'billing-postcode.required_unless' => 'We need a billing postcode if its different from your delivery address.',
          'billing-first-name.required_unless' => 'We need your first name if its different from your delivery address.',
          'billing-last-name.required_unless' => 'We need your last name if its different from your delivery address.',
          'billing-address-line-1.required_unless' => 'We need the 1st line of your address if its different from your delivery address.',
          'billing-town-city.required_unless' => 'We need a town or city if its different from your delivery address.',
          'billing-country.required_unless' => 'We need to know your country if its different from your delivery address.',
          'billing-phone.required_unless' => 'Please enter a phone number if its different from your delivery address.',
          'billing-email.required_unless' => 'Please enter an email address if its different from your delivery address.',
        ];

        $validator = Validator::make($request->all(), [
          'delivery-postcode' => 'required',
          'delivery-first-name' => 'required',
          'delivery-last-name' => 'required',
          'delivery-address-line-1' => 'required',
          'delivery-address-line-2' => '',
          'delivery-town-city' => 'required',
          'delivery-country' => 'required',
          'delivery-phone' => 'required|integer',
          'delivery-email' => 'required|email',
          'billing-address-same' => '',
          'billing-postcode' => 'required_unless:billing-address-same,true',
          'billing-first-name' => 'required_unless:billing-address-same,true',
          'billing-last-name' => 'required_unless:billing-address-same,true',
          'billing-address-line-1' => 'required_unless:billing-address-same,true',
          'billing-address-line-2' => '',
          'billing-town-city' => 'required_unless:billing-address-same,true',
          'billing-country' => 'required_unless:billing-address-same,true',
          'billing-phone' => 'required_unless:billing-address-same,true|integer',
          'billing-email' => 'required_unless:billing-address-same,true|email',
          'delivery-type' => '',
        ], $messages);
        
        if ($validator->fails()) {
          return redirect('checkout/details/#errors')
                      ->withErrors($validator)
                      ->withInput();
        }
      

        $order = new Order($request->all());
        $userCartItems = Cart::content();
        $cartSubtotal = Cart::total();

        return view('checkout.review', compact('order', 'userCartItems', 'cartSubtotal'));
    }

    public function paypalReview()
    {
        if( isset($_GET['token']) && !empty($_GET['token']) ) { // Token parameter exists
           // Get checkout details, including buyer information.
           // We can save it for future reference or cross-check with the data we have
           $paypal = new Paypal();
           $checkoutDetails = $paypal -> request('GetExpressCheckoutDetails', array('TOKEN' => $_GET['token']));

           // Complete the checkout transaction
           /*$requestParams = array(
               'TOKEN' => $_GET['token'],
               'PAYMENTACTION' => 'Sale',
               'PAYERID' => $_GET['PayerID'],
               'PAYMENTREQUEST_0_AMT' => '500', // Same amount as in the original request
               'PAYMENTREQUEST_0_CURRENCYCODE' => 'GBP' // Same currency as the original request
           );

           $response = $paypal -> request('DoExpressCheckoutPayment',$requestParams);
           if( is_array($response) && $response['ACK'] == 'Success') { // Payment successful
               // We'll fetch the transaction ID for internal bookkeeping
               $transactionId = $response['PAYMENTINFO_0_TRANSACTIONID'];
           }*/
        }

        return view('checkout.paypal-review', compact('checkoutDetails'));
    }

    /**
     * Set up the paypal express checkout and redirect
     * to the paypal checkout
     */
    public function setExpressCheckout() 
    {   
        function array_push_assoc(&$array, $key, $value){
            $array[$key] = $value;
            return $array;
        }

        $cartItems = Cart::content();

        //Request parameters
        $requestParams = array(
            'RETURNURL' => 'http://mindfullness.app/checkout/paypalReview',
            'CANCELURL' => 'http://mindfullness.app/checkout/review'
        );

        $orderParams = array(
            'PAYMENTREQUEST_0_AMT' => '500',
            'PAYMENTREQUEST_0_SHIPPINGAMT' => '4',
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'GBP',
            'PAYMENTREQUEST_0_ITEMAMT' => '496',
        );

        $item = array(
            'L_PAYMENTREQUEST_0_NAME0' => 'iPhone',
            'L_PAYMENTREQUEST_0_DESC0' => 'White iPhone, 16GB',
            'L_PAYMENTREQUEST_0_AMT0' => '496',
            'L_PAYMENTREQUEST_0_QTY0' => '1',
        );

        $paypal = new Paypal();
        $response = $paypal -> request('SetExpressCheckout', $requestParams + $orderParams + $item);
        
        if(is_array($response) && $response['ACK'] == 'Success') { //Request Successful
            $token = $response['TOKEN'];
            header( 'Location: https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . urlencode($token) );
        }
    }
}
