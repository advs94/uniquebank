@extends('adminlte::page')

@section('title', 'Internationals Transfers')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Internationals Transfers</h1></p>

        <form class="form-horizontal" method="post" action="/transfers/{{ $user->id }}">
            @csrf

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
