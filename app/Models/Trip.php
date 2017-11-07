<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'trip_start', 'trip_end'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Trip', 'trip_id', 'id');
    }
}
