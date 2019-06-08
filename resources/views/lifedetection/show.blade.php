@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')

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
                                <?php
                                    $aux = explode("&", $user->life_detection);
                                    $userEmail = $user->email;

                                    $lifedetection[0] = explode("=", $aux[0])[1];
                                    $lifedetection[1] = explode("=", $aux[1])[1];
                                    $lifedetection[2] = explode("=", $aux[12])[1];
                                    $lifedetection[3] = explode("=", $aux[14])[1];
                                    $lifedetection[4] = explode("=", $aux[15])[1];
                                    $lifedetection[5] = explode("=", $aux[16])[1];
                                    $lifedetection[6] = explode("=", $aux[17])[1];
                                    $lifedetection[7] = explode("=", $aux[18])[1];
                                    $lifedetection[8] = explode("=", $aux[19])[1];
                                    $lifedetection[9] = explode("=", $aux[20])[1];
                                    $lifedetection[10] = explode("=", $aux[2])[1];
                                    $lifedetection[11] = explode("=", $aux[3])[1];
                                    $lifedetection[12] = explode("=", $aux[4])[1];
                                    $lifedetection[13] = explode("=", $aux[5])[1];
                                    $lifedetection[14] = explode("=", $aux[6])[1];
                                    $lifedetection[15] = explode("=", $aux[7])[1];
                                    $lifedetection[16] = explode("=", $aux[8])[1];
                                    $lifedetection[17] = explode("=", $aux[9])[1];
                                    $lifedetection[18] = explode("=", $aux[10])[1];
                                    $lifedetection[19] = explode("=", $aux[11])[1];
                                    $lifedetection[20] = explode("=", $aux[13])[1];

                                    echo '<script>';
                                    echo 'let lifedetection = ' . json_encode($lifedetection) . ';';
                                    echo 'let userEmail = ' . json_encode($userEmail) . ';';
                                    echo '</script>';
                                ?>

                                {{-- <form action="/lifedetection/authenticate/success" method="post">
                                    {!! csrf_field() !!}

                                    <button type="button" id="left" onclick="left()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Left</a>
                                    <button type="button" id="right" onclick="right()"class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Right</a>
                                    <button type="button" id="happy" onclick="happy()"class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Happy</a>                           
                                    <button type="button" id="sad" onclick="sad()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Sad</a>
                                    <button type="button" id="predict" onclick="predict()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Predict</a>
                                    <button type="button" id="save" onclick="save2()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Save</button>                 
                                    <button type="button" id="ok" onclick="ok()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">OK</button>                                   
                                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:6px; padding: 7px 15px; font-size: 130%;">Submit</button>                                    
                                </form> --}}
                                <div class="col-md-12 lead" style="margin-top: -40px;">Detecting {{ $user->name }}</div>
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
    <script type="text/javascript" src="{{ URL::asset('js/posenet_load.js') }}"></script>
@stop
