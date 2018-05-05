<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseReceipt extends Model
{
    protected $table = 'purchase_receipt';
    protected $primaryKey = 'receiptID';
    protected $fillable = [
        'supplierID', 'otherCost', 'status', 'note', 'checkOut', 'checkOutDate', 'userID'
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Suppliers', 'supplierID');
    }

    public function setCheckOutDateAttribute($value)
    {
        $this->attributes['checkOutDate'] = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
    }

    public function bill($receiptID)
    {
        $total = 0;
        $table =  Purchase::select( DB::raw('SUM(quantity * unitPrice) AS amount'))->where('receiptID', $receiptID)->where('isReturn', 0)->get();
        foreach($table as $row){
            $total += $row->amount;
        }
        return $total;
    }

    public function re_bill($receiptID)
    {
        $total = 0;
        $table =  Purchase::select( DB::raw('SUM(quantity * unitPrice) AS amount'))->where('receiptID', $receiptID)->where('isReturn', 1)->get();
        foreach($table as $row){
            $total += $row->amount;
        }
        return $total;
    }

    public function paid($receiptID)
    {
        $table = PurchaseTransaction::select('amount')->where('receiptID', $receiptID)->sum('amount');
        return $table;
    }

}
