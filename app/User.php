<?php

namespace uniquebank;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'birth_date', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
    ];

    /**
     * Get all of the user's accounts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getFillableAttributes()
    {
        $fillable = $this->getFillable();

        foreach ($fillable as $key => $value) {
            if(strcmp($value, 'password') == 0) {
                unset($fillable[$key]);
            }
        }

        return $fillable;
    }
}
