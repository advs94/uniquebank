<?php

namespace UniqueBank\Http\Controllers;

use UniqueBank\Transfer;
use UniqueBank\Account;
use UniqueBank\User;
use Illuminate\Http\Request;
use Auth;
use Validator;

class TransfersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \UniqueBank\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \UniqueBank\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \UniqueBank\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \UniqueBank\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        foreach ($account->transfers as $transfer) {
            return $transfer;
        }

        return json_encode($account);
    }

    /**
     * Show the form for creating a new national resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nationals()
    {
        $user = Auth::user();        

        return view('transfers.nationals', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \UniqueBank\User  $user
     * @return \Illuminate\Http\Response
     */
    public function storeNationals(User $user)
    {
        $data = request()->all();

        Validator::make($data, [
            'nib' => ['required', 'string', 'min:21', 'max:21'],
            'account' => ['required', 'string', 'min:21', 'max:21'],
            'amount' => ['required', 'integer', 'min:1'],
        ])->validate();

        $sender_account = $user->accounts()->whereNib($data['account'])->first();
        $receiver_account = Account::whereNib($data['nib'])->first();

        if(!isset($receiver_account->id)) {
            return redirect()->back()->with("error","Account not associated with NIB inserted !");                    
        } else if($data['amount'] > $sender_account->balance) {
            return redirect()->back()->with("error","Unavailable amount !");        
        } else if($receiver_account->id == $sender_account->id) {
            return redirect()->back()->with("error","Sending and receiving accounts cannot be the same !");        
        }

        $transfer = new Transfer();
        $transfer->sender_account_id = $sender_account->id;
        $transfer->receiver_account_id = $receiver_account->id;
        $transfer->amount = $data['amount'];
        $transfer->type = 'national';
        $transfer->save();

        $receiver_account->balance += $transfer->amount;
        $receiver_account->transfers()->attach($transfer->id);
        $receiver_account->save();

        $sender_account->balance -= $transfer->amount;
        $sender_account->transfers()->attach($transfer->id);
        $sender_account->save();

        return redirect()->back()->with("success","Transfer of ".$transfer->amount."€ to ".$user->name." permorfed successfully !");
    }

    /**
     * Show the form for creating a new internationals resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function internationals()
    {
        $user = Auth::user();        

        return view('transfers.internationals', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \UniqueBank\User  $user
     * @return \Illuminate\Http\Response
     */
    public function storeInternationals(User $user)
    {
        $data = request()->all();

        Validator::make($data, [
            'iban' => ['required', 'string', 'min:25', 'max:25'],
            'amount' => ['required', 'integer', 'min:1'],
        ])->validate();

        return redirect()->back()->with("success","Transfer performed successfully !");        
    }
}
