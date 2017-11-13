<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutConfirmRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\Trip;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(Request $request)
    {
        $order = $this->getOrderInfo($request);
       
        return view('checkout.checkout', compact('order'));
    }

    public function confirm(CheckoutConfirmRequest $request, Order $order, Trip $trip)
    {
        $data = $this->getOrderInfo($request);

        DB::transaction(function() use ($order, $trip, $data, $request) {
            $trip->fill([
                'product_id' => $data['product']['id'],
                'trip_start' => new Carbon($data['trip_start']),
                'trip_end' => new Carbon($data['trip_end']),
            ])->save();

            $order->fill([
                'user_id' => $request->user()->id,
                'trip_id' => $trip->id,
                'total' => $data['total_price'],
            ])->save();

            $request->session()->forget('trip_order');
            $request->session()->flash('success', 
                'Trip order (' . $data['trip_start'] . ' - ' . $data['trip_end'] . ') created successfully!'
            );
        });

        return back();
    }

    private function getOrderInfo(Request $request)
    {
        $order = [];

        if ($request->session()->has('trip_order')) {
            $order = $request->session()->get('trip_order')[0]->all();
            $product = Product::findOrFail($order['product']);    
            $tripStart = new Carbon($order['trip_start']);
            $tripEnd = new Carbon($order['trip_end']);
            $order['trip_hours'] = $tripStart->diffInHours($tripEnd);     
            $order['total_price'] = $product->price * $order['trip_hours'];
            $order['product'] = $product->toArray();
        }

        return $order;
    }
}
