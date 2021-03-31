<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    protected $fillable =['name', 'description', 'image','date','url', 'is_event', 'is_program','is_class','is_blog','category_id'];

    public function cartItem()
    {
        return $this->hasMany(CartItem::class, 'item_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
}
