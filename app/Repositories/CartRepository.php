<?php

namespace App\Repositories;

use App\Cart;
use App\Http\Controllers\Auth;

class CartRepository implements CartRepositoryInterface
{
    public function display()
    {
        $id = auth()->user()->id;
        return $carts = Cart::where('user_id',$id)->first();
    }
 
    public function view($id)
    {
        return Cart::where('id', $id)->first();
    }
 
}