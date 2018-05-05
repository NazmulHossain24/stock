<?php

namespace App\Http\Controllers\dashboard;

use App\ExpenseTransactions;
use App\Products;
use App\PurchaseReceipt;
use App\SellInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {

        $to_day = date('d/m/Y');
        $dates = date_range($to_day .' - '. $to_day);
        $dtatest = date_time_range($to_day .' - '. $to_day);

        $invoice = SellInvoice::where('checkOut', 0)->whereBetween('checkOutDate', [$dates[0], $dates[1]])->get();
        $bill = 0;
        $re_bill = 0;
        $payed_sell = 0;
        $discount = 0;
        foreach ($invoice as $row){
            $bill += $row->bill($row->invoiceID);
            $re_bill += $row->re_bill($row->invoiceID);
            $payed_sell += $row->paid($row->invoiceID);
            $discount += $row->discount;
        }
        $sell = $bill - ($re_bill + $discount);
        $sell_due = $sell - $payed_sell;

        $od_invoice = SellInvoice::where('checkOut', 1)->whereBetween('created_at', [$dtatest[0], $dtatest[1]])->get();
        $od_bill = 0;
        $od_re_bill = 0;
        $od_payed_sell = 0;
        $od_discount = 0;
        foreach ($od_invoice as $row){
            $od_bill += $row->bill($row->invoiceID);
            $od_re_bill += $row->re_bill($row->invoiceID);
            $od_payed_sell += $row->paid($row->invoiceID);
            $od_discount += $row->discount;
        }
        $od_sell = $od_bill - ($od_re_bill + $od_discount);

        $receipt = PurchaseReceipt::where('checkOut', 0)->whereBetween('checkOutDate', [$dates[0], $dates[1]])->get();
        $bill_re = 0;
        $re_bill_re = 0;
        $payed_purchase = 0;
        foreach ($receipt as $row){
            $bill_re += $row->bill($row->receiptID);
            $re_bill_re += $row->re_bill($row->receiptID);
            $payed_purchase += $row->paid($row->receiptID);
        }

        $purchase = $bill_re - $re_bill_re;

        $purchase_due = $purchase - $payed_purchase;

        $expense = ExpenseTransactions::select('amount')->whereBetween('created_at', [$dates[0], $dates[1]])->sum('amount');

        $tiles = Products::orderBy('created_at', 'desc')->where('type', 'Tiles')->where('stock', '<', 200)->get();
        $products = Products::orderBy('created_at', 'desc')->where('type', 'General')->where('stock', '<', 200)->get();


        $data = [
            'sell' => $sell,
            'orders' => $od_sell,
            'sell_due' => $sell_due,
            'purchase' => $purchase,
            'purchase_due' => $purchase_due,
            'expense' => $expense,
            'tiles_warn' => count($tiles),
            'products_warn' => count($products),
        ];

        return view('main')->with($data);
    }
}
