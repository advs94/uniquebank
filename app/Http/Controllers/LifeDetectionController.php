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
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }

        return view('lifedetection.index');
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
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }

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

        if(!is_null($user->life_detection))
        {
            return view('lifedetection.show', compact('user'));
        }

        return redirect('/login?email='.$email)->with("error","Life Detection is deactivated on your account !");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }

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
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }
        
        File::delete('js\myKNNDataset.json');

        auth()->user()->life_detection = null;
        auth()->user()->save();

        return redirect()->back()->with("success","Life Detection funtionality deactivated successfuly !");
    }

    /**
     * Load the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function load()
    {
        if(!auth()->user())
        {
            return redirect('')->with("error","You do not have access to that page. Authenticate please.");
        }
        
        return response()->file('js\myKNN.json');
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

    /**
     * Load the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function choice()
    {
        return view('lifedetection.choice');
    }

    /**
     * Load the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function validation()
    { 
        return view('lifedetection.validate');
    }
}
