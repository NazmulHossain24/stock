<?php

namespace App\Http\Controllers\customer;

use App\CashBook;
use App\CustomerAccounts;
use App\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    public function index()
    {
        $table = Customers::orderBy('created_at', 'desc')->get();
        return view('customer.accounts')->with(['table' => $table]);
    }

    public function transactions($id){
        $table = CustomerAccounts::orderBy('created_at', 'desc')->where('customerID', $id)->get();
        $customer = Customers::find($id);
        return view('print.customer.accounts')->with(['table' => $table, 'customer' =>$customer]);
    }


    public function add(Request $request){

        DB::beginTransaction();
        try {
        $account = new CustomerAccounts;
        $account->customerID = $request->customerID;
        $account->amount_add = $request->amount_add;
        $account->type = 'Deposit';
        $account->save();
        $customerAccountsID = $account->customerAccountsID;

            $dis = [
                'customer' => $request->customerID,
                'customerAC' => $customerAccountsID,
                'deposit' => 1
            ];

            $cashbook = new CashBook();
            $cashbook->amountDeposit = $request->amount_add;
            $cashbook->paymentType = 'Cash In';
            $cashbook->paymentDescription = gn_dis($dis);
            $cashbook->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return back()->with('msg',  config('naz.success'));
    }

    public function withdraw(Request $request){

        DB::beginTransaction();
        try {
        $account = new CustomerAccounts;
        $account->customerID = $request->customerID;
        $account->amount_remove = $request->amount_remove;
        $account->type = 'Withdraw';
        $account->save();
        $customerAccountsID = $account->customerAccountsID;

            $dis = [
                'customer' => $request->customerID,
                'customerAC' => $customerAccountsID,
                'withdraw' => 1
            ];

            $cashbook = new CashBook();
            $cashbook->amountWithdraw = $request->amount_remove ;
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
