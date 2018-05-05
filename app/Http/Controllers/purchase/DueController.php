<?php

namespace App\Http\Controllers\purchase;

use App\CashBook;
use App\Custom\AutoUser;
use App\PurchaseReceipt;
use App\PurchaseTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DueController extends Controller
{
    public function index()
    {
        $table = PurchaseReceipt::orderBy('created_at', 'desc')->where('checkOut',0)->where('status', '!=', 'Paid')->get();
        return view('purchase.due')->with(['table' => $table]);
    }

    public function payments(Request $request){
        $receiptID= $request->receiptID;
        $paidAmount = $request->paidAmount;

        DB::beginTransaction();
        try {

            if($paidAmount > 0){
                $transection = new PurchaseTransaction;
                $transection->receiptID = $receiptID;
                $transection->amount = $paidAmount;
                $transection->paymentType = 'Cash';
                $transection->save();


                $dis = [
                    'receipt' => $receiptID,
                    'withdraw' => 1
                ];

                $cashbook = new CashBook();
                $cashbook->amountWithdraw = $paidAmount;
                $cashbook->paymentType = 'Cash Out';
                $cashbook->paymentDescription = gn_dis($dis);
                $cashbook->save();

            }

            $receipt = PurchaseReceipt::find($receiptID);
            $paiedAmount1 = $receipt->paid($receiptID);
            $totalAmount1 = $receipt->bill($receiptID);
            $returnAmount = $receipt->re_bill($receiptID);
            $totalAmount = $totalAmount1 - $returnAmount;
            $status = new AutoUser;
            $payStuts = $status->payment_status2($totalAmount, $paiedAmount1);
            $receipt->status = $payStuts;
            $receipt->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        return back()->with('msg',  config('naz.success'));

    }

    public function payments_return(Request $request){
        $receiptID= $request->receiptID;
        $returnAmount = $request->returnAmount;

        DB::beginTransaction();
        try {

            if($returnAmount > 0){
                $transection = new PurchaseTransaction;
                $transection->receiptID = $receiptID;
                $transection->amount = -$returnAmount;
                $transection->paymentType = 'Cash';
                $transection->save();

                $dis = [
                    'receipt' => $receiptID,
                    'deposit' => 1
                ];

                $cashbook = new CashBook();
                $cashbook->amountDeposit = $returnAmount;
                $cashbook->paymentType = 'Cash In';
                $cashbook->paymentDescription = gn_dis($dis);
                $cashbook->save();
            }

            $receipt = PurchaseReceipt::find($receiptID);
            $paiedAmount1 = $receipt->paid($receiptID);
            $totalAmount1 = $receipt->bill($receiptID);
            $returnAmount = $receipt->re_bill($receiptID);
            $totalAmount = $totalAmount1 - $returnAmount;
            $status = new AutoUser;
            $payStuts = $status->payment_status2($totalAmount, $paiedAmount1);
            $receipt->status = $payStuts;
            $receipt->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        return back()->with('msg',  config('naz.success'));
    }
}
