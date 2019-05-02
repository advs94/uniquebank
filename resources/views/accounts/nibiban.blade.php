@extends('adminlte::page')

@section('title', 'Balance')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1.7%;">Balance</h1></p>

        @foreach ($user->accounts()->get() as $account)
            <div class="form-group row" style="margin-left:5.7%; margin-top:4%;">
            <label class="col-md-2" style="max-width:none"><h4>{{ $account->type }}</h4></label>
                <div class="col-md-5">
                    <h4>Nib</h4>
                    <h5>
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
                    </h5>
                    <h4>Iban</h4>
                    <h5>
                        @for ($i = 0; $i < strlen($account->iban)-strlen($account->nib); $i++)
                            <?php $aux .= $account->iban[$i]; ?>
                        @endfor
                        <?php $aux .= " ".$string; ?>
                        {{ $aux }}
                    </h5>
                </div>
            </div>
        @endforeach
    </div>      
@endsection
