<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customerID';
    protected $fillable = [
        'customerCategoryID', 'name', 'company', 'contact', 'email', 'social', 'address', 'description', 'userID'
    ];

    public function category()
    {
        return $this->belongsTo('App\CustomerCategory', 'customerCategoryID');
    }

    public function accounts($customerID){
        $amount_add = CustomerAccounts::select('amount_add')->where('customerID', $customerID)->sum('amount_add');
        $amount_remove = CustomerAccounts::select('amount_remove')->where('customerID', $customerID)->sum('amount_remove');
        return ($amount_add - $amount_remove);
    }
}
