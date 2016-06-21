<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $quantity = null;

	public function order()
	{
		return $this->belongsToMany('App\Order', 'order_items')->withPivot('quantity');
	}
}
