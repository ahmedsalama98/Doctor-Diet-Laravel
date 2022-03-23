<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }



public function index(Request $request){

    return view('admin.pages.auth.login');
}

public function login(Request $request){


    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);




    if (Auth::attempt($credentials ,$request->remember)) {
        $request->session()->regenerate();
        // return $request;
        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


public function logout(Request $request){

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('admin.login');

}











}
