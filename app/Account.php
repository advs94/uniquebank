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
    protected $fillable = [
        'balance', 'pin', 'nib', 'iban', 'user_id', 'type', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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

    /**
     * Get the transfers performed by the accounts.
     */
    public function transfers()
    {
        return $this->belongsToMany(Transfer::class);
    }
}
