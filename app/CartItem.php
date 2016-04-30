<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    /**
     * A Cart Item belongs to a user
     *
     */
    public function user() 
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * A Cart Item represents a product
     *
     */
    public function product() 
    {
        return $this->belongsTo('App\Product');
    }
}
