@extends('adminlte::page')

@section('title', 'Account')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Create Account</h1></p>

        <form class="form-horizontal" method="post" action="/accounts/{{ $user->id }}">
            @csrf
                
            @foreach ($account->getHidden() as $hiddenAttribute)
                {{ gettype($hiddenAttribute) }}
                <?php $aux = ucwords(str_replace("_", " ", $hiddenAttribute)); ?>
                <div class="form-group">
                    <label for={{ $hiddenAttribute }} class="col-sm-2 control-label" style="max-width:none"><h5>{{ $aux }}</h5></label>
                    <div class="col-sm-10 has-feedback {{ $errors->has($hiddenAttribute) ? 'has-error' : '' }}">
                        @if (strcmp(gettype($hiddenAttribute), 'string') == 0)
                            @continue
                        @endif
                        <input type="text" id={{ $hiddenAttribute }} name={{ $hiddenAttribute }} class="form-control" value={{ $user->$hiddenAttribute }}></textarea>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has($hiddenAttribute))
                            <span class="help-block">
                                <strong>{{ $errors->first($hiddenAttribute) }}</strong>
                            </span>
                        @endif
                    </div>
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
