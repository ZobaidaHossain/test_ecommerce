<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        // dd(Hash::make(123456));
        if(!empty(Auth::check()))
        {
            return redirect('backend/dashboard');
        }
        return view('auth.login');
    }
    public function auth_login(Request $request)
    {
       $remember = !empty($request->remember) ? true : false;
       if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
           return redirect()->route('backend.admin.dashboard');
       } else {
           return redirect()->back()->with(['error' => 'Invalid email or password']);
       }
    }

    public function logout(){
        Auth::logout();
        return redirect(url('backend/'));
    }
}
