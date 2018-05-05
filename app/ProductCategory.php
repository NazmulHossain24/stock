<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $primaryKey = 'productCategoryID';
    protected $fillable = [
        'name', 'type', 'userID'
    ];
}
