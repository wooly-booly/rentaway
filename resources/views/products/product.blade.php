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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
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
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('common.errors')
                    </div>
                    <div class="col-md-6">
                        <h2>{{ $product->title }}</h2>
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="col-md-6">
                        <form method="POST">
                            {{ csrf_field() }}
                            <p id="tripDate">
                                <label>Trip start</label><b class="pull-right">{{ $product->present()->price_per_day }}</b><br/>
                                <input type="text" class="date_start" name="date_start" value="{{ old('date_start') }}" />
                                <input type="text" class="time start" name="time_start" value="{{ old('time_start') }}" /><br>
                                <label>Trip end</label><br/>
                                <input type="text" class="date_end" name="date_end" value="{{ old('date_end') }}" />
                                <input type="text" class="time end" name="time_end" value="{{ old('time_end') }}" /><br><br>
                                <button class="btn btn-success">Rent this car</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection