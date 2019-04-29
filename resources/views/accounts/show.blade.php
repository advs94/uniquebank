@extends('adminlte::page')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Profile</h1></p>

        {{-- falta fazer foreach para receber todas as contas --}}
        <form class="form-horizontal" method="post" action="/accounts/{{ $account->id }}">
            @method('DELETE')
            @csrf
                
            <div class="form-group">
            <label class="col-sm-2 control-label" style="max-width:none"><h4>Type</h4></label>
                <div class="col-sm-10 has-feedback">
                    <h5>$account->type</h5>
                </div>
            </div>
            <label class="col-sm-2 control-label" style="max-width:none"><h5>Balance</h5></label>
                <div class="col-sm-10 has-feedback">
                    <h5>$account->balance</h5>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:6px; padding: 7px 15px">Delete</button>
                </div>
            </div>
        </form>
    </div>    
@endsection
