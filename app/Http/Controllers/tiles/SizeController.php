<?php

namespace App\Http\Controllers\tiles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductSize;

class SizeController extends Controller
{
    public function index()
    {
        $table = ProductSize::orderBy('created_at', 'desc')->get();
        return view('tiles.size')->with(['table' => $table]);
    }

    public function save(Request $request)
    {
        $table = new ProductSize;
        $table->height = $request->height;
        $table->width = $request->width;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = ProductSize::find($request->id);
        $table->height = $request->height;
        $table->width = $request->width;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        ProductSize::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
