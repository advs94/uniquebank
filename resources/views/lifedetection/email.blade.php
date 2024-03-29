@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')

    <div class="login-box">
        
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
            if(strcmp(substr(url()->full(), strpos(url()->full(), '?')+1, strlen('noPoses')), 'noPoses') == 0)
            {
                ?>
                    <div class="alert alert-danger">
                        {{ 'Human Undetected!' }}
                    </div>
                <?php
            }
            if(strcmp(substr(url()->full(), strpos(url()->full(), '?')+1, strlen('multiplePoses')), 'multiplePoses') == 0)
            {
                ?>
                    <div class="alert alert-danger">
                        {{ 'Multiple Humans Detected!' }}
                    </div>
                <?php
            }
        ?>
        
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="lifedetection/authenticate" method="post">
                {!! csrf_field() !!}
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row" style="margin-left: 2px; margin-right: 2px; margin-bottom: 20px; margin-top: 10px;">
                    <button type="submit"
                            class="btn btn-primary btn-block btn-flat">{{ 'Submit' }}</button>
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
