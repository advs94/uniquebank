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

        <form class="form-horizontal" method="post" action="/users/{{ $user->id }}">
            @method('PATCH')
            @csrf
                
            @foreach ($user->getFillableAttributes() as $fillableAttribute)
                <?php $aux = ucwords(str_replace("_", " ", $fillableAttribute)); ?>
                <div class="form-group">
                    <label for={{ $fillableAttribute }} class="col-sm-2 control-label" style="max-width:none"><h5>{{ $aux }}</h5></label>
                    @if (strtotime($user->$fillableAttribute))
                        <?php
                            $aux = explode('-', $user->$fillableAttribute);
                            $temp = $aux[0];
                            $aux[0] = $aux[2];
                            $aux[2] = $temp;
                            $aux = implode('/', $aux);
                        ?>
                        <div class="col-sm-10 has-feedback {{ $errors->has($fillableAttribute) ? 'has-error' : '' }}">
                            <input type="text" id="{{ $fillableAttribute }}" name="{{ $fillableAttribute }}" class="form-control" value="{{ $aux }}"></textarea>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @if ($errors->has($fillableAttribute))
                                <span class="help-block">
                                    <strong>{{ $errors->first($fillableAttribute) }}</strong>
                                </span>
                            @endif
                        </div>
                    @else
                        <div class="col-sm-10 has-feedback {{ $errors->has($fillableAttribute) ? 'has-error' : '' }}">
                            <input type="text" id="{{ $fillableAttribute }}" name="{{ $fillableAttribute }}" class="form-control" value="{{ $user->$fillableAttribute }}"></textarea>
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
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255);">Update</button>
                </div>
            </div>
        </form>
        <form method="post" action="/users/{{ $user->id }}">
            @method('DELETE')
            @csrf

            <div class="form-group">
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); margin-left:6px; padding: 7px 15px">Delete</button>
                </div>
            </div>
        </form>
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
