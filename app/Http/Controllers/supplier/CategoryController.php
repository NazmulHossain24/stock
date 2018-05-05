<?php

namespace App\Http\Controllers\supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SuppliersCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $table = SuppliersCategory::orderBy('created_at', 'desc')->get();
        return view('supplier.category')->with(['table' => $table]);
    }

    public function save(Request $request)
    {
        $table = new SuppliersCategory;
        $table->name = $request->name;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = SuppliersCategory::find($request->id);
        $table->name = $request->name;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        SuppliersCategory::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
