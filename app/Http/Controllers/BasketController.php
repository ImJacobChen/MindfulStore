<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CartItem;
use App\Product;
use Auth;
use Cart;
use DB;

class BasketController extends Controller
{
  /**
   * Return the basket view
   *
   * @return view
   */
  public function index() 
  {
    $cartSubtotal = Cart::total();
    $userCartItems = Cart::content();
    
	  return view('basket.basket', compact('userCartItems', 'cartSubtotal'));
  } 

  /**
   * Update the item quantity in the session and database
   *
   * @param $Request    Request Object
   * 
   * @return redirect
   */
  public function update(Request $request) 
  {
    //Update the session cart
    Cart::update($request->rowid, $request->quantity);

    //Update the database cart
    if (Auth::check() === true) {
      $cartItem = Cart::get($request->rowid);

      CartItem::where('user_id', Auth::user()->id)
              ->where('product_id', $cartItem->id)
              ->update(['quantity' => $request->quantity]);
    }

    //Redirect back to basket
    return redirect('basket');
  }

  /**
   * Remove an item from the basket
   *
   * @param   $request [Request Object]
   *
   * @return redirect
   */
  public function remove(Request $request)
  {
    //Remove the item from the database cart
    if (Auth::check() == true) {
      $sessionCartItem = Cart::get($request->rowid);
      $cartItem = CartItem::where('user_id', Auth::user()->id)
                          ->where('product_id', $sessionCartItem->id)
                          ->delete();
    }

    //Remove the item from the session cart
    Cart::remove($request->rowid);

    return redirect('basket');
  }
}
