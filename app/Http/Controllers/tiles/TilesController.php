<?php

namespace App\Http\Controllers\tiles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\ProductBrand;
use App\ProductCategory;
use App\ProductSize;

class TilesController extends Controller
{
    public function index()
    {
        $table = Products::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();
        $category = ProductCategory::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();
        $size = ProductSize::orderBy('created_at', 'desc')->get();
        $brand = ProductBrand::orderBy('created_at', 'desc')->where('type', 'Tiles')->get();
        return view('tiles.tiles')->with(['table' => $table, 'category' =>  $category, 'size' => $size, 'brand' => $brand]);
    }

    public function save(Request $request)
    {
        $table = new Products;
        $table->name = $request->name;
        $table->grade = $request->grade;
        $table->defaultSellPrice = $request->defaultSellPrice;
        $table->defaultBuyPrice = $request->defaultBuyPrice;
        $table->productCategoryID = $request->productCategoryID;
        $table->productBrandID = $request->productBrandID;
        $table->productSizeID = $request->productSizeID;
        $table->type = 'Tiles';
        $table->unit = 'sqf';
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = Products::find($request->id);
        $table->name = $request->name;
        $table->grade = $request->grade;
        $table->defaultSellPrice = $request->defaultSellPrice;
        $table->defaultBuyPrice = $request->defaultBuyPrice;
        $table->productCategoryID = $request->productCategoryID;
        $table->productBrandID = $request->productBrandID;
        $table->productSizeID = $request->productSizeID;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        Products::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
