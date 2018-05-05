<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCategory extends Model
{
    protected $table = 'customers_category';
    protected $primaryKey = 'customerCategoryID';
    protected $fillable = [
        'name', 'userID'
    ];
}
