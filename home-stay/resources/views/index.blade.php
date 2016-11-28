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
                            <span class="intro-text-small">Hand-crafted by <a href="http://gettemplates.co" target="_blank">Homestay.com.vn</a></span>
                            <h1 class="cursive-font">All in Interesting experiment!</h1>
                        </div>
                        <div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
                            @include('home.searchBox')
                        </div>
                    </div>
                </div>
            </div>
            <div class="gtco-section">
                <div class="gtco-container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center gtco-heading">
                            <h2 class="cursive-font primary-color">Popular Homestay</h2>
                            <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="http://lorempixel.com/640/480/nature/?85684" class="fh5co-card-item image-popup">
                                <figure>
                                    <div class="overlay"><i class="ti-plus"></i></div>
                                    <img src="http://lorempixel.com/640/480/nature/?85684" alt="Image" class="img-responsive">
                                </figure>
                                <div class="fh5co-text">
                                    <h2>Home stay 5</h2>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                                    <p><span class="price cursive-font">$19.15</span></p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="http://lorempixel.com/640/480/nature/?99464" class="fh5co-card-item image-popup">
                                <figure>
                                    <div class="overlay"><i class="ti-plus"></i></div>
                                    <img src="http://lorempixel.com/640/480/nature/?99464" alt="Image" class="img-responsive">
                                </figure>
                                <div class="fh5co-text">
                                    <h2>Home stay 31</h2>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                                    <p><span class="price cursive-font">$20.99</span></p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="http://lorempixel.com/640/480/nature/?92195" class="fh5co-card-item image-popup">
                                <figure>
                                    <div class="overlay"><i class="ti-plus"></i></div>
                                    <img src="http://lorempixel.com/640/480/nature/?92195" alt="Image" class="img-responsive">
                                </figure>
                                <div class="fh5co-text">
                                    <h2>Home stay 52</h2>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                                    <p><span class="price cursive-font">$8.99</span></p>

                                </div>
                            </a>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="http://lorempixel.com/640/480/nature/?66249" class="fh5co-card-item image-popup">
                                <figure>
                                    <div class="overlay"><i class="ti-plus"></i></div>
                                    <img src="http://lorempixel.com/640/480/nature/?66249" alt="Image" class="img-responsive">
                                </figure>
                                <div class="fh5co-text">
                                    <h2>Home stay 12</h2>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                                    <p><span class="price cursive-font">$12.99</span></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="http://lorempixel.com/640/480/nature/?99464" class="fh5co-card-item image-popup">
                                <figure>
                                    <div class="overlay"><i class="ti-plus"></i></div>
                                    <img src="http://lorempixel.com/640/480/nature/?99464" alt="Image" class="img-responsive">
                                </figure>
                                <div class="fh5co-text">
                                    <h2>Home stay 3</h2>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                                    <p><span class="price cursive-font">$23.10</span></p>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="http://lorempixel.com/640/480/nature/?85684" class="fh5co-card-item image-popup">
                                <figure>
                                    <div class="overlay"><i class="ti-plus"></i></div>
                                    <img src="http://lorempixel.com/640/480/nature/?85684" alt="Image" class="img-responsive">
                                </figure>
                                <div class="fh5co-text">
                                    <h2>Home stay 42</h2>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                                    <p><span class="price cursive-font">$5.59</span></p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div id="gtco-features">
                <div class="gtco-container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
                            <h2 class="cursive-font">Our Services</h2>
                            <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="ti-face-smile"></i>
						</span>
                                <h3>Happy People</h3>
                                <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="ti-thought"></i>
						</span>
                                <h3>Creative Culinary</h3>
                                <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="ti-truck"></i>
						</span>
                                <h3>Food Delivery</h3>
                                <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


            <div class="gtco-cover gtco-cover-sm" style="background-image: url(images/img_bg_1.jpg)"  data-stellar-background-ratio="0.5">
                <div class="overlay"></div>
                <div class="gtco-container text-center">
                    <div class="display-t">
                        <div class="display-tc">
                            <h1>&ldquo; Their high quality of service makes me back over and over again!&rdquo;</h1>
                            <p>&mdash; John Doe, CEO of XYZ Co.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="gtco-counter" class="gtco-section">
                <div class="gtco-container">

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
                            <h2 class="cursive-font primary-color">Fun Facts</h2>
                            <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                            <div class="feature-center">
                                <span class="counter js-counter" data-from="0" data-to="5" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">Avg. Rating</span>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                            <div class="feature-center">
                                <span class="counter js-counter" data-from="0" data-to="43" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">Food Types</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                            <div class="feature-center">
                                <span class="counter js-counter" data-from="0" data-to="32" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">Chef Cook</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                            <div class="feature-center">
                                <span class="counter js-counter" data-from="0" data-to="1985" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">Year Started</span>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection