<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'trip_id', 'comment', 'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function trip()
    {
        return $this->hasOne('App\Models\Trip', 'id', 'trip_id');
    }
}
