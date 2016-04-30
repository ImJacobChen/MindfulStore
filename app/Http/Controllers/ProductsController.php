<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Http\Requests;
use App\Http\Requests\RefineItemsRequest;
use App\Http\Controllers\Controller;
use DB;

class ProductsController extends Controller
{
	/**
     * Return the products view
     *
     * @return view
     */
    public function index() 
    {
    	$products = Product::all();

		return view('products.products', compact('products'));
	} 

	/**
     * Gets the products matching the refine arguments
     *
     * @param Object $request [Request Object]
     * 
     * @return view partial
     */
	public function refine(Request $request) 
	{	
		$query = DB::table('products');

		//Refine Types
		if (isset($_GET['refineArguments'])){
			$productTypes = $_GET['refineArguments'];
			$query->whereIn('product_type', $productTypes);
		}

		//Min Price
		$minPrice = $_GET['minPrice'];
		if (intval($minPrice) && $minPrice != "")
			$query->where('price', '>=', $minPrice);
		
		//MaxPrice
		$maxPrice = $_GET['maxPrice'];
		if (intval($maxPrice) && $maxPrice != "")
			$query->where('price', '<=', $maxPrice);

		//Sort By
		$s = $_GET['sortBy'];
		switch ($s) {
			case 'price-low-to-high':
				$query->orderBy('price', 'asc');
				break;
			
			case 'price-high-to-low':
				$query->orderBy('price', 'desc');
				break;

			case 'newest-items-first':
				$query->orderBy('created_at', 'asc');
				break;

			case 'oldest-items-first':
				$query->orderBy('created_at', 'desc');
				break;

			default:
				# code...
				break;
		}

		$products = $query->get();

		return view('products.refinedProducts', compact('products'));
	}
}
