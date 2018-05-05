<?php

namespace App\Http\Controllers\sell;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sells;

class LedgerController extends Controller
{
    public function index()
    {

        $table = Sells::ledger()->orderBy('created_at', 'desc')->get();
        return view('sells.ledger')->with(['table' => $table]);
    }
}
