<?php

namespace UniqueBank\Http\Controllers;

use UniqueBank\Account;
use Illuminate\Http\Request;
use Auth;
use UniqueBank\User;
use Validator;

class AccountsController extends Controller
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
        $user = Auth::user();

        return view('accounts.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
    {
        $data = request()->all();

        $accountTypes = "";

        foreach (config('enums.account_types') as $accountType) {
            $accountTypes .= $accountType.',';
        }

        $accountTypes = substr_replace($accountTypes, '', strlen($accountTypes)-1);
        
        Validator::make($data, [
            'type' => ['required', 'string', 'in:'.$accountTypes],
            'pin' => ['required', 'digits:4', 'confirmed'],
            'pin_confirmation' => ['required', 'digits:4'],
        ])->validate();
        
        $account = new Account();
        $account->balance = 0;
        $account->pin = $data['pin'];
        $account->nib = 
        $account->iban = rand((int) 111111111111111111111, (int) 999999999999999999999);

        return $account->iban;

        $account->user_id = $user->id;
        $account->type = $data['type'];

        $account->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \UniqueBank\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \UniqueBank\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \UniqueBank\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \UniqueBank\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
