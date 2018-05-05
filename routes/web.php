<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'dashboard\HomeController@index');
    /*-------------------------------------------------------------*/
    Route::get('sell', 'sell\SellController@index')->middleware('sells');
    Route::post('sell/temp', 'sell\SellController@temp')->middleware('sells');
    Route::post('sell/edit', 'sell\SellController@edit')->middleware('sells');
    Route::get('sell/show_temp', 'sell\SellController@temp_list')->middleware('sells');
    Route::get('sell/del/{id}', 'sell\SellController@del')->middleware('sells');
    Route::post('sell/confirm_sell', 'sell\SellController@confirm_sell')->middleware('sells');
    Route::post('sell/new_sell', 'sell\SellController@new_sell')->middleware('sells');

    Route::get('sell/ledger', 'sell\LedgerController@index');

    Route::get('sell/invoice', 'sell\InvoiceController@index');
    Route::get('sell/invoice_info/{id}', 'sell\InvoiceController@show_invoice');
    Route::get('sell/sell_return/{id}', 'sell\InvoiceController@sell_return')->middleware('sells');
    Route::post('sell/return_item/', 'sell\InvoiceController@return_item')->middleware('sells');

    Route::get('sell/order', 'sell\OrderController@index');
    Route::get('sell/order/del/{id}/{status}', 'sell\OrderController@cancel_order')->middleware('sells');
    Route::post('sell/order/check_out', 'sell\OrderController@check_out')->middleware('sells');

    Route::get('sell/due', 'sell\DueController@index');
    Route::post('sell/payment/', 'sell\DueController@payments')->middleware('sells');
    Route::post('sell/payment_return/', 'sell\DueController@payments_return')->middleware('sells');
    /*-------------------------------------------------------------*/
    Route::get('purchase', 'purchase\PurchaseController@index')->middleware('sells');
    Route::post('purchase/temp', 'purchase\PurchaseController@temp')->middleware('sells');
    Route::post('purchase/edit', 'purchase\PurchaseController@edit')->middleware('sells');

    Route::get('purchase/show_temp', 'purchase\PurchaseController@temp_list')->middleware('sells');
    Route::get('purchase/del/{id}', 'purchase\PurchaseController@del')->middleware('sells');
    Route::post('purchase/confirm_purchase', 'purchase\PurchaseController@confirm_purchase')->middleware('sells');
    Route::post('purchase/new_purchase', 'purchase\PurchaseController@new_purchase')->middleware('sells');

    Route::get('purchase/ledger', 'purchase\LedgerController@index');

    Route::get('purchase/receipt', 'purchase\ReceiptController@index');
    Route::get('purchase/receipt_info/{id}', 'purchase\ReceiptController@show_receipt');
    Route::get('purchase/purchase_return/{id}', 'purchase\ReceiptController@purchase_return')->middleware('sells');
    Route::post('purchase/return_item/', 'purchase\ReceiptController@return_item')->middleware('sells');

    Route::get('purchase/due', 'purchase\DueController@index');
    Route::post('purchase/payment/', 'purchase\DueController@payments')->middleware('sells');
    Route::post('purchase/payment_return/', 'purchase\DueController@payments_return')->middleware('sells');
    /*-------------------------------------------------------------*/
    Route::get('stock', 'stock\TilesStockController@index');
    Route::get('stock/product', 'stock\ProductStockController@index');
    Route::get('stock/damage', 'stock\DamageController@index');
    /*-------------------------------------------------------------*/
    Route::get('tiles', 'tiles\TilesController@index');
    Route::post('tiles/save', 'tiles\TilesController@save')->middleware('sells');
    Route::post('tiles/edit', 'tiles\TilesController@edit')->middleware('sells');
    Route::get('tiles/del/{id}', 'tiles\TilesController@del')->middleware('sells');

    Route::get('tiles/category', 'tiles\CategoryController@index')->middleware('sells');
    Route::post('tiles/category/save', 'tiles\CategoryController@save')->middleware('sells');
    Route::post('tiles/category/edit', 'tiles\CategoryController@edit')->middleware('sells');
    Route::get('tiles/category/del/{id}', 'tiles\CategoryController@del')->middleware('sells');

    Route::get('tiles/brand', 'tiles\BrandController@index')->middleware('sells');
    Route::post('tiles/brand/save', 'tiles\BrandController@save')->middleware('sells');
    Route::post('tiles/brand/edit', 'tiles\BrandController@edit')->middleware('sells');
    Route::get('tiles/brand/del/{id}', 'tiles\BrandController@del')->middleware('sells');

    Route::get('tiles/size', 'tiles\SizeController@index')->middleware('sells');
    Route::post('tiles/size/save', 'tiles\SizeController@save')->middleware('sells');
    Route::post('tiles/size/edit', 'tiles\SizeController@edit')->middleware('sells');
    Route::get('tiles/size/del/{id}', 'tiles\SizeController@del')->middleware('sells');
    /*-------------------------------------------------------------*/
    Route::get('product', 'product\ProductController@index');
    Route::post('product/save', 'product\ProductController@save')->middleware('sells');
    Route::post('product/edit', 'product\ProductController@edit')->middleware('sells');
    Route::get('product/del/{id}', 'product\ProductController@del')->middleware('sells');

    Route::get('product/category', 'product\CategoryController@index')->middleware('sells');
    Route::post('product/category/save', 'product\CategoryController@save')->middleware('sells');
    Route::post('product/category/edit', 'product\CategoryController@edit')->middleware('sells');
    Route::get('product/category/del/{id}', 'product\CategoryController@del')->middleware('sells');

    Route::get('product/brand', 'product\BrandController@index')->middleware('sells');
    Route::post('product/brand/save', 'product\BrandController@save')->middleware('sells');
    Route::post('product/brand/edit', 'product\BrandController@edit')->middleware('sells');
    Route::get('product/brand/del/{id}', 'product\BrandController@del')->middleware('sells');
    /*-------------------------------------------------------------*/
    Route::get('customer', 'customer\CustomerController@index');
    Route::post('customer/save', 'customer\CustomerController@save')->middleware('sells');
    Route::post('customer/edit', 'customer\CustomerController@edit')->middleware('sells');
    Route::get('customer/del/{id}', 'customer\CustomerController@del')->middleware('sells');

    Route::get('customer/category', 'customer\CategoryController@index')->middleware('sells');
    Route::post('customer/category/save', 'customer\CategoryController@save')->middleware('sells');
    Route::post('customer/category/edit', 'customer\CategoryController@edit')->middleware('sells');
    Route::get('customer/category/del/{id}', 'customer\CategoryController@del')->middleware('sells');

    Route::get('customer/account', 'customer\AccountsController@index')->middleware('accountant');
    Route::get('customer/account/transactions/{id}', 'customer\AccountsController@transactions')->middleware('accountant');
    Route::post('customer/account/add', 'customer\AccountsController@add')->middleware('accountant');
    Route::post('customer/account/withdraw', 'customer\AccountsController@withdraw')->middleware('accountant');
    /*-------------------------------------------------------------*/
    Route::get('supplier', 'supplier\SupplierController@index');
    Route::post('supplier/save', 'supplier\SupplierController@save')->middleware('sells');
    Route::post('supplier/edit', 'supplier\SupplierController@edit')->middleware('sells');
    Route::get('supplier/del/{id}', 'supplier\SupplierController@del')->middleware('sells');

    Route::get('supplier/category', 'supplier\CategoryController@index')->middleware('sells');
    Route::post('supplier/category/save', 'supplier\CategoryController@save')->middleware('sells');
    Route::post('supplier/category/edit', 'supplier\CategoryController@edit')->middleware('sells');
    Route::get('supplier/category/del/{id}', 'supplier\CategoryController@del')->middleware('sells');
    /*-------------------------------------------------------------*/
    Route::get('expense', 'expense\ExpenseController@index')->middleware('accountant');
    Route::post('expense/new_expense', 'expense\ExpenseController@new_expense')->middleware('accountant');

    Route::get('expense/category', 'expense\CategoryController@index')->middleware('accountant');
    Route::post('expense/category/save', 'expense\CategoryController@save')->middleware('accountant');
    Route::post('expense/category/edit', 'expense\CategoryController@edit')->middleware('accountant');
    Route::get('expense/category/del/{id}', 'expense\CategoryController@del')->middleware('accountant');
    /*-------------------------------------------------------------*/
    Route::get('cashbook', 'cashbook\CashbookController@index')->middleware('accountant');
    Route::post('cashbook/deposit', 'cashbook\CashbookController@deposit')->middleware('accountant');
    Route::post('cashbook/withdraw', 'cashbook\CashbookController@withdraw')->middleware('accountant');
    /*-------------------------------------------------------------*/
    Route::get('bankbook', 'bankbook\BankbookController@index')->middleware('accountant');
    Route::post('bankbook/deposit', 'bankbook\BankbookController@deposit')->middleware('accountant');
    Route::post('bankbook/withdraw', 'bankbook\BankbookController@withdraw')->middleware('accountant');

    Route::get('bankbook/bank', 'bankbook\BankController@index')->middleware('accountant');
    Route::post('bankbook/bank/save', 'bankbook\BankController@save')->middleware('accountant');
    Route::post('bankbook/bank/edit', 'bankbook\BankController@edit')->middleware('accountant');
    Route::get('bankbook/bank/del/{id}', 'bankbook\BankController@del')->middleware('accountant');
    /*-------------------------------------------------------------*/
    Route::get('reports', 'reports\ReportController@index')->middleware('accountant');
    Route::post('reports/invoice', 'reports\ReportController@invoices')->middleware('accountant');
    Route::post('reports/invoice_order', 'reports\ReportController@invoice_order')->middleware('accountant');
    Route::post('reports/sell_ledger', 'reports\ReportController@sell_ledger')->middleware('accountant');
    Route::post('reports/receipt', 'reports\ReportController@receipt')->middleware('accountant');
    Route::post('reports/purchase_ledger', 'reports\ReportController@purchase_ledger')->middleware('accountant');
    Route::post('reports/tiles_stock', 'reports\ReportController@tiles_stock')->middleware('accountant');
    Route::post('reports/products_stock', 'reports\ReportController@products_stock')->middleware('accountant');
    Route::post('reports/tiles_stock_ledger', 'reports\ReportController@tiles_stock_ledger')->middleware('accountant');
    Route::post('reports/product_stock_ledger', 'reports\ReportController@product_stock_ledger')->middleware('accountant');
    Route::post('reports/expenses', 'reports\ReportController@expenses')->middleware('accountant');
    Route::post('reports/cash_book', 'reports\ReportController@cash_book')->middleware('accountant');
    Route::post('reports/bank_book', 'reports\ReportController@bank_book')->middleware('accountant');
    Route::post('reports/full_ledger', 'reports\ReportController@full_ledger')->middleware('accountant');
    Route::post('reports/profit_lose', 'reports\ReportController@profit_lose')->middleware('accountant');
    /*-------------------------------------------------------------*/
    Route::get('user', 'user\UserController@index')->middleware('admin');
    Route::post('user/changes', 'user\UserController@changes')->middleware('admin');
    Route::get('user/del/{id}', 'user\UserController@del')->middleware('admin');

    Route::get('no-access', 'NoAccessController@index');
});

Route::get('logout', 'LogOutController@index');


Auth::routes();


