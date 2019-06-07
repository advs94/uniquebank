@extends('adminlte::page')

@section('title', 'Balance')

@section('content')
    <div class="container">
        <h1 class="title" style="margin-bottom: 3%;">NIB & IBAN Consult</h1>

        <?php
            $auxTransfers = array();
        ?>
        @foreach ($user->accounts as $account)
            @foreach ($account->transfers as $transfer)
                <?php
                    $test = false;

                    if(empty($auxTransfers))
                    {
                        $auxTransfers[] = $transfer;
                    }
                    else
                    {
                        foreach ($auxTransfers as $auxTransfer)
                        {
                            if($transfer->is($auxTransfer))
                            {
                                $test = true;
                            }
                        }

                        if($test == false)
                        {
                            $auxTransfers[] = $transfer;
                        }
                    }
                ?>
                @if ($test == false)
                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel panel-default" style="margin-top: 20px;">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12 lead">
                                            From
                                            <div class="col-md-offset-7 lead">
                                                <h4 class="lead" style="margin-top: -30px; margin-left: 60px;">
                                                    <?php 
                                                        $string = ''; 
                                                        $aux = "";
                                                    ?>
                                                    @for ($i = 0; $i < strlen(UniqueBank\Account::findOrFail($transfer->sender_account_id)->nib); $i++)
                                                        @if ($i % 4 == 0 && $i != 0)
                                                            <?php $string .= ' '; ?>                            
                                                        @endif
                                                        <?php 
                                                            $string .= UniqueBank\Account::findOrFail($transfer->sender_account_id)->nib[$i];
                                                        ?>
                                                    @endfor
                                                    {{ $string }}
                                                </h4>
                                            </div><hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 lead" style="margin-top: -3%;">
                                            To
                                            <div class="col-md-offset-7 lead">
                                                <h4 class="lead" style="margin-top: -30px; margin-left: 60px;">
                                                    <?php 
                                                        $string = ''; 
                                                        $aux = "";
                                                    ?>
                                                    @for ($i = 0; $i < strlen(UniqueBank\Account::findOrFail($transfer->receiver_account_id)->nib); $i++)
                                                        @if ($i % 4 == 0 && $i != 0)
                                                            <?php $string .= ' '; ?>                            
                                                        @endif
                                                        <?php 
                                                            $string .= UniqueBank\Account::findOrFail($transfer->receiver_account_id)->nib[$i];
                                                        ?>
                                                    @endfor
                                                    {{ $string }}
                                                </h4>
                                            </div><hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 lead" style="margin-top: -3%;">
                                            Amount
                                            <div class="col-md-offset-7 lead">
                                                <h4 class="lead" style="margin-top: -30px; margin-left: 60px; margin-bottom: -12%;">
                                                    {{ $transfer->amount.' €' }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach            
        @endforeach
    </div>      
@endsection
