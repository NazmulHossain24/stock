<?php

namespace App\Http\Controllers\user;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $table = User::orderBy('created_at', 'desc')->get();
        return view('user.user')->with(['table' => $table]);
    }

    public function changes(Request $request)
    {
        $table = User::find($request->id);
        $table->roles = $request->roles;
        $table->save();
        return back()->with('msg',  config('naz.success'));
    }

    public function del($id)
    {
        User::destroy($id);
        return back()->with('msg',  config('naz.success'));
    }
}
