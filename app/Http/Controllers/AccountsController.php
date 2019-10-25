<?php

namespace uniquebank\Http\Controllers;

use uniquebank\Account;
use Illuminate\Http\Request;
use Auth;
use uniquebank\User;
use Validator;
use DB;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }
        
        $user = Auth::user();   

        return view('accounts.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }
        
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
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }
        
        $data = request([
            'type', 'pin', 'pin_confirmation'
        ]);

        $accountTypes = "";

        foreach (config('enums.account_types') as $accountType)
        {
            $accountTypes .= $accountType.',';
        }

        $accountTypes = substr_replace($accountTypes, '', strlen($accountTypes)-1);
        
        Validator::make($data, [
            'type' => ['required', 'string', 'in:'.$accountTypes],
            'pin' => ['required', 'digits:4', 'confirmed'],
            'pin_confirmation' => ['required', 'digits:4'],
        ])->validate();
        
        if($user->accounts()->where('type', $data['type'])->first())
        {
            return redirect('accounts')->with("error", "You already have a ".ucwords($data['type'])." account !");
        }

        $account = new Account();
        $account->balance = 0;
        $account->pin = $data['pin'];
        $account->nib = rand(0, 9);        

        for ($i = 0; $i < 20; $i++)
        {
            $account->nib = rand(0, 9).$account->nib;
        }

        $account->iban = 'PT50'.$account->nib;
        $account->user_id = $user->id;
        $account->type = $data['type'];

        $account->save();

        return redirect('accounts')->with("success","Account created successfully !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \uniquebank\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \uniquebank\Account  $account
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
     * @param  \uniquebank\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \uniquebank\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }
        
        foreach ($account->transfers as $transfer) 
        {
            $sender_account = $transfer->accounts()->wherePivot('account_id', '!=', $account->id)->first();

            $account->transfers()->detach($transfer->id);
            $sender_account->transfers()->detach($transfer->id);

            $transfer->delete();
        }

        $account->delete();

        return back()->with("success","Account deleted successfully !");
    }

    /**
     * Show the balance of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function balance()
    {
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }
        
        $user = Auth::user();

        return view('accounts.balance', compact('user'));;
    }

    /**
     * Show the balance of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nibiban()
    {
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }
        
        $user = Auth::user();

        return view('accounts.nibiban', compact('user'));;
    }
}
