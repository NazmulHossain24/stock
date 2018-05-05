<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';
    protected $primaryKey = 'expenseID';
    protected $fillable = [
        'name', 'userID'
    ];
}
