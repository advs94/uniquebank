<?php

namespace UniqueBank\Http\Controllers;

use UniqueBank\Transfer;
use Illuminate\Http\Request;
use Auth;
use UniqueBank\User;

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
    public function destroy(Transfer $transfer)
    {
        //
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
    public function storeNationals(User $sender)
    {
        $data = request()->all();

        return strlen($data['account']);       // teste de tamanho de string de nib com espaços para colocar nas restrições

        Validator::make($data, [
            'nib' => ['required', 'integer', 'digits:21'],
            'account' => ['required', 'string'],    // falta min e max para igualar a string de nib com espaços
            'amount' => ['required', 'integer', 'min:1'],
        ])->validate();

        $user->accounts();

        $transfer->save();

        return redirect()->back()->with("success","Transfer permorfed successfully !");        
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
