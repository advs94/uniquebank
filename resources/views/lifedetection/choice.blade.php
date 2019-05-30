@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>

            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <a href="/login" method='get'
                    class="btn btn-primary btn-block btn-flat">{{ 'Usual Authentication' }}</a>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <label style="margin-left: 158px; margin-top: 13px;">
                    {{ trans('or') }}
                </label>
            </div>
            <div class="row" style="margin-left: 2px; margin-right: 2px; margin-bottom: 20px; margin-top: 10px;">
                <a href="/lifedetection/email" method='get'
                    class="btn btn-primary btn-block btn-flat">{{ 'Life Detection' }}</a>
            </div>

            <div class="auth-links">
                @if (config('adminlte.register_url', 'register'))
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                       class="text-center"
                    >{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
                @endif
            </div>
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
