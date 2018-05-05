<?php

namespace App\Http\Controllers\sell;

use App\CashBook;
use App\Custom\AutoUser;
use App\CustomerAccounts;
use App\SellInvoice;
use App\SellTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DueController extends Controller
{
    public function index()
    {
        $table = SellInvoice::orderBy('created_at', 'desc')->where('checkOut',0)->where('status', '!=', 'Paid')->get();
        return view('sells.due')->with(['table' => $table]);
    }

    public function payments(Request $request){
        $invoiceID = $request->invoiceID;
        $customerID = $request->customerID;
        $discount = $request->discount;
        $paidAmount = $request->paidAmount;

        DB::beginTransaction();
        try {

            if($paidAmount > 0){

                $customer_account = new CustomerAccounts;
                $customer_account->amount_add = $paidAmount;
                $customer_account->customerID = $customerID;
                $customer_account->type = 'Buy';
                $customer_account->save();
                $customerAccountsID = $customer_account->customerAccountsID;

                $transection = new SellTransaction;
                $transection->invoiceID = $invoiceID;
                $transection->amount = $paidAmount;
                $transection->paymentType = 'Cash';
                $transection->save();

                $dis = [
                    'invoice' => $invoiceID,
                    'customer' => $customerID,
                    'customerAC' => $customerAccountsID,
                    'deposit' => 1
                ];

                $cashbook = new CashBook();
                $cashbook->amountDeposit = $paidAmount;
                $cashbook->paymentType = 'Cash In';
                $cashbook->paymentDescription = gn_dis($dis);
                $cashbook->save();

            }

            $invoce = SellInvoice::find($invoiceID);
            $paiedAmount1 = $invoce->paid($invoiceID);
            $totalAmount1 = $invoce->bill($invoiceID);
            $returnAmount = $invoce->re_bill($invoiceID);
            $old_discount = $invoce->discount;
            $totalAmount = $totalAmount1 - ($returnAmount + $old_discount + $discount);
            $status = new AutoUser;
            $payStuts = $status->payment_status($totalAmount, $paiedAmount1);
            $invoce->status = $payStuts;
            $invoce->discount = $old_discount + $discount;
            $invoce->save();


            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        return back()->with('msg',  config('naz.success'));
    }

    public function payments_return(Request $request){
        $invoiceID = $request->invoiceID;
        $customerID = $request->customerID;
        $returnAmount = $request->returnAmount;

        DB::beginTransaction();
        try {

            if($returnAmount > 0){

                $customer_account = new CustomerAccounts;
                $customer_account->amount_remove = $returnAmount;
                $customer_account->customerID = $customerID;
                $customer_account->type = 'Buy';
                $customer_account->save();
                $customerAccountsID = $customer_account->customerAccountsID;

                $transection = new SellTransaction;
                $transection->invoiceID = $invoiceID;
                $transection->amount = -$returnAmount;
                $transection->paymentType = 'Cash';
                $transection->save();

                $dis = [
                    'invoice' => $invoiceID,
                    'customer' => $customerID,
                    'customerAC' => $customerAccountsID,
                    'withdraw' => 1
                ];

                $cashbook = new CashBook();
                $cashbook->amountWithdraw = $returnAmount;
                $cashbook->paymentType = 'Cash Out';
                $cashbook->paymentDescription = gn_dis($dis);
                $cashbook->save();
            }

            $invoce = SellInvoice::find($invoiceID);
            $paiedAmount = $invoce->paid($invoiceID);
            $totalAmount1 = $invoce->bill($invoiceID);
            $returnAmount = $invoce->re_bill($invoiceID);
            $old_discount = $invoce->discount;
            $totalAmount = $totalAmount1 - ($returnAmount + $old_discount);
            $status = new AutoUser;
            $payStuts = $status->payment_status($totalAmount, $paiedAmount);
            $invoce->status = $payStuts;
            $invoce->save();


            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return back()->with('msg',  config('naz.success'));
    }
}
