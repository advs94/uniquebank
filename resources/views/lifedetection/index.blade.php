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

        <?php
            try {
                $lifedetection = response()->file('js\myKNNDataset.json');
            } catch (Exception $exception) {
                $lifedetection = null;
            }
        ?>

        @if ($lifedetection)
            <h4 style="margin-top:3%;margin-left:1%;margin-bottom:2.8%;">You have Life Detection functionality activated</h4>

            <form class="form-horizontal" method="post" action="/lifedetection">
                @method('DELETE')
                @csrf

                <div class="form-group">
                    <div class="col-sm-offset">
                        <a href="/lifedetection/edit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:26px; padding: 7px 15px">Update</a>
                        <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:6px; padding: 7px 15px">Delete</button>
                    </div>
                </div>
            </form>
        @else
            <h4 style="margin-top:3%;margin-left:1%;margin-bottom:2.8%;">You don't have Life Detection functionality activated</h4>

            <div class="form-group">
                <div class="col-sm-offset">
                    <a href="/lifedetection/create" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px">Activate</a>
                </div>
            </div>
        @endif
    </div>    
@endsection

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop
