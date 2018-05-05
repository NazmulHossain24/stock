<?php

namespace App\Http\Controllers\purchase;

use App\Custom\AutoUser;
use App\ProductBook;
use App\Products;
use App\Purchase;
use App\PurchaseReceipt;
use App\PurchaseTransaction;
use App\Suppliers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function index()
    {
        $table = PurchaseReceipt::orderBy('created_at', 'desc')->where('checkOut',0)->get();
        return view('purchase.receipt')->with(['table' => $table]);
    }

    public function show_receipt($id){
        $receipt = PurchaseReceipt::find($id);
        $supplierID = $receipt->supplierID;
        $suppliers = Suppliers::find($supplierID);
        $transactions = PurchaseTransaction::where('receiptID', $id)->get();
        $table = Purchase::where('receiptID', $id)->where('isReturn',0)->get();
        $return_product = Purchase::where('receiptID', $id)->where('isReturn',1)->get();;
        return view('print.purchase.receipt_after')->with(['suppliers' => $suppliers, 'table' => $table, 'return_product' => $return_product, 'receipt' => $receipt, 'transactions' => $transactions]);
    }


    public function purchase_return($id){
        $data = [];
        $table = Purchase::where('receiptID', $id)->where('isReturn',0)->get();
        foreach ($table as $row){
            $rowData['name'] = $row->product['name'];
            $product = $row->product->ProductBrand['name'];
            $tiles = $row->product->ProductBrand['name'].", [".t_size($row->product->p_size['height'],$row->product->p_size['width'])."]";

            $re_qty = $row->return_item($id, $row->productID);

            if($row->product['type'] == 'Tiles'){
                $rowData['description'] = $tiles;
                $rowData['qty'] = ($row->quantity - $re_qty).' pcs/'.number_format(((($row->quantity - $re_qty) * $row->product->p_size['height'] * $row->product->p_size['width'])/144),2).' '.$row->product['unit'];
                $rowData['type'] =  'Tiles';
            }else{
                $rowData['description'] = $product;
                $rowData['qty'] = ($row->quantity - $re_qty).' '.$row->product['unit'];
                $rowData['type'] =  'Products';
            }
            $rowData['quantity'] = ($row->quantity - $re_qty);
            $rowData['id'] =  $row->purchaseID;
            $rowData['productID'] =  $row->productID;
            $rowData['unitPrice'] =  $row->unitPrice;

            $data[] = $rowData;
        }
        return response()->json($data);
    }

    public function return_item(Request $request){

        $receiptID = $request->receiptID;

        $quantity = $request->quantity;
        $my_data = $request->my_data;

        DB::beginTransaction();
        try {

            foreach ($my_data as $key => $value){
                if($quantity[$key] > 0){
                    $str =  $quantity[$key].'x'.$value;
                    $row_data = explode("x",$str);
                    $row['receiptID'] = $receiptID;
                    $row['quantity'] = $row_data[0];
                    $row['productID'] = $row_data[1];
                    $row['unitPrice'] = $row_data[2];
                    $row['isReturn'] = 1;

                    $product = Products::find($row_data[1]);
                    $stock1 = $product->stock;
                    $stock = $stock1 - $row_data[0];
                    $product->stock = $stock;
                    $product->save();

                    $productBook  = new ProductBook;
                    $productBook->productID = $row_data[1];
                    $productBook->qtyOut = $row_data[0];
                    $productBook->save();

                    Purchase::create($row);
                }

            }

            $receipt = PurchaseReceipt::find($receiptID);
            $paiedAmount = $receipt->paid($receiptID);
            $totalAmount1 = $receipt->bill($receiptID);
            $returnAmount = $receipt->re_bill($receiptID);
            $totalAmount = $totalAmount1 - $returnAmount;
            $status = new AutoUser;
            $payStuts = $status->payment_status2($totalAmount, $paiedAmount);
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
