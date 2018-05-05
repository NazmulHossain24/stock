<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'productID';
    protected $fillable = [
        'name', 'type', 'grade', 'description', 'defaultSellPrice', 'defaultBuyPrice',
        'stock', 'inOrder', 'productCategoryID', 'productSizeID', 'productBrandID',
        'unit', 'userID'
    ];

    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'productCategoryID');
    }

    public function p_size()
    {
        return $this->belongsTo('App\ProductSize', 'productSizeID');
    }

    public function ProductBrand()
    {
        return $this->belongsTo('App\ProductBrand', 'productBrandID');
    }

    /*public function sell(){
        return $this->hasMany('App\Sells', 'productID');
    }

    public function purchase(){
        return $this->hasMany('App\Purchase', 'productID');
    }*/

}
