@extends('adminlte::page')

@section('title', 'Balance')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Balance</h1></p>

        @foreach ($user->accounts()->get() as $account)
            <div class="form-group row" style="margin-left:5%; margin-top:3%;">
            <label class="col-md-2" style="max-width:none"><h4>{{ $account->type }}</h4></label>
                <div class="col-md-5">
                    <h5>{{ $account->balance }}</h5>
                </div>
            </div>
        @endforeach
    </div>      
@endsection
