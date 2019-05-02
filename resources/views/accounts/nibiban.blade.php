@extends('adminlte::page')

@section('title', 'Balance')

@section('content')
    <div class="container">
        <p><h1 class="title" style="margin-left:1%;">Balance</h1></p>

        @foreach ($user->accounts()->get() as $account)
            <div class="form-group row" style="margin-left:5%; margin-top:3%;">
            <label class="col-md-2" style="max-width:none"><h4>{{ $account->type }}</h4></label>
                <div class="col-md-5">
                    <h4>Nib</h4>
                    <h5>
                        <?php $string = ''; ?>
                        @for ($i = 0; $i < ceil(strlen($account->nib)/4); $i++)
                            <?php 
                                $string .= $account->nib[$i*4];
                                $string .= $account->nib[$i*4+1];
                                $string .= $account->nib[$i*4+2];
                                $string .= $account->nib[$i*4]+3;
                            ?>
                            @if ($i % 4 == 0)
                                <?php $string .= ' '; ?>                            
                            @endif
                        @endfor
                        {{ $string }}
                    </h5>
                    <h4>Iban</h4><h5>{{ $account->iban }}</h5>
                </div>
            </div>
        @endforeach
    </div>      
@endsection
