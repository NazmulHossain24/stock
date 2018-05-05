<?php

namespace App\Http\Controllers\supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Suppliers;
use App\SuppliersCategory;

class SupplierController extends Controller
{
    public function index()
    {
        $table = Suppliers::orderBy('created_at', 'desc')->get();
        $category = SuppliersCategory::orderBy('created_at', 'desc')->get();
        return view('supplier.supplier')->with(['table' => $table, 'category' => $category]);
    }

    public function save(Request $request)
    {
        $table = new Suppliers;
        $table->supplierCategoryID = $request->supplierCategoryID;
        $table->name = $request->name;
        $table->contact = $request->contact;
        $table->company = $request->company;
        $table->email = $request->email;
        $table->address = $request->address;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = Suppliers::find($request->id);
        $table->supplierCategoryID = $request->supplierCategoryID;
        $table->name = $request->name;
        $table->contact = $request->contact;
        $table->company = $request->company;
        $table->email = $request->email;
        $table->address = $request->address;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        Suppliers::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
