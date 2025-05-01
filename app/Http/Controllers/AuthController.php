<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth/login');
    }

    public function loginProses(Request $request){
       $request->validate([
            'email' => 'required',
            'password' => 'required|min:8',
       ],[
        'email.required'          => 'Email tidak boleh kosong',
        'password.required'       => 'Password tidak boleh kosong',
        'password.min'            => 'Password minimal 8 karakter',
       ]);

       $data = array(
            'email'            => $request->email,
            'password'         => $request->password,
       );
      
       if (auth::attempt($data)) {
            return redirect()->route('dashboard')->with('success', 'Anda berhasil login');
       } else {
            return redirect()->back()->with('error', 'Email Atau Password Salah');
       }
    }

     public function logout(){
          Auth::logout();
          
          return redirect()->route('login')->with('success', 'Anda Berhasil logout');
       }
    
}
