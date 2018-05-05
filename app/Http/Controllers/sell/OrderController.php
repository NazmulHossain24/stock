<?php

namespace App\Http\Controllers\sell;

use App\CashBook;
use App\Custom\AutoUser;
use App\CustomerAccounts;
use App\ProductBook;
use App\Products;
use App\SellInvoice;
use App\Sells;
use App\SellTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $table = SellInvoice::orderBy('created_at', 'desc')->where('checkOut',1)->get();
        return view('sells.orders')->with(['table' => $table]);
    }

    public function check_out(Request $request){
        $customerID = $request->customerID;
        $discount = $request->discount;
        $totalAmount = $request->totalAmount;
        $old_paid = $request->oldPaid;
        $paidAmount = $request->paidAmount;
        $checkOutDate = $request->checkOutDate;
        $invoiceID = $request->invoiceID;

        $status = new AutoUser;
        $payStuts = $status->payment_status($totalAmount, ($old_paid + $paidAmount + $discount));



        DB::beginTransaction();
        try {

            $customer_account = new CustomerAccounts;
            $customer_account->amount_add = $paidAmount;
            $customer_account->amount_remove = $totalAmount - $discount;
            $customer_account->customerID = $customerID;
            $customer_account->type = 'Buy';
            $customer_account->save();
            $customerAccountsID = $customer_account->customerAccountsID;

            $table = SellInvoice::find($invoiceID);
            $table->status = $payStuts;
            $table->checkOut = 0;
            $table->discount = $discount;
            $table->checkOutDate = $checkOutDate;
            $table->save();

            if($paidAmount > 0){
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

            $table = Sells::where('invoiceID', $invoiceID)->get();

            foreach ($table as $row){
                $product =  Products::find($row->productID);
                $stock = $product->stock;
                $remain_stock = $stock - $row->quantity;
                $inOrder = $product->inOrder;
                $remaining = $inOrder - $row->quantity;
                $product->inOrder = $remaining;
                $product->stock = $remain_stock;
                $product->save();

                $productBook  = new ProductBook;
                $productBook->productID = $row->productID;
                $productBook->qtyOut = $row->quantity;
                $productBook->save();
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        return back()->with('msg',  config('naz.success'));
    }

    public function cancel_order($id, $status)
    {
        if($status == 1){

            DB::beginTransaction();
            try {

                $table = Sells::select('quantity', 'productID', 'unitPrice')->where('invoiceID', $id)->get();
                foreach ($table as $row) {
                    $product = Products::find($row->productID);
                    $quantity = $row->quantity;
                    $inOrder = $product->inOrder;
                    $remaining = $inOrder - $quantity;
                    $product->inOrder = $remaining;
                    $product->save();

                }

                $paidAmount = SellTransaction::select('amount')->where('invoiceID', $id)->sum('amount');

                $invoice = SellInvoice::find($id);

                if($paidAmount > 0){
                    $customerID = $invoice->customerID;
                    $customer_account = new CustomerAccounts;
                    $customer_account->amount_remove = $paidAmount;
                    $customer_account->customerID = $customerID;
                    $customer_account->type = 'Buy';
                    $customer_account->save();
                    $customerAccountsID = $customer_account->customerAccountsID;

                    $dis = [
                        'customer' => $customerID,
                        'customerAC' => $customerAccountsID,
                        'withdraw' => 1
                    ];

                    $cashbook = new CashBook();
                    $cashbook->amountWithdraw = $paidAmount;
                    $cashbook->paymentType = 'Cash Out';
                    $cashbook->paymentDescription = gn_dis($dis);
                    $cashbook->save();

                }

                $invoice->delete();

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

            return back()->with('msg',  config('naz.success'));
        }else{
            return 'This is not an order. Please use valid information';
        }
    }
}
