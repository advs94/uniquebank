<?php

namespace UniqueBank\Http\Controllers;

use UniqueBank\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;
use Hash;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
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
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \UniqueBank\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $date = Carbon::now()->subYears(18)->format('d/m/Y');

        $data = request([
            'name', 'birth_date', 'email'
        ]);

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date_format:d/m/Y', 'before_or_equal:'.$date],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ])->validate();
        
        foreach ($user->getFillable() as $fillableAttribute)
        {
            $aux = explode('/', request($fillableAttribute));

            if(sizeof($aux) == 3 && checkdate((int) $aux[1], (int)$aux[0], (int)$aux[2]))
            {
                $temp = $aux[0];
                $aux[0] = $aux[2];
                $aux[2] = $temp;
                $user->$fillableAttribute = implode('-', $aux);
            }
            else if(strcmp($fillableAttribute, 'password') != 0)
            {
                $user->$fillableAttribute = request($fillableAttribute);           
            }
        }

        $user->save();

        return redirect()->back()->with("success","Profile changed successfully !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \UniqueBank\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // falta implementar o parametro is_deleted ou is_active
        // na configuração dos atributos de account
        // consequentemente falta implementar a funcionalidade
        // de apresentar apenas as contas ativas

        foreach ($user->accounts as $receiver_account) 
        {
            foreach ($receiver_account->transfers as $transfer) 
            {
                $sender_account = $transfer->accounts()->wherePivot('account_id', '!=', $receiver_account->id)->first();

                $receiver_account->transfers()->detach($transfer->id);
                $sender_account->transfers()->detach($transfer->id);

                $transfer->delete();
            }

            $receiver_account->delete();
        }

        $user->delete();

        return redirect('/users/profile');
    }

    /**
     * Show the form for editing the password of the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        $user = Auth::user();

        return view('users.password', compact('user'));
    }

    /**
     * Update the password of the specified resource in storage.
     *
     * @param  \UniqueBank\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(User $user)
    {
        $data = request([
            'current_password', 'new_password', 'new_password_confirmation'
        ]);

        Validator::make($data, [
            'current_password' => ['required', 'string', 'min:6', 'max:255'],
            'new_password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
            'new_password_confirmation' => ['required', 'string', 'min:6', 'max:255'],
        ])->validate();

        if (!(Hash::check($data['current_password'], $user->password)))
        {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($data['current_password'], $data['new_password']) == 0)
        {
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $user->password = bcrypt($data['new_password']);
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");
    }
}
