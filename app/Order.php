<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'hash',
    	'total',
    	'paid',
    	'address_id',
    ];

    public function address() {
    	return $this->belongsTo('App\Address');
    }

    public function products() {
    	return $this->belongsToMany('App\Product', 'order_items')->withPivot('quantity');
    }

    public function payment() {
        return $this->hasOne('App\Payment');
    }
}
