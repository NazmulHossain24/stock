<?php

namespace App\Providers;


use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Banks;
use App\BanksBook;
use App\CashBook;
use App\CustomerAccounts;
use App\CustomerCategory;
use App\Expense;
use App\ExpenseTransactions;
use App\ProductBrand;
use App\ProductCategory;
use App\ProductDamage;
use App\Products;
use App\ProductSize;
use App\Purchase;
use App\PurchaseReceipt;
use App\PurchaseTransaction;
use App\SellInvoice;
use App\Sells;
use App\SellTransaction;
use App\Suppliers;
use App\SuppliersCategory;
use App\TempBuySell;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Banks::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Banks::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        BanksBook::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        BanksBook::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        CashBook::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        CashBook::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        CustomerAccounts::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        CustomerAccounts::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        CustomerCategory::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        CustomerCategory::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        Expense::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Expense::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        ExpenseTransactions::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        ExpenseTransactions::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        ProductBrand::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        ProductBrand::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        ProductCategory::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        ProductCategory::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        ProductDamage::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        ProductDamage::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Products::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Products::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        ProductSize::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        ProductSize::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Purchase::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Purchase::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        PurchaseReceipt::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        PurchaseReceipt::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        PurchaseTransaction::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        PurchaseTransaction::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        SellInvoice::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        SellInvoice::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Sells::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Sells::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        SellTransaction::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        SellTransaction::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Suppliers::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        Suppliers::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });


        SuppliersCategory::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        SuppliersCategory::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        TempBuySell::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });

        TempBuySell::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->userID = $userid;
        });






    }
}
