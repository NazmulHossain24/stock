<?php

namespace App\Http\Controllers\tiles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $table = ProductCategory::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();
        return view('tiles.category')->with(['table' => $table]);
    }

    public function save(Request $request)
    {
        $table = new ProductCategory;
        $table->name = $request->name;
        $table->type = 'Tiles';
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = ProductCategory::find($request->id);
        $table->name = $request->name;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        ProductCategory::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
