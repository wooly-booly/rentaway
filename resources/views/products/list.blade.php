@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @forelse($products as $product)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{ $product->image }}" alt="{{ $product->title }}"  style="width:100%;" />
                    </div>
                    <div class="panel-body">
                        <h3 class="pull-left">
                            <a href="{{ route('product', ['product' => $product->id]) }}"> 
                                {{ $product->title }}
                            </a>
                        </h3>
                        <h3 class="pull-right">{{ $product->present()->price_per_day }}</h3>
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
