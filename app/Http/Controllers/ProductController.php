<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\CartItem;
use Auth;
use Cart;
use Session;

class ProductController extends Controller
{
	/**
     * Return the product view
     *
     * @return view
     */
    public function index() 
    {
		return view('product.product');
	} 

	/**
     * Return the product view with product data
     *
     * @param int                          $id
     *
     * @return view
     */
	public function show($id) 
	{
		$product = Product::findOrFail($id);

		return view('product.product', compact('product'));
	}

	/**
     * Add a product to the session basket and IF LOGGED IN add to the DB basket
     *
     * @param Request object                 $request
     *
     * @return redirect
     */
	public function addToBasket(Request $request) 
	{
		/*
		 * If the user is signed in then update or create
		 * the item in the database
		 */
		if (Auth::check() === true) {
			$id = Auth::user()->id;
			if (CartItem::where(['user_id' => $id, 'product_id' => $request->product_id])->exists()) {
				CartItem::where(['user_id' => $id, 'product_id' => $request->product_id])
							->update(['quantity' => 'value' + $request->quantity]);
			} else {
				CartItem::create([
					'user_id' => $id,
					'product_id' => $request->product_id,
					'quantity' => $request->quantity
				]);
			}
		}
		
		/*
		 * Add the product to the session basket
		 */
		Cart::associate('Product', 'App')->add(array(
			'id' => $request->product_id,
			'name' => $request->product_name,
			'price' => $request->product_price,
			'qty' => $request->quantity
		));

		Session::flash('added_to_basket', 'This item has been added to your basket!');

		return back();
	}
}
