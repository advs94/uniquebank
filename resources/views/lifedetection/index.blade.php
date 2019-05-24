@extends('adminlte::page')

@section('title', 'Life Detection')

@section('content')
    <div class="container">

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
                $lifedetection = file_exists('storage\myKNNDataset.json');
            } catch (Exception $exception) {
                $lifedetection = null;
            }
        ?>

        @if ($lifedetection)
            <?php
                auth()->user()->life_detection = file_get_contents('storage\myKNNDataset.json');
                auth()->user()->save();
            ?>

            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 lead">Life Detection<hr></div>
                            </div>
                            <div class="row">
                                <div>
                                    <h5 class="lead" style="margin-left: 20px;">You have Life Detection functionality activated</h5>
                                </div>
                            </div>
                            <form class="form-horizontal" method="post" action="/lifedetection">
                                @method('DELETE')
                                @csrf
                
                                <div class="row" style="margin-top: 2%;">
                                    <div>
                                        <a href="/lifedetection/edit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:26px; padding: 7px 15px; font-size: 130%;">Update</a>
                                        <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:6px; padding: 7px 15px; font-size: 130%;">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                    <div class="col-md-7">
                        <div class="panel panel-default" style="margin-top: 20px;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 lead">Life Detection<hr></div>
                                </div>
                                <div class="row" style="margin-top: 0;">
                                    <div>
                                        <h5 class="lead" style="margin-left: 20px;">You don't have Life Detection functionality activated</h5>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 2%;">
                                    <div>
                                        <a href="/lifedetection/create" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Activate</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
