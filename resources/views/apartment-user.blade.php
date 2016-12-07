@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url({{asset('images/img_bg_11.jpg')}})" data-stellar-background-ratio="0.5">

        <div class="container view-apartment" style="margin-top:90px; ">
            <hr>
            <div class="well well-sm">
                <strong>Category Title</strong>

                <div class="btn-group">
                    <a href="#" id="list" class="btn btn-default btn-sm" >
                        <span class="glyphicon glyphicon-th-list"></span>
                        List
                    </a>
                    <a href="#" id="grid" class="btn btn-default btn-sm"><span
                                class="glyphicon glyphicon-th"></span>Grid</a>
                </div>

            </div>
            <div id="products" class="row list-group">
                @foreach (json_decode($listApartment,true) as $apartment)
                    <div class="item  col-md-4">
                        <div class="thumbnail">
                            <img class="group list-group-image" src="/upload/{{json_decode($apartment)->images[0]}}" alt="" style="height: 250px; width: 300px;"/>
                            <div class="caption">
                                <h4 class="group inner list-group-item-heading lobster-font text-center" style="color: #FBB448">
                                    {{json_decode($apartment)->name}}</h4>
                                <div class="group inner list-group-item-text crop" style="color: black;">
                                    {{json_decode($apartment)->description}}
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 text-center">
                                        <p class="lead price cursive-font primary-color">
                                            ${{json_decode($apartment)->price}} </p>
                                        <div class="stars_small" data-rating="{{json_decode($apartment)->rate}}"></div><span class=" cursive-font primary-color">{{json_decode($apartment)->totalreview}} review</span>
                                    </div>
                                    <div class="col-xs-12 col-md-6 text-center">
                                        <a  class="btn btn-success" href="/apartment/{{json_decode($apartment)->id}}">View Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </header>

@endsection
@section('scripts')

    <script>
        (function() {
            $('#list').on('click', function (e) {
                e.preventDefault();
                $('#products .item').addClass('list-group-item');
            });
            $('#grid').on('click', function (e){
                e.preventDefault();
                $('#products .item').removeClass('list-group-item');
                $('#products .item').addClass('grid-group-item');
            });

            $('.stars_small').each(function() {
                $(this).raty({
                    readOnly : true,
                    half  : true,
                    score : $(this).attr('data-rating'),
                    space : false,
                    starType: 'i'
                });
            });
        })();
    </script>
@stop
