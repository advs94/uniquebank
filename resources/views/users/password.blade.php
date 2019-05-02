@extends('adminlte::page')

@section('title', 'Password')

@section('content')

    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Change Password</h1></p>

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
                
            <div class="form-group">
                <label for="current_password" class="col-sm-2 control-label" style="max-width:none"><h5>Current Password</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('current_password') ? 'has-error' : '' }}">
                    <input type="password" id="current_password" name="current_password" class="form-control"></textarea>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('current_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('current_password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="new_password" class="col-sm-2 control-label" style="max-width:none"><h5>New Password</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}">
                    <input type="password" id="new_password" name="new_password" class="form-control"></textarea>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('new_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="new_password_confirmation" class="col-sm-2 control-label" style="max-width:none"><h5>Confirm New Password</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control"></textarea>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('new_password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255);">Update</button>
                </div>
            </div>
        </form>
    </div>    
@endsection
