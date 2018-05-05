<?php

namespace App\Http\Controllers\sell;

use App\CashBook;
use App\CustomerAccounts;
use App\ProductBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customers;
use App\Products;
use App\CustomerCategory;
use App\TempBuySell;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Sells;
use App\SellInvoice;
use App\SellTransaction;
use App\Custom\AutoUser;

class SellController extends Controller
{
    public function index()
    {
        $products = Products::orderBy('created_at', 'desc')->where('type', 'General')->get();
        $tiles = Products::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();
        $customers = Customers::orderBy('created_at', 'desc')->get();
        $category = CustomerCategory::orderBy('created_at', 'desc')->get();
        return view('sells.sells')->with(['products' => $products, 'tiles' => $tiles, 'customers' => $customers, 'category' => $category]);
    }

    public function temp(Request $request){
        $productID = $request->productID;
        $quantity = $request->quantity;
        $discount = $request->discount;
        $sellPrice  = $request->sellPrice;
        $buyPrice = $request->buyPrice;
        $percent = ($sellPrice * $discount) / 100;
        $mainSell = $sellPrice - $percent;

        $tempSell = TempBuySell::where('userID', Auth::id())->where('refType','Sell')->where('productID', $productID)->first();

        if($tempSell['productID'] == $productID){
            $table = TempBuySell::find($tempSell['tempID']);
            $table->quantity = $quantity;
            $table->sellPrice = $mainSell;
            $table->mainPrice = $sellPrice;
            $table->discount = $discount;
            $table->save();

            return 0;
        }else{
            $table = new TempBuySell;
            $table->productID = $productID;
            $table->quantity = $quantity;
            $table->sellPrice = $mainSell;
            $table->mainPrice = $sellPrice;
            $table->buyPrice = $buyPrice;
            $table->discount = $discount;
            $table->refType = 'Sell';
            $table->save();

            return 0;
        }

    }

    public function temp_list(){
        $data = [];
        $table = TempBuySell::where('userID', Auth::id())->where('refType','Sell')->get();
        $totalAmount = 0;

        foreach ($table as $row){
            $rowData['name'] = $row->product['name'];

            if($row->product['type'] == 'Tiles'){
                $rowData['description'] = $row->product['description'];
                $rowData['qty'] = $row->quantity.' pcs/'.number_format((($row->quantity * $row->product->p_size['height'] * $row->product->p_size['width'])/144),2).' '.$row->product['unit'];
            }else{
                $rowData['description'] = $row->product['description'];
                $rowData['qty'] = $row->quantity.' '.$row->product['unit'];
            }
            $rowData['price'] = money($row->quantity * $row->sellPrice);
            $rowData['quantity'] = $row->quantity;
            $rowData['rate'] =  $row->sellPrice;
            $rowData['discount'] =  $row->discount;
            $rowData['mainPrice'] =  $row->mainPrice;
            $rowData['id'] =  $row->tempID;
            $rowData['sell_price'] = money($row->sellPrice);
            $rowData['mainPrice2'] =  money($row->mainPrice);

            $totalAmount += ($row->quantity * $row->sellPrice);

            $data[] = $rowData;
        }

        return response()->json(['lists' => $data, 'totalAmount' => $totalAmount, 'totalAmount2' => money($totalAmount)]);
    }

    public function edit(Request $request)
    {
        $discount = $request->discount;
        $sellPrice  = $request->sellPrice;
        $percent = ($sellPrice * $discount) / 100;
        $mainSell = $sellPrice - $percent;

        $table = TempBuySell::find($request->tempID);
        $table->quantity = $request->quantity;
        $table->sellPrice = $mainSell;
        $table->mainPrice = $sellPrice;
        $table->discount = $discount;
        $table->save();

        return 0;
    }
    
    public function del($id)
    {
        TempBuySell::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }

    public function confirm_sell(Request $request){
        $customerID = $request->customerID;
        $paidAmount = $request->amount;
        $checkoutdate = $request->invoiceDate;
        $discount = $request->discount;
        $table = TempBuySell::where('userID', Auth::id())->where('refType','Sell')->get();
        $customers = Customers::where('customerID', $customerID)->first();

        return view('sells.confirm_sell')->with(['customer' => $customers, 'table' => $table, 'discount' => $discount, 'paidAmount' => $paidAmount, 'checkoutdate' => $checkoutdate]);

    }

    public function new_sell(Request $request){
        $customerID = $request->customerID;
        $paidAmount = $request->paidAmount;
        $checkoutdate = $request->checkOutDate;
        $totalAmount = $request->totalAmount;
        $discount = $request->discount;

        $table = TempBuySell::where('userID', Auth::id())->where('refType','Sell')->get();
        $customers = Customers::where('customerID', $customerID)->first();


        if(count($table) > 0){

            $status = new AutoUser;
            $payStuts = $status->payment_status($totalAmount, ($paidAmount + $discount));


            switch($request->submitbutton) {

                case 'confirm':

                    DB::beginTransaction();
                    try {

                        $customer_account = new CustomerAccounts;
                        $customer_account->amount_add = $paidAmount;
                        $customer_account->amount_remove = $totalAmount - $discount;
                        $customer_account->customerID = $customerID;
                        $customer_account->type = 'Buy';
                        $customer_account->save();
                        $customerAccountsID = $customer_account->customerAccountsID;

                        $invoice  = new SellInvoice;
                        $invoice->customerID = $customerID;
                        $invoice->status = $payStuts;
                        $invoice->checkOut = 0;
                        $invoice->checkOutDate = $checkoutdate;
                        $invoice->discount = $discount;
                        $invoice->save();

                        $invoiceID = $invoice->invoiceID;

                        if($paidAmount > 0){
                            $transection = new SellTransaction;
                            $transection->invoiceID = $invoiceID;
                            $transection->amount = $paidAmount;
                            $transection->paymentType = 'Cash';
                            $transection->save();
                        }

                        foreach ($table as $row){
                            $product =  Products::find($row->productID);
                            $stock = $product->stock;
                            $remain_stock = $stock - $row->quantity;
                            $product->stock = $remain_stock;
                            $product->save();

                            $sell  = new Sells;
                            $sell->invoiceID = $invoiceID;
                            $sell->productID = $row->productID;
                            $sell->quantity = $row->quantity;
                            $sell->buyPrice = $row->buyPrice;
                            $sell->unitPrice = $row->sellPrice;
                            $sell->discount = $row->discount;
                            $sell->mainPrice = $row->mainPrice;
                            $sell->isReturn = 0;
                            $sell->save();

                            $productBook  = new ProductBook;
                            $productBook->productID = $row->productID;
                            $productBook->qtyOut = $row->quantity;
                            $productBook->save();
                        }

                        if($paidAmount > 0){

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

                        TempBuySell::where('userID', Auth::id())->where('refType','Sell')->delete();

                        DB::commit();
                    } catch (\Throwable $e) {
                        DB::rollback();
                        throw $e;
                    }

                    return view('print.sell.invoice')->with(['customer' => $customers, 'table' => $table, 'invoiceID' => $invoiceID, 'discount' => $discount, 'paidAmount' => $paidAmount, 'checkoutdate' => $checkoutdate]);
                    break;

                case 'order':

                    DB::beginTransaction();
                    try {

                        if($paidAmount > 0){
                            $customer_account = new CustomerAccounts;
                            $customer_account->amount_add = $paidAmount;
                            $customer_account->customerID = $customerID;
                            $customer_account->type = 'Buy';
                            $customer_account->save();
                            $customerAccountsID = $customer_account->customerAccountsID;
                        }

                        $invoice  = new SellInvoice;
                        $invoice->customerID = $customerID;
                        $invoice->status = $payStuts;
                        $invoice->checkOut = 1;
                        $invoice->discount = $discount;
                        $invoice->save();

                        $invoiceID = $invoice->invoiceID;

                        if($paidAmount > 0){
                            $transection = new SellTransaction;
                            $transection->invoiceID = $invoiceID;
                            $transection->amount = $paidAmount;
                            $transection->paymentType = 'Cash';
                            $transection->save();
                        }

                        foreach ($table as $row){
                            $product =  Products::find($row->productID);
                            $inOrder = $product->inOrder;
                            $order_stock = $inOrder + $row->quantity;
                            $product->inOrder = $order_stock;
                            $product->save();

                            $sell  = new Sells;
                            $sell->invoiceID = $invoiceID;
                            $sell->productID = $row->productID;
                            $sell->quantity = $row->quantity;
                            $sell->buyPrice = $row->buyPrice;
                            $sell->unitPrice = $row->sellPrice;
                            $sell->discount = $row->discount;
                            $sell->mainPrice = $row->mainPrice;
                            $sell->isReturn = 0;
                            $sell->save();
                        }

                        if($paidAmount > 0){

                            $dis = [
                                //'invoice' => $invoiceID,
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

                        TempBuySell::where('userID', Auth::id())->delete();

                        DB::commit();
                    } catch (\Throwable $e) {
                        DB::rollback();
                        throw $e;
                    }

                    return redirect('sell/order')->with('msg',  config('naz.success'));
                    break;
            }
        }else{
            return redirect('sell');
        }
    }






}
