<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    protected $table = 'purchase_transactions';
    protected $primaryKey = 'purchaseTransactionID';
    protected $fillable = [
        'receiptID', 'amount', 'paymentType', 'chequeNumber', 'bankName', 'issueDate', 'userID'
    ];

    public function receipt()
    {
        return $this->belongsTo('App\PurchaseReceipt', 'receiptID');
    }
}
