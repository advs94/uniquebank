@extends('adminlte::page')

@section('title', 'National Transfers')

@section('css')
    <link rel="stylesheet"
    href="{{ asset('css/styles.css') }} ">
@endsection

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">National Transfers</h1></p>

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

        <form class="form-horizontal" method="post" action="/transfers/national/{{ $user->id }}">
            @csrf

            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-body" style="margin-bottom: -15px;">
                            <div class="row">
                                <div class="col-md-12 lead">
                                    New Transfer<hr>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row" style="margin-left:0%; margin-top:-3%;">
                                    <label for="account" class="col-md-3" style="max-width:none"><h5 class="lead">From</h5></label>
                                    <div class="col-md-offset-3 has-feedback {{ $errors->has('account') ? 'has-error' : '' }}" style="margin-top: 10px;">
                                        <select name="account" id="account" class="form-control" style="width: 94%">
                                            @foreach ($user->accounts()->get() as $account)
                                                <?php 
                                                    $string = ''; 
                                                    $aux = "";
                                                ?>
                                                @for ($i = 0; $i < strlen($account->nib); $i++)
                                                    @if ($i % 4 == 0 && $i != 0)
                                                        <?php $string .= ' '; ?>                            
                                                    @endif
                                                    <?php 
                                                        $string .= $account->nib[$i];
                                                    ?>
                                                @endfor
                                                <option value={{ $account->nib }}>{{ $string }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-group row" style="margin-left:0%;">
                                    <label for="nib" class="col-md-3" style="max-width:none"><h5 class="lead">To</h5></label>
                                    <div class="col-md-offset-3 has-feedback {{ $errors->has('nib') ? 'has-error' : '' }}" style="margin-top: 10px;">
                                        <input type="text" id="nib" name="nib" class="form-control" style="width: 94%" placeholder="ex: 335838834599121207080">
                                        <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 6%;"></span>
                                        @if ($errors->has('nib'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nib') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-left:0%;">
                                    <label for="amount" class="col-md-3" style="max-width:none"><h5 class="lead">Amount</h5></label>
                                    <div class="col-md-offset-3 has-feedback {{ $errors->has('amount') ? 'has-error' : '' }}" style="margin-top: 10px;">
                                        <input type="text" id="amount" name="amount" class="form-control" style="width: 94%" placeholder="ex: 200">
                                        <span class="glyphicon glyphicon-lock form-control-feedback" style="right: 6%;"></span>
                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom:5%; margin-left:0%">
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); font-size: 130%;">Submit</button>
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
