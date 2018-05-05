<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBook extends Model
{
    protected $table = 'product_book';
    protected $primaryKey = 'productBookID';
    protected $fillable = [
        'productID', 'qtyIn', 'qtyOut', 'userID'
    ];

    public function product()
    {
        return $this->belongsTo('App\Products', 'productID');
    }
}
