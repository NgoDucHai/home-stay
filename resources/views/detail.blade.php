@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url({{asset('images/img_bg_11.jpg')}})" data-stellar-background-ratio="0.5">
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
                                    <h2 class="cursive-font white">{{$apartmentDetail->name}}</h2>
                                </div>
                                <p>{{$apartmentDetail->description}}</p>
                                Price: {{$apartmentDetail->price}}<br>
                                Suc Chua: {{$apartmentDetail->capacities->from}} toi {{$apartmentDetail->capacities->to}}<br>
                                Dia chi: <br>
                                <hr>
                                Ten: {{$apartmentDetail->owner->name}}<br>
                                Email: {{$apartmentDetail->owner->email}}
                                <hr>
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#applyModal">Dat phong</button>
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

    <!-- Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Gửi lời nhắn của bạn tới chủ nhà</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="showmessage">
                        <textarea class="form-control" rows="4" name="message" id="message"></textarea>
                        <br>
                        <div class="col-sm-4 col-sm-offset-4">
                            <button class="btn btn-primary btn-block" type="button" id="btn-apply" value="{{$apartmentDetail->id}}">Send</button>
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
@endsection

@section('scripts')
    <script>
        (function() {
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
        })();
    </script>
@stop