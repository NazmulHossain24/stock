<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempBuySell extends Model
{
    protected $table = 'tempbuysell';
    protected $primaryKey = 'tempID';
    protected $fillable = [
        'productID', 'quantity', 'buyPrice', 'sellPrice', 'discount', 'mainPrice', 'otherCost', 'refType', 'userID'
    ];

    public function product()
    {
        return $this->belongsTo('App\Products', 'productID');
    }
}
