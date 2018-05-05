<?php

namespace App\Http\Controllers\stock;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;

class TilesStockController extends Controller
{
    public function index()
    {
        $table = Products::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();
        return view('stock.tiles')->with(['table' => $table]);
    }
}
