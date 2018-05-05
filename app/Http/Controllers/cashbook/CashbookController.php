<?php

namespace App\Http\Controllers\cashbook;

use App\CashBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CashbookController extends Controller
{
    public function index()
    {
        $table = CashBook::orderBy('created_at', 'desc')->get();

        return view('cashbook.cashbook')->with(['table' => $table]);
    }

    public function deposit(Request $request)
    {
        $dis = [
            'deposit' => 1
        ];

        $cashbook = new CashBook();
        $cashbook->amountDeposit = $request->amountDeposit;
        $cashbook->paymentType = 'Cash In';
        $cashbook->paymentDescription = gn_dis($dis);
        $cashbook->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function withdraw(Request $request)
    {
        $dis = [
            'withdraw' => 1
        ];

        $cashbook = new CashBook();
        $cashbook->amountWithdraw = $request->amountWithdraw;
        $cashbook->paymentType = 'Cash Out';
        $cashbook->paymentDescription = gn_dis($dis);
        $cashbook->save();

        return back()->with('msg',  config('naz.success'));
    }
}
