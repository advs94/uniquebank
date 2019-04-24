@extends('adminlte::page')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="container">
        <h4>Welcome To</h4>
        <h1> {{ config('app.name') }} </h1>
        {{-- <p></p>
        <ul class="list-group">
            <li><a href="/pages">Pages</a></li>
            <li><a href="/projects">Projects</a></li>
            <li><a href="/login">Login</a></li>
        </ul> --}}
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.1/p5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.1/addons/p5.dom.min.js"></script>
    <script src="https://unpkg.com/ml5@0.1.3/dist/ml5.min.js" type="text/javascript"></script>
    <script src="/assets/js/sketch.js"></script> --}}
@endsection
