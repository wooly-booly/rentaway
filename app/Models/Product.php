<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'price'
    ];

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function trips()
    {
        return $this->hasMany('App\Models\Trip');
    }
}
