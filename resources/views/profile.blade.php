@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url({{asset('images/img_bg_11.jpg')}})" data-stellar-background-ratio="0.5">
        <div class="gtco-container">
            <article id="main-content" style="margin-top: 10em;">
                <div class="row">
                    <div class="container">
                        <div class="panel panel-info">
                            <div class="panel-heading border-none" style="background: #FBB448">
                                <p class="panel-title text-center white cursive-font">{{ $user->name }}'s Profile</p>
                            </div>
                            <div class="panel-body border-none form-wrap-profile">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="/upload/avatars/{{ $user->avatar }}" class="img-circle img-responsive"> </div>

                                    <div class=" col-md-9 col-lg-9 ">
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
                                            <tr>
                                                <td>Giới thiệu bản thân: </td>
                                                <td>{{ $user->description }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer border-none">
                                <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                                <span class="pull-right">
                                    <a href="#" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </span>
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