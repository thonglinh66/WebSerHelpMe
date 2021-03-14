<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    public function index(Request $request)
    {
        if(!Auth::check() && $request->path() != 'login'){
            dd(Auth::check());
            return redirect('/login');
        }
        return view('admin/index');
    }
}
