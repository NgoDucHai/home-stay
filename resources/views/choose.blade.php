@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url({{asset('images/img_bg_11.jpg')}})" data-stellar-background-ratio="0.5">
        <div class="gtco-container">
            <article id="main-content" style="margin-top: 10em;">

                <div class="container">
                    <div class="panel panel-info">
                        <div class="panel-heading border-none" style="background: #FBB448">
                            <p class="panel-title text-center white cursive-font">{{ $user->name }}'s Request</p>
                        </div>
                        <div class="panel-body border-none form-wrap-profile">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 " align="center">
                                    <img alt="User Pic" src="/upload/avatars/{{ $user->avatar }}" class="img-circle img-responsive">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Tên</td>
                                            <td>{{ $user->name }}</td>
                                        </tr >
                                        <tr>
                                            <td>Tuổi: </td>
                                            <td>{{ $user->age }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email: </td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                        </tr>

                                        <tr>
                                        <tr>
                                            <td>Số điện thoại: </td>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class=" col-md-9 col-lg-9 ">
                                    <p class="yellow">Bạn có yêu cầu từ {{ $user->name }} với lời nhắn: </p>
                                    <div class="well">{{$application->message}}</div>
                                    <span class="yellow">Time: {{ date('F d, Y', strtotime($application->created_at)) }}</span>
                                    <br>
                                    @if ($application->state == 'ACCEPTED')
                                        <div class="alert alert-success text-center" role="alert">{{$application->state}}</div>
                                    @endif
                                    @if ($application->state == 'PENDING')
                                        <div class="alert alert-info text-center" role="alert">{{$application->state}}</div>
                                    @endif
                                    @if ($application->state == 'CANCELLED')
                                        <div class="alert alert-warning text-center" role="alert">{{$application->state}}</div>
                                    @endif
                                    @if ($application->state == 'DEAL')
                                        <div class="alert alert-DEAL text-center" role="alert">{{$application->state}}</div>
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="panel-footer border-none">
                            @if ($application->state == 'PENDING')
                                <button type="button" class="btn btn-danger" id="btn-cancel" value="{{$application->id}}">Cancel</button>
                                <span class="pull-right">
                                    <button type="button" class="btn btn-success" id="btn-accept" value="{{$application->id}}">Accept</button>
                                </span>
                            @endif
                            @if ($application->state == 'ACCEPTED')
                                <button type="button" class="btn btn-danger" id="btn-cancel" value="{{$application->id}}">Cancel</button>
                                <span class="pull-right">
                                    <button type="button" class="btn btn-primary" id="btn-deal" value="{{$application->id}}">Deal</button>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <br>
    </header>


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
            $("#btn-cancel").click(function(e){
                e.preventDefault();
                var applicationId = $(this).val();
                $.ajax({type: "POST",
                    url: "/application/"+applicationId+"/cancel",
                    success:function() {
                        location.reload();
                    }
                });
            });
            $("#btn-accept").click(function(e){
                e.preventDefault();
                var applicationId = $(this).val();
                $.ajax({type: "POST",
                    url: "/application/"+applicationId+"/accept",
                    success:function() {
                        location.reload();
                    }
                });
            });
            $("#btn-deal").click(function(e){
                e.preventDefault();
                var applicationId = $(this).val();
                $.ajax({type: "POST",
                    url: "/application/"+applicationId+"/deal",
                    success:function() {
                        location.reload();
                    }
                });
            });

        })();
    </script>
@stop