<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable =[
        'category_name',
        'description',
    ];
    public function item()
    {
        return $this->hasMany(Item::class, 'category_id', 'id');
    }
    public function event()
    {
        return $this->hasMany(Events::class, 'category_id', 'id');
    }
}