@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @forelse($products as $product)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="{{ $product->image }}" alt="{{ $product->title }}" /><br/>
                        <h3>
                            <a href="{{ route('product', ['product' => $product->id]) }}"> 
                                {{ $product->title }}
                            </a>
                        </h3><br>
                        {{ $product->present()->price_per_day }}<br>
                    </div>
                </div>
            @empty
                <p>There are no products at this time</p>
            @endforelse
            <p>{{ $products->links() }}</p>
        </div>
    </div>
</div>
@endsection
