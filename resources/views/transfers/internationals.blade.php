@extends('adminlte::page')

@section('title', 'Internationals Transfers')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Internationals Transfers</h1></p>

        <form class="form-horizontal" method="post" action="/transfers/{{ $user->id }}">
            @csrf

            <div class="row">
                    <div class="col-md-11">
                        <div class="panel panel-default" style="margin-top: 20px;">
                            <div class="panel-body" style="margin-bottom: -15px;">
                                <div class="row">
                                    <div class="col-md-12 lead">
                                        New Account<hr>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row" style="margin-left:0%; margin-top:-3%;">
                                        <label for="current_password" class="col-md-3" style="max-width:none"><h5 class="lead">Current Password</h5></label>
                                        <div class="col-md-offset-3 has-feedback {{ $errors->has('current_password') ? 'has-error' : '' }}" style="margin-top: 10px;">
                                                <input type="password" id="current_password" name="current_password" class="form-control lead" style="width: 94%">
                                                <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 6%;"></span>
                                                @if ($errors->has('current_password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('current_password') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-left:0%;">
                                        <label for="new_password" class="col-md-3" style="max-width:none"><h5 class="lead">New Password</h5></label>
                                        <div class="col-md-offset-3 has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}" style="margin-top: 10px;">
                                            <input type="password" id="new_password" name="new_password" class="form-control lead" style="width: 94%" placeholder="ex: 478132">
                                            <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 6%;"></span>
                                            @if ($errors->has('new_password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('new_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-left:0%;">
                                        <label for="new_password_confirmation" class="col-md-3" style="max-width:none"><h5 class="lead">Confirm New Password</h5></label>
                                        <div class="col-md-offset-3 has-feedback {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}" style="margin-top: 10px;">
                                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" style="width: 94%">
                                            <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 6%;"></span>
                                            @if ($errors->has('new_password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom:5%; margin-left:0%">
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); font-size:130%">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="form-group">
                <label for="iban" class="col-sm-2 control-label" style="max-width:none"><h5>IBAN</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('iban') ? 'has-error' : '' }}">
                    <input type="text" id="iban" name="iban" class="form-control">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('iban'))
                        <span class="help-block">
                            <strong>{{ $errors->first('iban') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="amount" class="col-sm-2 control-label" style="max-width:none"><h5>Amount</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <input type="text" id="amount" name="amount" class="form-control">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('amount'))
                        <span class="help-block">
                            <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255);">Submit</button>
                </div>
            </div>
        </form>
    </div>      
@endsection
