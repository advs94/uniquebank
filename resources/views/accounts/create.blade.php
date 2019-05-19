@extends('adminlte::page')

@section('title', 'Account')

@section('css')
    <link rel="stylesheet"
    href="{{ asset('css/styles.css') }} ">
@endsection

@section('content')
    <div class="container">
        <form class="form-horizontal" method="post" action="/accounts/{{ $user->id }}">
            @csrf
            
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-body" style="margin-bottom: -15px;">
                            <div class="row">
                                <div class="col-md-12 lead">
                                    New Account<hr>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row" style="margin-left:0%; margin-top:-3%;">
                                    <label for="type" class="col-md-3" style="max-width:none"><h5 class="lead">Account Type</h5></label>
                                    <div class="col-md-offset-3 has-feedback {{ $errors->has('type') ? 'has-error' : '' }}" style="margin-top: 10px;">
                                        <select name="type" id="type" class="form-control lead" style="width: 94%">
                                            @foreach (config('enums.account_types') as $accountType)
                                                <option value={{ $accountType }}>{{ ucwords($accountType) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-left:0%;">
                                    <label for="pin" class="col-md-3" style="max-width:none"><h5 class="lead">PIN</h5></label>
                                    <div class="col-md-offset-3 has-feedback {{ $errors->has('pin') ? 'has-error' : '' }}" style="margin-top: 10px;">
                                        <input type="password" id="pin" name="pin" class="form-control lead" style="width: 94%" placeholder="ex: 7481">
                                        <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 6%;"></span>
                                        @if ($errors->has('pin'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pin') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-left:0%;">
                                    <label for="pin_confirmation" class="col-md-3" style="max-width:none"><h5 class="lead">Confirm PIN</h5></label>
                                    <div class="col-md-offset-3 has-feedback {{ $errors->has('pin_confirmation') ? 'has-error' : '' }}" style="margin-top: 10px;">
                                        <input type="password" id="pin_confirmation" name="pin_confirmation" class="form-control" style="width: 94%">
                                        <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 6%;"></span>
                                        @if ($errors->has('pin_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pin_confirmation') }}</strong>
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
        </form>
    </div>    
@endsection
