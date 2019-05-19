@extends('adminlte::page')

@section('title', 'Balance')

@section('content')
    <div class="container">
        <h1 class="title" style="margin-bottom: 3%;">NIB & IBAN Consult</h1>

        @foreach ($user->accounts()->get() as $account)
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 lead">
                                    Type
                                    <div class="col-md-offset-7 lead">
                                        <h4 class="lead" style="margin-top: -30px; margin-left: 60px;">{{ ucwords($account->type) }}</h4>
                                    </div><hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 lead" style="margin-top: -3%;">
                                    NIB
                                    <div class="col-md-offset-7 lead">
                                        <h4 class="lead" style="margin-top: -30px; margin-left: 60px;">
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
                            <div class="row">
                                <div class="col-md-12 lead" style="margin-top: -3%;">
                                    IBAN
                                    <div class="col-md-offset-7 lead">
                                        <h4 class="lead" style="margin-top: -30px; margin-left: 60px; margin-bottom: -12%;">
                                            @for ($i = 0; $i < strlen($account->iban)-strlen($account->nib); $i++)
                                                <?php $aux .= $account->iban[$i]; ?>
                                            @endfor
                                            <?php $aux .= " ".$string; ?>
                                            {{ $aux }}
                                        </h4>
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
