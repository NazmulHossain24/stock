<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAccounts extends Model
{
    protected $table = 'customer_accounts';
    protected $primaryKey = 'customerAccountsID';
    protected $fillable = [
        'customerID', 'amount_add', 'amount_remove', 'type', 'comment', 'userID'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customers', 'customerID');
    }

}
