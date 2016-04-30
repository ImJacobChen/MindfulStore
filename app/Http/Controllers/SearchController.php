<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use DB;

class SearchController extends Controller
{
	/**
     * Return the search view
     *
     * @return view
     */
	public function index() {
		return view('search.search');
	}

	/**
     * Return the search view with search results
     *
     * @param object $request [Request Object]
     * 
     * @return view
     */
	public function search(Request $request) {
		$s = $request->input('s');
		$products = DB::table('products')->where('name', 'like', '%' . $s . '%')->get();

		return view('search.search', compact('s', 'products'));
	}
}
