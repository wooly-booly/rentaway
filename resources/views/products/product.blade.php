@extends('layouts.app')

@push('js')
    <script src="/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="/js/libs/timepicker/jquery.timepicker.min.js"></script>
    <script>
        $('#tripDate .time').timepicker({
            'timeFormat': 'h:i A',
            'disableTextInput': true,
            'step': 60,
        });

        var dateParams = {
            'format': "D, M dd, yyyy",
            'autoclose': true,
            'endDate': '+1y',
            'startDate': '0'
        };

        $('#tripDate .date_start').datepicker(dateParams);
        dateParams.startDate = '+1d';
        $('#tripDate .date_end').datepicker(dateParams);
    </script>
@endpush

@push('css')
    <link rel="stylesheet" type="text/css" href="/js/libs/bootstrap-datepicker/bootstrap-datepicker3.css">
    <link rel="stylesheet" type="text/css" href="/js/libs/timepicker/jquery.timepicker.min.css">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div id="productImageCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" style="width:100%;">
                </div>

                @foreach($product->images as $item)
                <div class="item">
                    <img src="{{ $item->image }}" alt="{{ $product->title }}" style="width:100%;">
                </div>
                @endforeach
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#productImageCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#productImageCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="row">
        <div>
            <h3>{{ $product->title }}</h3>
            <p>{{ $product->description }}</p>
            <p>{{ $product->present()->price_per_day }}</p>
        </div>
        <div>
            <p id="tripDate">
                <input type="text" class="date_start" />
                <input type="text" class="time start" /><br>
                <input type="text" class="date_end"/>
                <input type="text" class="time end" />
            </p>
        </div>
    </div>
</div>
@endsection