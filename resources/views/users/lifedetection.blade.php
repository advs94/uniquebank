@extends('adminlte::page')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Profile</h1></p>

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
            <h3>You have Life Detection functionality activated</h3>

            <div class="form-group">
                <div class="col-sm-offset">
                    <a href="/users/lifedetection/edit"></a>
                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:6px; padding: 7px 15px">Update</button>                        
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset">
                    <a href="/users/lifedetection/{{ $user->id }}"></a>
                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:6px; padding: 7px 15px">Delete</button>
                </div>
            </div>
        @else
            <h3>You don't have Life Detection functionality activated</h3>

            <form class="form-horizontal" method="get" action="/users/lifedetection/create">
                @csrf

                <div class="form-group">
                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:6px; padding: 7px 15px">Activate</button>                        
                    </div>
                </div>
            </form>
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
