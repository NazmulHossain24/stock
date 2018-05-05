<?php

namespace App\Http\Controllers\purchase;

use App\CashBook;
use App\ProductBook;
use App\Purchase;
use App\PurchaseReceipt;
use App\PurchaseTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Custom\AutoUser;
use App\Products;
use App\SuppliersCategory;
use App\Suppliers;
use App\TempBuySell;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $products = Products::orderBy('created_at', 'desc')->where('type', 'General')->get();
        $tiles = Products::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();
        $suppliers = Suppliers::orderBy('created_at', 'desc')->get();
        $category = SuppliersCategory::orderBy('created_at', 'desc')->get();

        return view('purchase.purchase')->with(['products' => $products, 'tiles' => $tiles, 'suppliers' => $suppliers, 'category' => $category]);
    }

    public function temp(Request $request){
        $productID = $request->productID;
        $quantity = $request->quantity;
        $sellPrice  = $request->sellPrice;
        $buyPrice = $request->buyPrice;

        $tempSell = TempBuySell::where('userID', Auth::id())->where('refType','Purchase')->where('productID', $productID)->first();

        if($tempSell['productID'] == $productID){
            $table = TempBuySell::find($tempSell['tempID']);
            $table->quantity = $quantity;
            $table->buyPrice = $buyPrice;
            $table->save();

            return 0;
        }else{
            $table = new TempBuySell;
            $table->productID = $productID;
            $table->quantity = $quantity;
            $table->sellPrice = $sellPrice;
            $table->buyPrice = $buyPrice;
            $table->refType = 'Purchase';
            $table->save();

            return 0;
        }

    }

    public function temp_list(){
        $data = [];
        $table = TempBuySell::where('userID', Auth::id())->where('refType','Purchase')->get();
        $totalAmount = 0;

        foreach ($table as $row){
            $rowData['name'] = $row->product['name'];
            $product = $row->product['description'];
            //$tiles = $row->product->ProductBrand['name'].", [".t_size($row->product->p_size['height'],$row->product->p_size['width'])."]";

            if($row->product['type'] == 'Tiles'){
                $rowData['description'] = $product;
                $rowData['qty'] = $row->quantity.' pcs/'.number_format((($row->quantity * $row->product->p_size['height'] * $row->product->p_size['width'])/144),2).' '.$row->product['unit'];
            }else{
                $rowData['description'] = $product;
                $rowData['qty'] = $row->quantity.' '.$row->product['unit'];
            }

            $rowData['price'] = money($row->quantity * $row->buyPrice);
            $rowData['quantity'] = $row->quantity;
            $rowData['rate'] =  $row->buyPrice;
            $rowData['id'] =  $row->tempID;
            $rowData['buy_price'] = money($row->buyPrice);

            $totalAmount += ($row->quantity * $row->buyPrice);

            $data[] = $rowData;
        }

        return response()->json(['lists' => $data, 'totalAmount' => $totalAmount, 'totalAmount2' => money($totalAmount)]);
    }

    public function edit(Request $request)
    {
        $table = TempBuySell::find($request->tempID);
        $table->quantity = $request->quantity;
        $table->buyPrice = $request->buyPrice;
        $table->save();

        return 0;
    }

    public function del($id)
    {
        TempBuySell::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }


    public function confirm_purchase(Request $request){
        $supplierID = $request->supplierID;
        $paidAmount = $request->amount;
        $checkoutdate = $request->receiptDate;
        $table = TempBuySell::where('userID', Auth::id())->where('refType','Purchase')->get();
        $suppliers = Suppliers::where('supplierID', $supplierID)->first();

        return view('purchase.confirm_purchase')->with(['supplier' => $suppliers, 'table' => $table, 'paidAmount' => $paidAmount, 'checkoutdate' => $checkoutdate]);
    }

    public function new_purchase(Request $request){
        $supplierID = $request->supplierID;
        $paidAmount = $request->paidAmount;
        $checkoutdate = $request->checkOutDate;
        $totalAmount = $request->totalAmount;

        $table = TempBuySell::where('userID', Auth::id())->where('refType','Purchase')->get();
        $suppliers = Suppliers::where('supplierID', $supplierID)->first();

        if(count($table) > 0){

            $status = new AutoUser;
            $payStuts = $status->payment_status2($totalAmount, $paidAmount);

            DB::beginTransaction();
            try {
                $receipt  = new PurchaseReceipt;
                $receipt->supplierID = $supplierID;
                $receipt->status = $payStuts;
                $receipt->checkOut = 0;
                $receipt->checkOutDate = $checkoutdate;
                $receipt->save();

                $receiptID = $receipt->receiptID;

                if($paidAmount > 0){
                    $transection = new PurchaseTransaction;
                    $transection->receiptID = $receiptID;
                    $transection->amount = $paidAmount;
                    $transection->paymentType = 'Cash';
                    $transection->save();

                    $dis = [
                        'receipt' => $receiptID,
                        'supplier' => $supplierID,
                        'withdraw' => 1
                    ];

                    $cashbook = new CashBook();
                    $cashbook->amountWithdraw = $paidAmount;
                    $cashbook->paymentType = 'Cash Out';
                    $cashbook->paymentDescription = gn_dis($dis);
                    $cashbook->save();
                }



                foreach ($table as $row){
                    $product =  Products::find($row->productID);
                    $stock = $product->stock;
                    $remain_stock = $stock + $row->quantity;
                    $product->stock = $remain_stock;
                    $product->save();

                    $sell  = new Purchase;
                    $sell->receiptID = $receiptID;
                    $sell->productID = $row->productID;
                    $sell->quantity = $row->quantity;
                    $sell->unitPrice = $row->buyPrice;
                    $sell->isReturn = 0;
                    $sell->save();

                    $productBook  = new ProductBook;
                    $productBook->productID = $row->productID;
                    $productBook->qtyIn = $row->quantity;
                    $productBook->save();
                }
                TempBuySell::where('userID', Auth::id())->where('refType','Purchase')->delete();

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

            return view('print.purchase.receipt')->with(['supplier' => $suppliers, 'receiptID' => $receiptID, 'table' => $table, 'paidAmount' => $paidAmount, 'checkoutdate' => $checkoutdate]);


        }else{
            return redirect('purchase');
        }
    }




}
