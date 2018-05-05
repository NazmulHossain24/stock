<?php

namespace App\Http\Controllers\reports;

use App\Banks;
use App\BanksBook;
use App\CashBook;
use App\Customers;
use App\Expense;
use App\ExpenseTransactions;
use App\ProductBook;
use App\ProductBrand;
use App\ProductCategory;
use App\Products;
use App\ProductSize;
use App\Purchase;
use App\PurchaseReceipt;
use App\SellInvoice;
use App\Sells;
use App\Suppliers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $products = Products::orderBy('created_at', 'desc')->where('type', 'General')->get();
        $products_category = ProductCategory::orderBy('created_at', 'desc')->where('type', 'General')->get();
        $products_brand = ProductBrand::orderBy('created_at', 'desc')->where('type', 'General')->get();

        $tiles = Products::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();
        $tiles_category = ProductCategory::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();
        $size = ProductSize::orderBy('created_at', 'desc')->get();
        $tiles_brand = ProductBrand::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();

        $customers = Customers::orderBy('created_at', 'desc')->get();
        $suppliers = Suppliers::orderBy('created_at', 'desc')->get();

        $expense = Expense::orderBy('created_at', 'desc')->get();

        $bank = Banks::orderBy('name', 'asc')->get();

        $month = CashBook::select(DB::raw('MONTH(created_at) as month'))->groupBy('month')->orderBy('created_at', 'ASC')->get();
        $year = CashBook::select(DB::raw('YEAR(created_at) as year'))->groupBy('year')->orderBy('created_at', 'ASC')->get();

        $send_data = [
            'products' => $products,
            'tiles' => $tiles,
            'customers' => $customers,
            'suppliers' => $suppliers,

            'products_category' => $products_category,
            'products_brand' => $products_brand,

            'tiles_category' => $tiles_category,
            'size' => $size,
            'tiles_brand' => $tiles_brand,

            'expense' => $expense,

            'bank' => $bank,
            'month' => $month,
            'year' => $year
        ];

        return view('reports.reports')->with($send_data);
    }

    public function invoices(Request $request){
        $customer = "All Customer";
        $date_range = "From Beginning to End Date";

        $tbl = SellInvoice::orderBy('created_at', 'desc');

        if($request->has('customerID')){
            $customers = Customers::find($request->customerID);
            $customer = $customers->name.' ['.$customers->contact.']';

            $tbl->where('customerID', $request->customerID);
        }

        if ($request->has('dateRange')){
            $date_range = $request->dateRange;

            $dtates = date_range($request->dateRange);
            $tbl->whereBetween('checkOutDate', [$dtates[0], $dtates[1]]);
        }

        if(!$request->has('status')){
            $tbl->where('status', 'Paid');
        }

        $table = $tbl->where('checkOut', 0)->get();

        return view('print.reports.invoice')->with(['table' => $table, 'customer' => $customer, 'date_range' => $date_range]);
    }

    public function invoice_order(Request $request){
        $customer = "All Customer";
        $date_range = "From Beginning to End Date";

        $tbl = SellInvoice::orderBy('created_at', 'desc');
        if($request->has('customerID')){
            $customers = Customers::find($request->customerID);
            $customer = $customers->name.' ['.$customers->contact.']';

            $tbl->where('customerID', $request->customerID);
        }

        if ($request->has('dateRange')){
            $date_range = $request->dateRange;

            $dtates = date_time_range($request->dateRange);
            $tbl->whereBetween('created_at', [$dtates[0], $dtates[1]]);
        }

        $table = $tbl->where('checkOut', 1)->get();

        return view('print.reports.order_invoice')->with(['table' => $table, 'customer' => $customer, 'date_range' => $date_range]);
    }

    public function sell_ledger(Request $request){
        $date_range = "From Beginning to End Date";
        $tbl = SellInvoice::select('invoiceID');
        if ($request->has('dateRange')){
            $date_range = $request->dateRange;

            $dtates = date_range($request->dateRange);
            $tbl->whereBetween('checkOutDate', [$dtates[0], $dtates[1]]);
        }
        $invoiceID = $tbl->where('checkOut',0)->get();

        $table = Sells::orderBy('invoiceID', 'desc');
        if($request->has('isReturn')){
            $table->where('isReturn', $request->isReturn);
        }
        $sells = $table->whereIn('invoiceID', $invoiceID)->get();

        return view('print.reports.sell_ledger')->with(['table' => $sells, 'date_range' => $date_range]);

    }

    public function receipt(Request $request){
        $supplier = "All Supplier";
        $date_range = "From Beginning to End Date";

        $tbl = PurchaseReceipt::orderBy('created_at', 'desc');
        if($request->has('supplierID')){
            $suppliers = Suppliers::find($request->supplierID);
            $supplier = $suppliers->name.' ['.$suppliers->contact.']';

            $tbl->where('supplierID', $request->supplierID);
        }

        if ($request->has('dateRange')){
            $date_range = $request->dateRange;

            $dtates = date_range($request->dateRange);
            $tbl->whereBetween('checkOutDate', [$dtates[0], $dtates[1]]);
        }

        if(!$request->has('status')){
            $tbl->where('status', 'Paid');
        }

        $table = $tbl->where('checkOut', 0)->get();

        return view('print.reports.receipt')->with(['table' => $table, 'supplier' => $supplier, 'date_range' => $date_range]);
    }


    public function purchase_ledger(Request $request){
        $date_range = "From Beginning to End Date";
        $tbl = PurchaseReceipt::select('receiptID');
        if ($request->has('dateRange')){
            $date_range = $request->dateRange;

            $dtates = date_range($request->dateRange);
            $tbl->whereBetween('checkOutDate', [$dtates[0], $dtates[1]]);
        }
        $receiptID = $tbl->where('checkOut',0)->get();

        $table = Purchase::orderBy('receiptID', 'desc');
        if($request->has('isReturn')){
            $table->where('isReturn', $request->isReturn);
        }
        $purchase = $table->whereIn('receiptID', $receiptID)->get();

        return view('print.reports.purchase_ledger')->with(['table' => $purchase, 'date_range' => $date_range]);
    }

    public function tiles_stock(Request $request){
        $tbl = Products::orderBy('stock', 'desc');
        if($request->has('productCategoryID')){
            $tbl->where('productCategoryID', $request->productCategoryID);
        }

        if($request->has('productBrandID')){
            $tbl->where('productBrandID', $request->productBrandID);
        }

        if($request->has('productSizeID')){
            $tbl->where('productSizeID', $request->productSizeID);
        }

        if($request->has('grade')){
            $tbl->whereIn('grade', $request->grade);
        }

        $table = $tbl->where('type', 'Tiles')->get();

        return view('print.reports.tiles_stock')->with(['table' => $table]);

    }

    public function products_stock(Request $request){
        $tbl = Products::orderBy('stock', 'desc');
        if($request->has('productCategoryID')){
            $tbl->where('productCategoryID', $request->productCategoryID);
        }

        if($request->has('productBrandID')){
            $tbl->where('productBrandID', $request->productBrandID);
        }

        $table = $tbl->where('type', 'General')->get();

        return view('print.reports.products_stock')->with(['table' => $table]);
    }

    public function tiles_stock_ledger(Request $request){
        $product = Products::find($request->productID);
        $tbl = ProductBook::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(qtyIn) as quantity_in'), DB::raw('SUM(qtyOut) as quantity_out'));
        if ($request->has('dateRange')){
            $dtates = date_time_range($request->dateRange);
            $tbl->whereBetween('created_at', [$dtates[0], $dtates[1]]);
        }
        $table = $tbl->groupBy('date')->where('productID', $request->productID)->orderBy('created_at', 'desc')->get();

        return view('print.reports.tiles_stock_ledger')->with(['table' => $table, 'product' => $product]);
    }

    public function product_stock_ledger(Request $request){
        $product = Products::find($request->productID);
        $tbl = ProductBook::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(qtyIn) as quantity_in'), DB::raw('SUM(qtyOut) as quantity_out'));
        if ($request->has('dateRange')){
            $dtates = date_time_range($request->dateRange);
            $tbl->whereBetween('created_at', [$dtates[0], $dtates[1]]);
        }
        $table = $tbl->groupBy('date')->where('productID', $request->productID)->orderBy('created_at', 'desc')->get();

        return view('print.reports.products_stock_ledger')->with(['table' => $table, 'product' => $product]);
    }

    public function expenses(Request $request){
        $expense = "All Expense";
        $date_range = "From Beginning to End Date";
        $tbl = ExpenseTransactions::orderBy('created_at', 'desc');
        if($request->has('expenseName')){
            $expense = $request->expenseName;
            $tbl->where('expenseName', $request->expenseName);
        }

        if ($request->has('dateRange')){
            $date_range = $request->dateRange;
            $dtates = date_time_range($request->dateRange);
            $tbl->whereBetween('created_at', [$dtates[0], $dtates[1]]);
        }

        $table = $tbl->get();

        return view('print.reports.expense')->with(['table' => $table, 'expense' => $expense, 'date_range' => $date_range]);
    }

    public function cash_book(Request $request){
        $date_range = "From Beginning to End Date";
        $tbl = CashBook::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amountWithdraw) as cash_out'), DB::raw('SUM(amountDeposit) as cash_in'));
        if ($request->has('dateRange')){
            $date_range = $request->dateRange;
            $dtates = date_time_range($request->dateRange);
            $tbl->whereBetween('created_at', [$dtates[0], $dtates[1]]);
        }
        $table = $tbl->groupBy('date')->orderBy('created_at', 'desc')->get();

        return view('print.reports.cash_book')->with(['table' => $table, 'date_range' => $date_range]);
    }

    public function bank_book(Request $request){
        $bank = "All Bank Accounts";
        $date_range = "From Beginning to End Date";
        $tbl = BanksBook::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amountWithdraw) as withdraw'), DB::raw('SUM(amountDeposit) as deposit'));
        if ($request->has('dateRange')){
            $date_range = $request->dateRange;
            $dtates = date_time_range($request->dateRange);
            $tbl->whereBetween('created_at', [$dtates[0], $dtates[1]]);
        }

        if($request->has('bankID')){
            $banks = Banks::find($request->bankID);
            $bank = $banks->name.' ['.$banks->AccountNumber.']';

            $tbl->where('bankID', $request->bankID);
        }
        $table = $tbl->groupBy('date')->orderBy('created_at', 'desc')->get();

        return view('print.reports.bank_book')->with(['table' => $table, 'bank' => $bank, 'date_range' => $date_range]);
    }

    public function full_ledger(Request $request){
        $month = $request->month;
        $year = $request->year;
        $genDate = gn_date($month, $year);
        $full_data = [];
        $month_name = date('F', mktime(0, 0, 0, $month, 10));


        foreach ($genDate as $m_date){
            $dtates = date_range($m_date .' - '. $m_date);
            $dtatest = date_time_range($m_date .' - '. $m_date);
            $invoice = SellInvoice::where('checkOut', 0)->whereBetween('checkOutDate', [$dtates[0], $dtates[1]])->get();
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

            $receipt = PurchaseReceipt::where('checkOut', 0)->whereBetween('checkOutDate', [$dtates[0], $dtates[1]])->get();
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

            $expense = ExpenseTransactions::select('amount')->whereBetween('created_at', [$dtatest[0], $dtatest[1]])->sum('amount');

            $full_data[] = ['date' => $m_date, 'sell' => $sell, 'purchase_due' => $purchase_due, 'sell_due' => $sell_due, 'payed_sell' => $payed_sell, 'payed_purchase' => $payed_purchase, 'purchase' => $purchase, 'expense' => $expense];
        }

        return view('print.reports.monthly_ledger')->with(['table' => $full_data, 'year' => $year, 'months' => $month_name,]);
    }

    public function profit_lose(Request $request){
        $month = $request->month;
        $year = $request->year;
        $genDate = gn_date($month, $year);
        $full_data = [];
        $month_name = date('F', mktime(0, 0, 0, $month, 10));

        foreach ($genDate as $m_date){
            $dtates = date_range($m_date .' - '. $m_date);
            $dtatest = date_time_range($m_date .' - '. $m_date);
            $invoice = SellInvoice::where('checkOut', 0)->whereBetween('checkOutDate', [$dtates[0], $dtates[1]])->get();
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

            $receipt = PurchaseReceipt::where('checkOut', 0)->whereBetween('checkOutDate', [$dtates[0], $dtates[1]])->get();
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

            $expense = ExpenseTransactions::select('amount')->whereBetween('created_at', [$dtatest[0], $dtatest[1]])->sum('amount');

            $full_data[] = ['date' => $m_date, 'sell' => $sell, 'purchase_due' => $purchase_due, 'sell_due' => $sell_due, 'payed_sell' => $payed_sell, 'payed_purchase' => $payed_purchase, 'purchase' => $purchase, 'expense' => $expense];
        }

        return view('print.reports.profit_lose')->with(['table' => $full_data, 'year' => $year, 'months' => $month_name,]);
    }



}
