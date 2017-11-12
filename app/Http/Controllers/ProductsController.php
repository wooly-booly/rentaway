<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreTripRequest;

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
        $product = Product::with(['trips', 'images'])->findOrFail($id);

        return view('products.product', compact('product'));
    }

    public function store(StoreTripRequest $request)
    {
        $data = $request->all();

        dd($data);
    }
}
