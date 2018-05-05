<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'supplierID';
    protected $fillable = [
        'supplierCategoryID', 'name', 'company', 'contact', 'email', 'social', 'address', 'description', 'userID'
    ];

    public function category()
    {
        return $this->belongsTo('App\SuppliersCategory', 'supplierCategoryID');
    }
}
