@extends('adminlte::page')

@section('title', 'National Transfers')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">National Transfers</h1></p>

        <form class="form-horizontal" method="post" action="/transfers/{{ $user->id }}">
            @csrf

            <div class="form-group">
                <label for="nib" class="col-sm-2 control-label" style="max-width:none"><h5>NIB</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('nib') ? 'has-error' : '' }}">
                    <input type="text" id="nib" name="nib" class="form-control">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('nib'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nib') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="account" class="col-sm-2 control-label" style="max-width:none"><h5>Account</h5></label>
                <div class="col-sm-10 has-feedback {{ $errors->has('account') ? 'has-error' : '' }}">
                    <select name="account" id="account" class="form-control">
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
                            <option value={{ $string }}>{{ ucwords($string) }}</option>
                        @endforeach
                    </select>
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
