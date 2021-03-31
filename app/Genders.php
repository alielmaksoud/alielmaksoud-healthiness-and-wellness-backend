<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genders extends Model
{
    
    protected $fillable=['gender'];

    public function user()
    {
        return $this->hasMany(User::class, 'gender_id', 'id');
    }
}

