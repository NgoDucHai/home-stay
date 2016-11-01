@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="gtco-container" id="listApartment" data-apartment="{{$listApartment}}">
            <div id='map' style="height: 500px;top:85px; "></div>
            <div id='info' class='info'></div>
        </div>
        <br>
    </header>

@endsection
@section('scripts')

    <!-- Map -->
    <script src="{{asset('js/map.js')}}"></script>
@stop
