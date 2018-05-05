<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseTransactions extends Model
{
    protected $table = 'expense_transactions';
    protected $primaryKey = 'expenseTransactionsID';
    protected $fillable = [
        'expenseName', 'amount', 'userID'
    ];

}
