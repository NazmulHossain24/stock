<?php

namespace App\Http\Controllers\expense;

use App\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $table = Expense::orderBy('created_at', 'desc')->get();
        return view('expense.category')->with(['table' => $table]);
    }

    public function save(Request $request)
    {
        $table = new Expense;
        $table->name = $request->name;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = Expense::find($request->id);
        $table->name = $request->name;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        Expense::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
