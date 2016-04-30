<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AccountController extends Controller
{
    /**
     * Returns either the account view or the signin view
     *
     * @return view
     */
    public function index()
    {
        if (Auth::check()) {
            return view('account.account');
        } else {
            return view('auth.signin');
        }
    }
}
