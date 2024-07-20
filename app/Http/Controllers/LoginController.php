<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;

class LoginController extends Controller
{
    public function loginForm(){

        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($credentials)){
            
            $request->session()->regenerate();

            return redirect()->route('admin');
        };
        return back()->withErrors([
            'password' => 'Thông tin đăng nhập không chính xác',
        ]);
    }

    public function register(Request $request){
        $request->merge(['password'=>Hash::make($request->password)]);
        try{
            User::create($request->all());
            $request->session()->put('success', 'Đăng ký tài khoản thành công ');
        }catch(\Throwable){

        }
        return redirect()->route('loginForm');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
    
}
