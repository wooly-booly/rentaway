<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\ProductPresenter;
use Laracasts\Presenter\PresentableTrait;

class Product extends Model
{
    use PresentableTrait;

    protected $presenter = ProductPresenter::class;
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
