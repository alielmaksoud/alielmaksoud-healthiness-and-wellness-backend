<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=[
        'user_id',
    ];
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function cartItem()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }

}