<?php

namespace App\Http\Controllers\stock;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;

class ProductStockController extends Controller
{
    public function index()
    {
        $table = Products::orderBy('created_at', 'desc')->where('type', 'General')->get();
        return view('stock.product')->with(['table' => $table]);
    }
}
