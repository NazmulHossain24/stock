<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table = 'product_brand';
    protected $primaryKey = 'productBrandID';
    protected $fillable = [
        'name', 'type', 'userID'
    ];
}
