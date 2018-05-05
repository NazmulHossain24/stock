<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'product_size';
    protected $primaryKey = 'productSizeID';
    protected $fillable = [
        'height', 'width', 'userID'
    ];


}
