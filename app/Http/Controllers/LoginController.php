<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(){
        return view('Login.login');
    }

    function actionLogin(Request $request){
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        // return back()->with('pesan', 'login failed!');

        // sementara menggunakan ini dikarenakan developer lupa logic
        // if ($request->input('name') == 'admin') {
        //     if ($request->input('email') == 'admin@gmail.com') {
        //         if ($request->input('password') == 'admin') {
        //             return redirect(route('home'));
        //         }
        //     }
        // }

        return back()->with('pesan', 'login failed!');
    }

    function logout(){
        Auth::logout();
 
        request()->session()->invalidate();
     
        request()->session()->regenerateToken();
     
        return redirect(route('login'));
    }
}
