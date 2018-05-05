<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDamage extends Model
{
    protected $table = 'product_damage';
    protected $primaryKey = 'damageID';
    protected $fillable = [
        'productID', 'quantity', 'buyPrice', 'description', 'userID'
    ];

    public function product()
    {
        return $this->belongsTo('App\Products', 'productID');
    }
}
