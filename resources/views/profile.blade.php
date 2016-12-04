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
                                    <div class="col-md-3 col-lg-3 " align="center">
                                        <img alt="User Pic" src="/upload/avatars/{{ $user->avatar }}" class="img-circle img-responsive">
                                        <br>
                                        <form enctype="multipart/form-data" action="/avatar" method="POST" id="avatar">
                                            <input type="file" name="avatar" id="file" class="inputfile" />
                                            <label for="file"><i class="fa fa-upload" aria-hidden="true"></i> Choose a file</label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>

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
                                    <a href="#" data-original-title="Edit this user" data-toggle="modal" type="button"  data-target="#editModal" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </article>
        </div>
        <br>
    </header>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('profile/'.$user->id) }}">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class=" control-label ">Tên</label>

                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age" class=" control-label ">Tuổi</label>

                                <input id="age" type="text" class="form-control" name="age" value="{{ $user->age }}">

                                @if ($errors->has('age'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="name" class=" control-label ">Điện thoại</label>

                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label ">E-Mail</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-6" align="center">
                            <img alt="User Pic" src="/upload/avatars/{{ $user->avatar }}" class="img-circle img-responsive">
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class=" control-label">Một vài điều về bản thân</label>
                                <textarea id="description" class="form-control"  name="description" rows="5" >
                                    {{ $user->description }}
                                </textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-btn fa-user"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function() {
            $("#file").on('change',function(){
                $('form#avatar').submit();
            });
        })();
    </script>
@stop