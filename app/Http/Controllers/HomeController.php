<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Product;
use App\CartItem;

use Cart;
use Auth;


class HomeController extends Controller
{
	/**
     * Return the homepage view
     *
     * @return view
     */
    public function index()
    {
    	$artwork = Product::all()->where('product_type', 'artwork');
    	$decals = Product::all()->where('product_type', 'decal');
    	$ornaments = Product::all()->where('product_type', 'ornament');

    	return view('index', compact('artwork', 'decals', 'ornaments'));
    }
}
