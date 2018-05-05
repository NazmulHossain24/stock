<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashBook extends Model
{
    protected $table = 'cash_book';
    protected $primaryKey = 'cashBookID';
    protected $fillable = [
        'amountDeposit', 'amountWithdraw', 'paymentDescription', 'paymentType', 'userID'
    ];
}
