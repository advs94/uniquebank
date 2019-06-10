@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')

    <?php
        $url = url()->full();
        $url2 = substr($url, strpos($url, '%')+3);
        $url1 = str_replace("%40".$url2, "", substr($url, strpos($url, '=')+1));
        $userEmail = $url1.'@'.$url2;
        echo '<script>';
        echo 'let userEmail = ' . json_encode($userEmail) . ';';
        echo '</script>';
    ?>

    <div class="login-box" style="position: relative; width: 1000px; margin-top: 40px;">

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

        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default" style="margin-top: 90px;">
                    <div class="panel-body">
                        <div class="row">
                            <div class="login-logo">
                                <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 2%;">
                            <div style="margin-top: 580px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('adminlte_js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/p5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.8.0/addons/p5.dom.min.js"></script>
    <script src="https://unpkg.com/ml5@latest/dist/ml5.min.js" type="text/javascript"></script>
    <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js" type="text/javascript"></script> 
    <script type="text/javascript" src="{{ URL::asset('js/posenet_gestures.js') }}"></script>
@stop
