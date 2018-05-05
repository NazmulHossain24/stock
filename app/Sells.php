<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sells extends Model
{
    protected $table = 'sell';
    protected $primaryKey = 'sellID';
    protected $fillable = [
        'invoiceID', 'productID', 'quantity', 'buyPrice', 'unitPrice', 'discount', 'mainPrice', 'isReturn', 'userID'
    ];

    public function invoice()
    {
        return $this->belongsTo('App\SellInvoice', 'invoiceID');
    }

    public function product()
    {
        return $this->belongsTo('App\Products', 'productID');
    }

    public function scopeLedger($query)
    {
        $table = SellInvoice::select('invoiceID')->where('checkOut',0)->get();
        return $query->whereIn('invoiceID', $table);
    }

    public function return_item($invoiceID, $productID){
        $total = 0;
        $table =  Sells::select('quantity')->where('invoiceID', $invoiceID)->where('productID', $productID)->where('isReturn', 1)->get();
        foreach($table as $row){
            $total += $row->quantity;
        }
        return $total;
    }
}
