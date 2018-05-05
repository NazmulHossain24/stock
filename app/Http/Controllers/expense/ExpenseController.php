<?php

namespace App\Http\Controllers\expense;

use App\CashBook;
use App\Expense;
use App\ExpenseTransactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $table = ExpenseTransactions::orderBy('created_at', 'desc')->get();
        $category = Expense::orderBy('created_at', 'desc')->get();
        return view('expense.expanse')->with(['table' => $table, 'category' => $category]);
    }

    public function new_expense(Request $request){

        DB::beginTransaction();
        try {
        $table = new ExpenseTransactions;
        $table->expenseName = $request->expenseName;
        $table->amount = $request->amount;
        $table->save();
        $expenseTransactionsID = $table->expenseTransactionsID;

        $dis = [
            'expense' => $expenseTransactionsID,
            'withdraw' => 1
        ];

        $cashbook = new CashBook();
        $cashbook->amountWithdraw = $request->amount;
        $cashbook->paymentType = 'Cash Out';
        $cashbook->paymentDescription = gn_dis($dis);
        $cashbook->save();

            DB::commit();
        } catch (\Throwable $e) {
        DB::rollback();
        throw $e;
        }

        return back()->with('msg',  config('naz.success'));
    }
}
