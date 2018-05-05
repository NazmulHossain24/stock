<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customers;
use App\CustomerCategory;

class CustomerController extends Controller
{
    public function index()
    {
        $table = Customers::orderBy('created_at', 'desc')->get();
        $category = CustomerCategory::orderBy('created_at', 'desc')->get();
        return view('customer.customer')->with(['table' => $table, 'category' => $category]);
    }

    public function save(Request $request)
    {
        $table = new Customers;
        $table->customerCategoryID = $request->customerCategoryID;
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
        $table = Customers::find($request->id);
        $table->customerCategoryID = $request->customerCategoryID;
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
        Customers::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
