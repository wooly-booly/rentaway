<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(Product $products)
    {
        // ToDo paginate per page to config
        $products = $products->with('trips')->paginate(5);

        return view('products.list', compact('products'));
    }

    public function product($id)
    {
        $product = Product::with(['trips', 'images'])->find($id);

        // if ($product->isEmpty()) {
        //     abort(404);
        // }
// dd($product);
        return view('products.product', compact('product'));
    }
}
