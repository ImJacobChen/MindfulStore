<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Braintree_ClientToken;

class BraintreeController extends Controller
{
   public function token() {
        $token = Braintree_ClientToken::generate();

        return response()->json([
            'token' => $token
        ]);
   }
}
