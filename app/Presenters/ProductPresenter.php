<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ProductPresenter extends Presenter
{
    public function price_per_day()
    {
        return '$ ' . $this->price * 24 . ' per day';
    }
}