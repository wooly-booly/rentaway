<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $timestamps = false;
    protected $table = 'product_image';
    
    protected $fillable = [
        'product_id', 'image', 'position'
    ];
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
