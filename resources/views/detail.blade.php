@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url({{asset('images/img_bg_11.jpg')}})" data-stellar-background-ratio="0.5">
        <div class="gtco-container">
            <article id="main-content" style="margin-top: 7em;">
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
                                <div class="text-center">
                                    <img class="img-circle img-responsive img-center" src="/upload/avatars/{{$apartmentDetail->owner->avatar}}" alt="">
                                    <h3 class="white">{{$apartmentDetail->owner->name}}
                                    </h3>
                                    <span class="price cursive-font primary-color">${{$apartmentDetail->price}}</span>
                                    <div class="ratings primary-color">
                                        <p class="pull-right">{{$apartmentDetail->totalreview}} reviews</p>
                                        <p>
                                        <div class="stars_small" data-rating="{{$apartmentDetail->rate}}"></div>
                                        </p>
                                    </div>
                                    <p>{{$apartmentDetail->owner->description}}</p>
                                </div>

                                {{--<ul class="list-unstyled contact-list white">--}}
                                    {{--<li class="email"><i class="fa fa-envelope"></i><a href="mailto: yourname@email.com">alan.doe@website.com</a></li>--}}
                                    {{--<li class="phone"><i class="fa fa-phone"></i><a href="tel:0123 456 789">0123 456 789</a></li>--}}
                                    {{----}}
                                {{--</ul>--}}
                                {{--<p>{{$apartmentDetail->description}}</p>--}}
                                {{--Price: {{$apartmentDetail->price}}<br>--}}
                                {{--Suc Chua: {{$apartmentDetail->capacities->from}} toi {{$apartmentDetail->capacities->to}}<br>--}}
                                {{--Dia chi: <br>--}}
                                {{--<hr>--}}
                                {{--Ten: {{$apartmentDetail->owner->name}}<br>--}}
                                {{--Email: {{$apartmentDetail->owner->email}}--}}
                                {{--<hr>--}}
                                <button type="button" class="btn btn-primary btn-block tinos-font" data-toggle="modal" data-target="#applyModal">Đặt phòng</button>
                            </div>

                        </div>
                    </div>
                </div>
                <hr>
            </article>
        </div>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row"><br>
                    <div class="col-sm-8">
                        <h2 class="lobster-font"> {{$apartmentDetail->name}}</h2>
                        <p>{{$apartmentDetail->description}}</p>
                        <div class="row review">
                            @if ($apartmentDetail->review)
                                @foreach ($apartmentDetail->review as $r => $review)
                                    <div class="col-sm-2">
                                        <div class="thumbnail">
                                            <img class="img-responsive user-photo" src="/upload/avatars/{{$review->user->avatar}}">
                                        </div><!-- /thumbnail -->
                                    </div><!-- /col-sm-1 -->

                                    <div class="col-sm-10">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <strong>{{$review->user->name}}</strong>
                                                <span>{{ date('F d, Y', strtotime($review->user->created_at)) }}</span>
                                                <div class="stars_small pull-right" data-rating="{{$review->rate}}"></div>
                                            </div>
                                            <div class="panel-body">
                                                {{$review->comment}}
                                            </div><!-- /panel-body -->
                                        </div><!-- /panel panel-default -->
                                    </div><!-- /col-sm-5 -->
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary btn-block tinos-font" data-toggle="modal" data-target="#reviewModal">Review</button>
                    </div>
                    <div class="col-sm-4">
                        <h2 class="lobster-font">Liên hệ</h2>
                        <address>
                            <i class="fa fa-user" aria-hidden="true"></i> : <strong>{{$apartmentDetail->owner->name}}</strong>
                            <br><i class="fa fa-history" aria-hidden="true"></i> : {{$apartmentDetail->owner->age}}
                            <br><i class="fa fa-phone" aria-hidden="true"></i> :</abbr>{{$apartmentDetail->owner->phone}}
                            <br><i class="fa fa-envelope" aria-hidden="true"></i>:</abbr> <a href="mailto:#">{{$apartmentDetail->owner->email}}</a>
                            <br><i class="fa fa-location-arrow" aria-hidden="true"></i> : Beverly Hills, CA 90210
                            <br>
                        </address>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center lobster-font" id="myModalLabel">Gửi lời nhắn của bạn tới chủ nhà</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="showmessage">
                            <br style="clear:both">
                            <div class="form-group ">
                                <textarea class="form-control input-sm "  name="message"  id="message" placeholder="Message" maxlength="140" rows="7"></textarea>
                                <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
                            </div>
                            <br style="clear:both">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-primary btn-block " id="btn-apply" value="{{$apartmentDetail->id}}" name="btnSubmit" type="button" style="height:35px"> Send</button>
                            </div>
                        <div class="clearfix"></div>
                    </form>
                    <div class="success">
                        <h2 class="cursive-font text-center" style="color: springgreen">Congratulations!</h2> <br>
                        <div style="width: 150px;" class="col-md-4 col-md-offset-4">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 98.5 98.5" enable-background="new 0 0 98.5 98.5" xml:space="preserve">
                                <path stroke-miterlimit="10" d="M81.7,17.8C73.5,9.3,62,4,49.2,4
                            C24.3,4,4,24.3,4,49.2s20.3,45.2,45.2,45.2s45.2-20.3,45.2-45.2c0-8.6-2.4-16.6-6.5-23.4l0,0L45.6,68.2L24.7,47.3"/>
                            </svg>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center lobster-font" id="myModalLabel">Nhận xét đáng giá của bạn về {{$apartmentDetail->name}}</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="showReview">
                        <div id="rating"></div>
                        <br style="clear:both">
                        <div class="form-group ">
                            <textarea class="form-control input-sm "  name="comment"  id="comment" placeholder="Comment" maxlength="140" rows="7"></textarea>
                            <span class="help-block"><p id="characterLeft1" class="help-block ">You have reached the limit</p></span>
                        </div>
                        <br style="clear:both">
                        <div class="col-sm-4 col-sm-offset-4">
                            <button class="btn btn-primary btn-block" type="button" id="btn-review" value="{{$apartmentDetail->id}}">Send</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        (function() {

            $('#rating').raty({
                starType: 'i'
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

            $('.success').hide();
            $("#btn-apply").click(function(e){
                e.preventDefault();
                var apartmentId = $(this).val();
                var message = $('#message').val();
                $.ajax({type: "POST",
                    url: "/application",
                    data: {
                        apartmentId: apartmentId ,
                        message: message
                    },
                    success:function(data) {
                        $('#showmessage').hide(500);
                        $('.success').show(500);
                    }
                });
            });
            $("#btn-review").click(function(e){
                e.preventDefault();
                var rate = $('#rating').raty('score');
                var apartmentId = $(this).val();
                var comment = $('#comment').val();
                $.ajax({type: "POST",
                    url: "/review",
                    data: {
                        apartmentId : apartmentId ,
                        comment     : comment,
                        rate        : rate
                    },
                    success:function(data) {
                        $('#reviewModal').modal('hide');
                        location.reload();
                    }
                });
            });
            $('#characterLeft').text('140 characters left');
            $('#message').keyup(function () {
                var max = 140;
                var len = $(this).val().length;
                if (len >= max) {
                    $('#characterLeft').text('You have reached the limit');
                    $('#characterLeft').addClass('red');
                }
                else {
                    var ch = max - len;
                    $('#characterLeft').text(ch + ' characters left');
                    $('#characterLeft').removeClass('red');
                }
            });
            $('#characterLeft1').text('140 characters left');
            $('#comment').keyup(function () {
                var max = 140;
                var len = $(this).val().length;
                if (len >= max) {
                    $('#characterLeft1').text('You have reached the limit');
                    $('#characterLeft1').addClass('red');
                }
                else {
                    var ch = max - len;
                    $('#characterLeft1').text(ch + ' characters left');
                    $('#characterLeft1').removeClass('red');
                }
            });
        })();
    </script>
@stop