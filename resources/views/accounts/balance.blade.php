@extends('adminlte::page')

@section('title', 'Balance')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Balance</h1></p>

        @foreach ($user->accounts()->get() as $account)
            <div class="form-group row" style="margin-left:5%; margin-top:4%;">
                <label class="col-md-2" style="max-width:none">
                    <h3><span class="label label-default">{{ $account->type }} : {{ $account->balance }}</span></h3>
                </label>
            </div>
        @endforeach
    </div>      
@endsection
