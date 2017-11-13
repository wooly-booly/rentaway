<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\TripRequest;
use Session;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(Product $products)
    {
        $products = $products->with('trips')->paginate(10);

        return view('products.list', compact('products'));
    }

    public function product($id)
    {
        $product = Product::with(['trips', 'images'])->findOrFail($id);

        return view('products.product', compact('product'));
    }

    public function store(TripRequest $request)
    {
        $data = $request->only(['trip_start', 'trip_end']);
        $data['product'] = $request->product;

        Session::forget('trip_order');
        Session::push('trip_order', collect($data));

        return redirect()->route('checkout');
    }
}
