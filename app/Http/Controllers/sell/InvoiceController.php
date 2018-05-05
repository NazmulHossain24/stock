<?php

namespace App\Http\Controllers\sell;

use App\Custom\AutoUser;
use App\CustomerAccounts;
use App\Customers;
use App\ProductBook;
use App\Products;
use App\SellInvoice;
use App\Sells;
use App\SellTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $table = SellInvoice::orderBy('created_at', 'desc')->where('checkOut',0)->get();
        return view('sells.invoices')->with(['table' => $table]);
    }

    public function show_invoice($id){
        $invoice = SellInvoice::find($id);
        $customerID = $invoice->customerID;
        $customers = Customers::find($customerID);
        $transactions = SellTransaction::where('invoiceID', $id)->get();
        $table = Sells::where('invoiceID', $id)->where('isReturn',0)->get();
        $return_product = Sells::where('invoiceID', $id)->where('isReturn',1)->get();
        return view('print.sell.invoice_after')->with(['customer' => $customers, 'return_product' => $return_product, 'table' => $table, 'invoice' => $invoice, 'transactions' => $transactions]);
    }

    public function sell_return($id){
        $data = [];
        $table = Sells::where('invoiceID', $id)->where('isReturn',0)->get();
        foreach ($table as $row){
            $rowData['name'] = $row->product['name'];
            $product = $row->product['description'];
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
            $rowData['id'] =  $row->sellID;
            $rowData['productID'] =  $row->productID;
            $rowData['buyPrice'] =  $row->buyPrice;
            $rowData['unitPrice'] =  $row->unitPrice;

            $data[] = $rowData;
        }
        return response()->json($data);
    }

    public function return_item(Request $request){

        $invoiceID = $request->invoiceID;

        $quantity = $request->quantity;
        $my_data = $request->my_data;

        DB::beginTransaction();
        try {

            $returnTotalPirce = 0;
            foreach ($my_data as $key => $value){
                if($quantity[$key] > 0){
                    $str =  $quantity[$key].'x'.$value;
                    $row_data = explode("x",$str);
                    $row['invoiceID'] = $invoiceID;
                    $row['quantity'] = $row_data[0];
                    $row['productID'] = $row_data[1];
                    $row['buyPrice'] = $row_data[2];
                    $row['unitPrice'] = $row_data[3];
                    $row['isReturn'] = 1;

                    $returnTotalPirce += ($row_data[3] * $row_data[0]);

                    $product = Products::find($row_data[1]);
                    $stock1 = $product->stock;
                    $stock = $stock1 + $row_data[0];
                    $product->stock = $stock;
                    $product->save();

                    $productBook  = new ProductBook;
                    $productBook->productID = $row_data[1];
                    $productBook->qtyIn = $row_data[0];
                    $productBook->save();

                    Sells::create($row);
                }

            }

            $invoce = SellInvoice::find($invoiceID);
            $paiedAmount = $invoce->paid($invoiceID);
            $totalAmount1 = $invoce->bill($invoiceID);
            $returnAmount = $invoce->re_bill($invoiceID);
            $totalAmount = $totalAmount1 - $returnAmount;
            $status = new AutoUser;
            $payStuts = $status->payment_status($totalAmount, $paiedAmount);
            $invoce->status = $payStuts;
            $invoce->save();

            if($returnTotalPirce > 0){
                $customer_account = new CustomerAccounts;
                $customer_account->amount_add = $returnTotalPirce;
                $customer_account->customerID = $invoce->customerID;
                $customer_account->type = 'Buy';
                $customer_account->save();
            }


            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return back()->with('msg',  config('naz.success'));

    }

}
