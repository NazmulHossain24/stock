<?php

namespace App\Http\Controllers\purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase;

class LedgerController extends Controller
{
    public function index()
    {
        $table = Purchase::orderBy('created_at', 'desc')->get();
        return view('purchase.ledger')->with(['table' => $table]);
    }
}
