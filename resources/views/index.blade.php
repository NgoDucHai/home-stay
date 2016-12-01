@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url({{asset('images/img_bg_11.jpg')}})" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="gtco-container">
            <div class="row">
                <div class="col-md-12 col-md-offset-0 text-left">
                    <div class="row row-mt-10em">
                        <div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
                            <span class="intro-text-small">What happens here, <a href="http://gettemplates.co" target="_blank">stay here!</a></span>
                            <h1 class="cursive-font">Welcome to Vietnam</h1>
                        </div>
                        <div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
                            @include('home.searchBox')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
        <div class="gtco-section">
            <div class="gtco-container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center gtco-heading">
                        <h2 class="lobster-font primary-color">Homestay nổi bật</h2>
                        <p>Các homestay nhận được nhiều ưa thích nhất của chúng tôi</p>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="http://www.trekkingsapa.com/wp-content/uploads/2015/12/TrekkingSapa-Sapa-village6.gif" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="http://www.trekkingsapa.com/wp-content/uploads/2015/12/TrekkingSapa-Sapa-village6.gif" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Anh Duc Homestay</h2>
                                <p>“Bữa sáng ngon, cafe cực ngon, sạch sẽ, cô chủ vui tính, nhiệt tình thân thiện”</p>
                                <p><span class="price cursive-font">$12.00</span></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="http://tourconduongdisan.com/upload/images/09-2013/chan-trau.jpg" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="http://tourconduongdisan.com/upload/images/09-2013/chan-trau.jpg" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Ta Van Homestay</h2>
                                <p>“Chủ nhà thân thiện, nhiệt tình, lại xinh gái nữa :)”</p>
                                <p><span class="price cursive-font">$20.00</span></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="https://media.foody.vn/images/14344137_1082406465200414_769386240260327604_n.jpg" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="https://media.foody.vn/images/14344137_1082406465200414_769386240260327604_n.jpg" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Muong Hoa</h2>
                                <p>“Không khí trong lành, mát mẻ và mọi người thân thiện. Giúp đỡ những du khách tốt.”</p>
                                <p><span class="price cursive-font">$8.00</span></p>

                            </div>
                        </a>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="http://static.thanhnien.com.vn/uploaded/minhnguyet/2016_06_16/homestay3_cedg.jpg?width=1600&encoder=wic&subsampling=444" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="http://static.thanhnien.com.vn/uploaded/minhnguyet/2016_06_16/homestay3_cedg.jpg?width=1600&encoder=wic&subsampling=444" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Minh Beo</h2>
                                <p>“Thích anh chủ , thích những chú cún xung quanh và chú mèo diner :D”</p>
                                <p><span class="price cursive-font">$12.99</span></p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="http://static.thanhnien.com.vn/uploaded/minhnguyet/2016_06_16/homestay1_jmnq.jpg?width=1600&encoder=wic&subsampling=444" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="http://static.thanhnien.com.vn/uploaded/minhnguyet/2016_06_16/homestay1_jmnq.jpg?width=1600&encoder=wic&subsampling=444" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Hoang Kim Homestay</h2>
                                <p>“Feels peaceful listening to the stream and enjoying the beautiful view.”</p>
                                <p><span class="price cursive-font">$23.00</span></p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="http://blog.vietfuntravel.com.vn/wp-content/uploads/2013/07/nhung-kinh-nghiem-bo-ich-khi-du-lich-homestay.jpg" class="fh5co-card-item image-popup">
                            <figure>
                                <div class="overlay"><i class="ti-plus"></i></div>
                                <img src="http://blog.vietfuntravel.com.vn/wp-content/uploads/2013/07/nhung-kinh-nghiem-bo-ich-khi-du-lich-homestay.jpg" alt="Image" class="img-responsive">
                            </figure>
                            <div class="fh5co-text">
                                <h2>Home stay 42</h2>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                                <p><span class="price cursive-font">$5.00</span></p>
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
                        <h2 class="lobster-font">Dịch vụ của chúng tôi</h2>
                        <p class="tinos-font">Mang khách du lịch tới gần hơn với những trải nhiệm thực sự thú vị ở Việt Nam <br>
                        Mang homestay của Việt Nam vươn ra thé giới</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="feature-center animate-box" data-animate-effect="fadeIn">
                    <span class="icon">
                        <i class="ti-face-smile"></i>
                    </span>
                            <h3>Mang đến niềm vui</h3>
                            <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="feature-center animate-box" data-animate-effect="fadeIn">
                    <span class="icon">
                        <i class="ti-thought"></i>
                    </span>
                            <h3>Trải nhiệm</h3>
                            <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="feature-center animate-box" data-animate-effect="fadeIn">
                    <span class="icon">
                        <i class="ti-truck"></i>
                    </span>
                            <h3>Chỉ dẫn tận tình</h3>
                            <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="gtco-cover gtco-cover-sm" style="background-image: url({{asset('images/img_bg_13.jpg')}})"  data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="gtco-container text-center">
                <div class="display-t">
                    <div class="display-tc">
                        <h2 class="lobster-font" style="font-size: 40px;">&ldquo; Không ngừng nâng cao chất lượng dịch vụ, tạo trải nhiệm tuyệt với nhất cho khách hàng!&rdquo;</h2>
                        <p>&mdash; Hai, homestay.vn </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="gtco-counter" class="gtco-section">
                <div class="gtco-container">

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
                            <h2 class="lobster-font primary-color">Những điều thú vị</h2>
                            <p>Những thống kê của chúng tôi và chúng đang không ngừng phát triển mạnh mẽ.</p>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                            <div class="feature-center">
                                <span class="counter js-counter" data-from="0" data-to="46" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">Homestay</span>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                            <div class="feature-center">
                                <span class="counter js-counter" data-from="0" data-to="33" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">User</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                            <div class="feature-center">
                                <span class="counter js-counter" data-from="0" data-to="59" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">Review</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                            <div class="feature-center">
                                <span class="counter js-counter" data-from="0" data-to="1985" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">View</span>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

@endsection