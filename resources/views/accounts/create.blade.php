@extends('adminlte::page')

@section('title', 'Account')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Create Account</h1></p>

        <form class="form-horizontal" method="post" action="/accounts/{{ $user->id }}">
            @csrf

            <div class="form-group">
                <label for="type" class="col-sm-2 control-label" style="max-width:none"><h5>Account Type</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('type') ? 'has-error' : '' }}">
                    <select name="type" id="type" class="form-control">
                        @foreach (config('enums.account_types') as $accountType)
                            <option value={{ $accountType }}>{{ ucwords($accountType) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="pin" class="col-sm-2 control-label" style="max-width:none"><h5>PIN</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('pin') ? 'has-error' : '' }}">
                    <input type="password" id="pin" name="pin" class="form-control">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('pin'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pin') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="pin_confirmation" class="col-sm-2 control-label" style="max-width:none"><h5>Confirm PIN</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('pin_confirmation') ? 'has-error' : '' }}">
                    <input type="password" id="pin_confirmation" name="pin_confirmation" class="form-control">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('pin_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pin_confirmation') }}</strong>
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
