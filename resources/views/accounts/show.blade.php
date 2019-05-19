@extends('adminlte::page')

@section('title', 'Accounts')

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

        <p><h1 class="title" style="margin-left:1%;">Accounts</h1></p>

        @foreach ($user->accounts()->get() as $account)
            <form class="form-horizontal" method="post" action="/accounts/{{ $account->id }}">
                @method('DELETE')
                @csrf
                
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel panel-default" style="margin-top: 20px;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 lead">
                                        NIB
                                        <div class="col-md-offset-7 lead">
                                            <h4 class="lead" style="margin-top: -30px; margin-left: 107px;">
                                                <?php 
                                                    $string = ''; 
                                                    $aux = "";
                                                ?>
                                                @for ($i = 0; $i < strlen($account->nib); $i++)
                                                    @if ($i % 4 == 0 && $i != 0)
                                                        <?php $string .= ' '; ?>                            
                                                    @endif
                                                    <?php 
                                                        $string .= $account->nib[$i];
                                                    ?>
                                                @endfor
                                                {{ $string }}
                                            </h4>
                                        </div><hr>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row" style="margin-left:5%; margin-top:-3%;">
                                        <label class="col-md-2" style="max-width:none"><h4 class="lead">Type</h4></label>
                                        <div class="col-md-offset-8">
                                            <h5 class="lead" style="margin-left: 20px;">{{ ucwords($account->type) }}</h5>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-left:5%;">
                                        <label class="col-md-2" style="max-width:none"><h4 class="lead">Balance</h4></label>
                                        <div class="col-md-offset-8">
                                            <h5 class="lead" style="margin-left: 20px;">{{ $account->balance }}</h5>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-left:5%;">
                                        <label class="col-md-4" style="max-width:none"><h4 class="lead">Time Created</h4></label>
                                        <div class="col-md-offset-8">
                                            <h5 class="lead" style="margin-left: 20px;">{{ $account->created_at }}</h5>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-left:4.5%;">
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-default" style="background-color: rgb(0, 100, 255); padding: 7px 15px; font-size:130%">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endforeach
    </div>      
@endsection
