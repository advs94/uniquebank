@extends('adminlte::page')

@section('title', 'Balance')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Accounts Balance</h1></p>

        @foreach ($user->accounts()->get() as $account)
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 lead">
                                    NIB
                                    <div class="col-md-offset-8 lead">
                                        <h4 class="lead" style="margin-top: -30px; margin-left: 39px;">
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
                                <div class="form-group row" style="margin-left:5%;">
                                    <label class="col-md-2" style="max-width:none"><h4 class="lead">Balance</h4></label>
                                    <div class="col-md-offset-8">
                                        <h5 class="lead" style="margin-left: 20px;">{{ $account->balance }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>      
@endsection
