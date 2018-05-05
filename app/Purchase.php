<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';
    protected $primaryKey = 'purchaseID';
    protected $fillable = [
        'receiptID', 'productID', 'quantity', 'unitPrice', 'isReturn', 'userID'
    ];

    public function receipt()
    {
        return $this->belongsTo('App\PurchaseReceipt', 'receiptID');
    }

    public function product()
    {
        return $this->belongsTo('App\Products', 'productID');
    }

    public function return_item($receiptID, $productID){
        $total = 0;
        $table =  Purchase::select('quantity')->where('receiptID', $receiptID)->where('productID', $productID)->where('isReturn', 1)->get();
        foreach($table as $row){
            $total += $row->quantity;
        }
        return $total;
    }

}
