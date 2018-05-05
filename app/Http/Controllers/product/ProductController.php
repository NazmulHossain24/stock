<?php

namespace App\Http\Controllers\product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\ProductBrand;
use App\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        $table = Products::orderBy('created_at', 'desc')->where('type', 'General')->get();
        $category = ProductCategory::orderBy('created_at', 'desc')->where('type', 'General')->get();
        $brand = ProductBrand::orderBy('created_at', 'desc')->where('type', 'General')->get();
        return view('products.product')->with(['table' => $table, 'category' =>  $category, 'brand' => $brand]);
    }

    public function save(Request $request)
    {
        $table = new Products;
        $table->name = $request->name;
        $table->defaultSellPrice = $request->defaultSellPrice;
        $table->defaultBuyPrice = $request->defaultBuyPrice;
        $table->productCategoryID = $request->productCategoryID;
        $table->productBrandID = $request->productBrandID;
        $table->description = $request->description;
        $table->type = $request->type;
        $table->unit = $request->unit;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = Products::find($request->id);
        $table->name = $request->name;
        $table->defaultSellPrice = $request->defaultSellPrice;
        $table->defaultBuyPrice = $request->defaultBuyPrice;
        $table->productCategoryID = $request->productCategoryID;
        $table->productBrandID = $request->productBrandID;
        $table->description = $request->description;
        $table->unit = $request->unit;
        $table->type = $request->type;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        Products::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
