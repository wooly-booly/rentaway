@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>CHECKOUT</h2>
                </div>
                <div class="panel-body">
                    <div>
                        @include('common.errors')
                        @include('common.success')
                    </div>
                    @if (!empty($order))
                        <h3>Payment info</h3>
                        <p><b>Trip Start: </b> {{ $order['trip_start'] }}</p>
                        <p><b>Trip End: </b> {{ $order['trip_end'] }}</p>
                        <p><b>Trip Hours: </b> {{ $order['trip_hours'] }}</p>
                        <p><b>Price per hour: </b> $ {{ $order['product']['price'] }}</p><hr />
                        <p><b>TOTAL PRICE: </b> $ {{ $order['total_price'] }}</p>
                        <hr />
                        <form action="{{ route('checkout.confirm') }}" method="POST">
                            {{ csrf_field() }}
                            <p>                        
                                <label class="checkbox-inline" for="terms">
                                    <input name="terms" id="terms" value="1" type="checkbox">
                                    I agree to pay the total shown, to the Turo terms of service and cancellation policy, and authorize Turo to obtain my auto insurance score.
                                </label>    
                            </p>

                            <button class="btn btn-success">Submit Payment</button>                         
                        </form>
                    @else
                        <p>No order to checkout.</p>
                    @endif
                </div>
            </div>
        </div>
        @if (!empty($order))
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>{{ $order['product']['title'] }}</h2>
                </div>
                <div class="panel-body">
                    <img src="{{ $order['product']['image'] }}" alt="{{ $order['product']['title'] }}" style="width:100%;">
                    <h3>TRIP SUMMARY: $ {{ $order['total_price'] }}</h3>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
