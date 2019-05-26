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

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default" style="margin-top: 20px;">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 lead">Life Detection<hr></div>
                        </div>
                        <div class="row" style="margin-top: 0;">
                            <div>

                            </div>
                        </div>
                        <div class="row" style="margin-top: 2%;">
                            <div style="margin-top: 580px;">
                                <button type="button" id="left" onclick="left()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Left</a>
                                <button type="button" id="right" onclick="right()"class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Right</a>
                                <button type="button" id="happy" onclick="happy()"class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Happy</a>                           
                                <button type="button" id="sad" onclick="sad()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Sad</a>
                                <button type="button" id="predict" onclick="predict()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Predict</a>                           
                                <button type="button" id="save" onclick="save2()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">Save</a>                  
                                <button type="button" id="ok" onclick="ok()" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:12px; padding: 7px 15px; font-size: 130%;">OK</a>                                   
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
    <script type="text/javascript" src="{{ URL::asset('js/posenet_save.js') }}"></script>
@stop
