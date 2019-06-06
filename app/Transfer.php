<?php

namespace UniqueBank;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'receiver_account_id', 'sender_account_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'receiver_account_id' => 'integer',
        'sender_account_id' => 'integer',
    ];

    protected $table = 'transfers';

    /**
     * Get the accounts which performed the transfers.
     */
    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }
}
