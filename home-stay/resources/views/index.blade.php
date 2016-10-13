@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="gtco-container">
            <div class="row">
                <div class="col-md-12 col-md-offset-0 text-left">
                    <div class="row row-mt-10em">
                        <div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
                            <span class="intro-text-small">Hand-crafted by <a href="http://gettemplates.co" target="_blank">GetTemplates.co</a></span>
                            <h1 class="cursive-font">All in good taste!</h1>
                        </div>
                        <div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
                            @include('home.searchBox')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection