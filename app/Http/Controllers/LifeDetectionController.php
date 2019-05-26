<?php

namespace UniqueBank\Http\Controllers;

use Illuminate\Http\Request;
use File;
use UniqueBank\User;

class LifeDetectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lifedetection.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lifedetection.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = url()->full();
        $url = substr($url, strpos($url, '?')+1);

        auth()->user()->life_detection = $url;
        auth()->user()->save();

        return redirect('/lifedetection')->with("success","Life Detection activated successfuly !");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $email = request('email');

        $user = User::whereEmail($email)->first();

        return view('lifedetection.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        File::delete('js\myKNNDataset.json');

        return view('lifedetection.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \UniqueBank\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \UniqueBank\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        File::delete('js\myKNNDataset.json');

        return redirect()->back()->with("success","Life Detection funtionality deactivated successfuly !");
    }

    /**
     * Load the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function load()
    {
        return response()->file('js\myKNNDataset.json');
    }

    /**
     * Load the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function email()
    {
        return view('lifedetection.email');
    }
}
