@extends('adminlte::page')

@section('title', 'UniqueBank')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  <p>You are logged in!</p>
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/addons/p5.dom.min.js"></script>
  <script src="https://unpkg.com/ml5@0.2.3/dist/ml5.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('js/knn.js') }}"></script>
@endsection