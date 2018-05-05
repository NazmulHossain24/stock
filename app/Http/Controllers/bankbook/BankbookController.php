<?php

namespace App\Http\Controllers\bankbook;

use App\Banks;
use App\BanksBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankbookController extends Controller
{
    public function index()
    {
        $table = BanksBook::orderBy('created_at', 'desc')->get();
        $bank = Banks::orderBy('created_at', 'desc')->get();
        return view('bankbook.bankbook')->with(['table' => $table, 'bank' => $bank]);
    }

    public function deposit(Request $request)
    {
        $table = new BanksBook();
        $table->bankID = $request->bankID;
        $table->amountDeposit = $request->amountDeposit;
        $table->paymentType = 'Deposit';
        $table->paymentDescription = $request->paymentDescription;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function withdraw(Request $request)
    {
        $table = new BanksBook();
        $table->bankID = $request->bankID;
        $table->amountWithdraw = $request->amountWithdraw;
        $table->paymentType = 'Withdraw';
        $table->paymentDescription = $request->paymentDescription;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }
}
