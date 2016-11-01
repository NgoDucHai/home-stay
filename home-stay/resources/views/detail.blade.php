@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
        <div class="gtco-container">
            <article id="main-content" style="margin-top: 10em;">
                <div class="row">
                    <div class="col-md-8">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @foreach ($apartmentDetail->images as $k => $image)
                                    @if($k == 0)
                                        <div class="item active">
                                            @else
                                                <div class="item">
                                                    @endif
                                                    <img class="image-slide img-responsive image-edit " src="/upload/{{$image}}" alt="">
                                                    {{--<div class=" carousel-caption">--}}
                                                        {{--<label><input type="checkbox" value="{{$k}}">Xóa ảnh này</label>--}}
                                                    {{--</div>--}}
                                        </div>
                                @endforeach

                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>
                            </div> <!-- Carousel -->
                        </div>
                        <div class="col-md-4">
                            <div class="art-header">
                                <div class="entry-title">
                                    <h2>{{$apartmentDetail->name}}</h2>
                                </div>
                                <p>{{$apartmentDetail->description}}</p>
                                Price: {{$apartmentDetail->price}}<br>
                                Suc Chua: {{$apartmentDetail->capacities->from}} toi {{$apartmentDetail->capacities->to}}<br>
                                Dia chi: <br>
                                <hr>
                                Ten: {{$apartmentDetail->owner->name}}<br>
                                Email: {{$apartmentDetail->owner->email}}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p class="excerpt center">This is a well that is a great spot for a business tagline or phone number for easy access!</p>
                    </div>
                </div>
            </article>

        </div>
        <br>
    </header>
@endsection

