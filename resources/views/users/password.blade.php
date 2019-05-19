@extends('adminlte::page')

@section('title', 'Password')

@section('content')

    <div class="container">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form class="form-horizontal" method="post" action="/users/password/{{ $user->id }}">
            @method('PATCH')
            @csrf
               
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-body" style="margin-bottom: -15px;">
                            <div class="row">
                                <div class="col-md-12 lead">
                                    Change Password<hr>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row" style="margin-left:0%; margin-top: -1%;">
                                    <label for="current_password" class="col-sm-3 control-label" style="max-width:none"><h5 class="lead">Current Password</h5></label>
                                    <div class="col-sm-9 has-feedback {{ $errors->has('current_password') ? 'has-error' : '' }}" style="margin-top: 15px;">
                                            <input type="password" id="current_password" name="current_password" class="form-control lead" style="width: 94%">
                                            <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 8%;"></span>
                                            @if ($errors->has('current_password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('current_password') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-left:0%;">
                                    <label for="new_password" class="col-sm-3 control-label" style="max-width:none"><h5 class="lead">New Password</h5></label>
                                    <div class="col-sm-9 has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}" style="margin-top: 15px;">
                                        <input type="password" id="new_password" name="new_password" class="form-control lead" style="width: 94%" placeholder="ex: 47a813d2">
                                        <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 8%;"></span>
                                        @if ($errors->has('new_password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('new_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-left:0%;">
                                    <label for="new_password_confirmation" class="col-sm-3 control-label" style="max-width:none"><h5 class="lead">Confirm New Password</h5></label>
                                    <div class="col-sm-9 has-feedback {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}" style="margin-top: 15px;">
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" style="width: 94%">
                                        <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 8%;"></span>
                                        @if ($errors->has('new_password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom:35px; margin-left:0%">
                                    <div class="col-sm-3" style="margin-left: 11.5%;">
                                        <button type="submit" class="control-label btn btn-default" style="background-color: rgb(0, 100, 255); font-size:130%;">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>    
@endsection
