@extends('adminlte::page')

@section('title', 'Users')

@section('content')
    <div class="container">
        <ul class="fa-ul">
            @foreach ($users as $user)
                <li><span class="fa-li"><i class="fa fa-angle-right"></i></span><a href="/users/{{ $user->id }}">{{ $user->name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection