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
}
