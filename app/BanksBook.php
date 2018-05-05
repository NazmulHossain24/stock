<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanksBook extends Model
{
    protected $table = 'bank_book';
    protected $primaryKey = 'bankBookID';
    protected $fillable = [
        'bankID', 'amountDeposit', 'amountWithdraw', 'paymentDescription', 'paymentType', 'userID'
    ];

    public function bank()
    {
        return $this->belongsTo('App\Banks', 'bankID');
    }


}
