<?php

namespace UniqueBank;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'balance', 'pin', 'nib', 'iban', 'user_id', 'type', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'balance' => 'integer',
        'pin' => 'integer',
        'nib' => 'string',
        'iban' => 'string',
        'user_id' => 'integer',
    ];

    /**
     * Get the user that owns the accounts.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
