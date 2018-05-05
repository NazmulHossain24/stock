<?php

namespace App\Http\Controllers\income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    public function index()
    {
        return view('main');
    }
}
