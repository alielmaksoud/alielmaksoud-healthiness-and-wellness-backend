<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable=['status'];

    public function user()
    {
        return $this->hasMany(User::class, 'status_id', 'id');
    }
}