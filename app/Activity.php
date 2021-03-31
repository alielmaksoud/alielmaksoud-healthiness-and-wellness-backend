<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    protected $fillable=['activity'];

    public function user()
    {
        return $this->hasMany(User::class, 'activity_id', 'id');
    }
}

