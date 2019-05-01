@extends('adminlte::page')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Profile</h1></p>

        @foreach ($user->accounts()->get() as $account)
            <form class="form-horizontal" method="post" action="/accounts/{{ $account->id }}">
                @method('DELETE')
                @csrf
                    
                <div class="form-group row" style="margin-left:5%; margin-top:3%;">
                    <label class="col-md-2" style="max-width:none"><h4>Type</h4></label>
                        <div class="col-md-5">
                            <h5>{{ $account->type }}</h5>
                        </div>
                </div>
                <div class="form-group row" style="margin-left:5%; margin-top:3%;">
                <label class="col-md-2" style="max-width:none"><h4>Balance</h4></label>
                    <div class="col-md-5">
                        <h5>{{ $account->balance }}</h5>
                    </div>
                </div>
                <div class="form-group row" style="margin-left:4.5%;">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:6px; padding: 7px 15px; font-size:130%">Delete</button>
                    </div>
                </div>
            </form>
        @endforeach
    </div>      
@endsection
