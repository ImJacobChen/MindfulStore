<?php 
/*
|--------------------------------------------------------------------------
| Braintree Config Info
|--------------------------------------------------------------------------
|
| 
|
|
|
*/

Braintree_Configuration::environment(env('BRAINTREE_ENVIRONMENT'));
Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));  