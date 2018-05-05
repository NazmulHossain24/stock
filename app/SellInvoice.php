<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SellInvoice extends Model
{
    protected $table = 'sell_invoice';
    protected $primaryKey = 'invoiceID';
    protected $fillable = [
        'customerID', 'status', 'discount', 'otherCost', 'note', 'checkOut', 'checkOutDate', 'userID'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customers', 'customerID');
    }

    public function setCheckOutDateAttribute($value)
    {
        $this->attributes['checkOutDate'] = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
    }

    public function bill($invoiceID)
    {
        $total = 0;
        $table =  Sells::select( DB::raw('SUM(quantity * unitPrice) AS amount'))->where('invoiceID', $invoiceID)->where('isReturn', 0)->get();
        foreach($table as $row){
            $total += $row->amount;
        }
        return $total;
    }

    public function re_bill($invoiceID)//return item bill
    {
        $total = 0;
        $table =  Sells::select( DB::raw('SUM(quantity * unitPrice) AS amount'))->where('invoiceID', $invoiceID)->where('isReturn', 1)->get();
        foreach($table as $row){
            $total += $row->amount;
        }
        return $total;
    }

    public function paid($invoiceID)
    {
        $table = SellTransaction::select('amount')->where('invoiceID', $invoiceID)->sum('amount');
        return $table;
    }

}
