<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuppliersCategory extends Model
{
    protected $table = 'suppliers_category';
    protected $primaryKey = 'supplierCategoryID';
    protected $fillable = [
        'name', 'userID'
    ];
}
