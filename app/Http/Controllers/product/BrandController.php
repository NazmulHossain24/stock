<?php

namespace App\Http\Controllers\product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductBrand;

class BrandController extends Controller
{
    public function index()
    {
        $table = ProductBrand::orderBy('created_at', 'desc')->where('type', 'General')->get();
        return view('products.brand')->with(['table' => $table]);
    }

    public function save(Request $request)
    {
        $table = new ProductBrand;
        $table->name = $request->name;
        $table->type = 'General';
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = ProductBrand::find($request->id);
        $table->name = $request->name;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        ProductBrand::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
