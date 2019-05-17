@extends('adminlte::page')

@section('title', 'Life Detection')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Life Detection</h1></p>

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
    </div>
@endsection

@section('adminlte_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/addons/p5.dom.min.js"></script>
    <script src="https://unpkg.com/ml5@0.2.3/dist/ml5.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/knn_save.js') }}"></script>
@stop
