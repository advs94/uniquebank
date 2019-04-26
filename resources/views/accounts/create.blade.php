@extends('adminlte::page')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Profile</h1></p>

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
                    <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255);">Submit</button>
                </div>
            </div>
        </form>
    </div>    
@endsection
