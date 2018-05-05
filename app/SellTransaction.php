<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellTransaction extends Model
{
    protected $table = 'sell_transactions';
    protected $primaryKey = 'sellTransactionID';
    protected $fillable = [
        'invoiceID', 'amount', 'paymentType', 'chequeNumber', 'bankName', 'issueDate', 'userID'
    ];

    public function invoice()
    {
        return $this->belongsTo('App\SellInvoice', 'invoiceID');
    }
}
