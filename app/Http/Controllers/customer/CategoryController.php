<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $table = CustomerCategory::orderBy('created_at', 'desc')->get();
        return view('customer.category')->with(['table' => $table]);
    }

    public function save(Request $request)
    {
        $table = new CustomerCategory;
        $table->name = $request->name;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = CustomerCategory::find($request->id);
        $table->name = $request->name;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        CustomerCategory::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
