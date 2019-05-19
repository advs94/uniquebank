@extends('adminlte::page')

@section('title', 'Profile')

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
            <div class="col-md-9">
                <div class="panel panel-default" style="margin-top: 20px;">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 lead">User Profile<hr></div>
                        </div>
                        <div class="col-md-7">
                            <form class="form-horizontal" method="post" action="/users/{{ $user->id }}">
                                @method('PATCH')
                                @csrf
                                    
                                @foreach ($user->getFillableAttributes() as $fillableAttribute)
                                    <?php $aux = ucwords(str_replace("_", " ", $fillableAttribute)); ?>
                                    <div class="row">
                                        <label for={{ $fillableAttribute }} class="col-sm-3 control-label" style="max-width:none"><h5 class="lead">{{ $aux }}</h5></label>
                                        @if (strtotime($user->$fillableAttribute))
                                            <?php
                                                $aux = explode('-', $user->$fillableAttribute);
                                                $temp = $aux[0];
                                                $aux[0] = $aux[2];
                                                $aux[2] = $temp;
                                                $aux = implode('/', $aux);
                                            ?>
                                            <div class="col-sm-9 has-feedback {{ $errors->has($fillableAttribute) ? 'has-error' : '' }}" style="margin-top: 15px; margin-left: 0px;">
                                                <input type="text" id="{{ $fillableAttribute }}" name="{{ $fillableAttribute }}" class="form-control lead" value="{{ $aux }}" style="margin-left: 0px;"></textarea>
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                @if ($errors->has($fillableAttribute))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first($fillableAttribute) }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <div class="col-sm-9 has-feedback {{ $errors->has($fillableAttribute) ? 'has-error' : '' }}" style="margin-top: 15px; margin-left: 0px;">
                                                <input type="text" id="{{ $fillableAttribute }}" name="{{ $fillableAttribute }}" class="form-control lead" value="{{ $user->$fillableAttribute }}" style="margin-left:0px;"></textarea>
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                @if ($errors->has($fillableAttribute))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first($fillableAttribute) }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-sm-offset-0" style="margin-top: 25px; margin-bottom: 20px; margin-left: 30px;">
                                        <button type="submit" class="btn btn-default control-label lead" style="background-color: rgb(0, 100, 255); font-size: 130%;">Update</button>
                                        <a href="/users/{{ $user->id }}/delete" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:20px; padding: 7px 15px; font-size: 130%;" data-method="DELETE">Delete</a>
                                    </div>
                                </div>
                            </form> 
                        </div>
                        <div class="col-md-offset-6">
                            <img class="img-circle avatar avatar-original" style="-webkit-user-select:none; 
                            display:block; margin:auto; width:50%; height:auto;" src="https://signin.techsmith.com/Content/images/profile-placeholder.svg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script>
        $(function() {
            $("#birth_date").datepicker({
                dateFormat: 'dd/mm/yy',                
            });
        });
    </script>
@stop
