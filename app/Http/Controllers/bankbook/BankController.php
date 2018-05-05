<?php

namespace App\Http\Controllers\bankbook;

use App\Banks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    public function index()
    {
        $table = Banks::orderBy('created_at', 'desc')->get();
        return view('bankbook.bank')->with(['table' => $table]);
    }

    public function save(Request $request)
    {
        $table = new Banks;
        $table->name = $request->name;
        $table->AccountNumber = $request->AccountNumber;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function edit(Request $request)
    {
        $table = Banks::find($request->id);
        $table->name = $request->name;
        $table->AccountNumber = $request->AccountNumber;
        $table->save();

        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        Banks::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }

}
