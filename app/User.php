<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\CartItem;
use Cart;
use Auth;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     *
     */
    public function cartItems()
    {
        return $this->hasMany('App\CartItem');
    }

    /**
     * 
     */
    public function orders() 
    {
        return $this->hasMany('App\Order');
    }

    /**
     * [syncCarts description]
     * @return [type] [description]
     */
    public function syncCarts()
    {   
        $userId = Auth::user()->id;
        /**
         * Array of product_id's of the items stored in the session cart
         * 
         * @var [type]
         */
        $sessionItems = Cart::content()->pluck('id')->toArray();

        /**
         * Array of product_id's of the items stored in the database cart
         * 
         * @var array
         */
        $databaseItems = Auth::user()->cartItems()->get()->pluck('product_id')->toArray();
        
        /**
         * Product IDs of items in both Session and Database cart
         * 
         * @var array
         */
        $sessionAndDatabaseItems = array_intersect($databaseItems, $sessionItems);
        /**
         * Loop through each of the intersecting database and session items 
         * and update the database product quantity(s) with 
         * the session product quantity(s)
         */
        foreach($sessionAndDatabaseItems as $item) 
        {
            CartItem::where('product_id', $item)
                    ->where('user_id', $userId)
                    ->update(['quantity' => Cart::get(Cart::search(['id' => $item])[0])->qty]);
        }

        /**
         * Product IDs of items only in the database cart
         * 
         * @var array
         */
        $justDatabaseItems = array_diff($databaseItems, $sessionItems);
        //If item is in DB and NOT in SESSION, add to session basket
        //-Add to session basket with 'From your last session' option
        /**
         * Loop through the array of product_ids that are only in the database 
         * cart, find these items in the users database cart along with the
         * corresponding products and then add them to the session cart.
         */
        foreach($justDatabaseItems as $item)
        {
            $cartItem = CartItem::where('product_id', $item)
                                ->where('user_id', $userId)
                                ->get();

            $product = Product::find($item);
    
            Cart::associate('Product', 'App')->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $cartItem[0]->quantity,
                'options' => array('from-last-session' => true)
            ));
        }
        
        
        /**
         * Product IDs of items only in the session cart
         * 
         * @var array
         */
        $justSessionItems = array_diff($sessionItems, $databaseItems);
        /**
         * Loop through the items only in the session cart and
         * add them to the database cart.
         */
        foreach($justSessionItems as $item)
        {
            CartItem::create(
                ['user_id' => $userId,
                 'product_id' => $item,
                 'quantity' => Cart::get(Cart::search(['id' => $item])[0])->qty
                ]
            );
        }

    }
}
