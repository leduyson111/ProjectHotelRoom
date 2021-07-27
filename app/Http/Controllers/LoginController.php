<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function formLogin()
    {

        if (Auth::check()) {
            return redirect()->route('services');
        }

        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Hãy nhập tài khoản',
               
                'password.required' => 'Để trống sẽ không đăng nhập được'
            ]
        );


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) || Auth::attempt(['phone_number' => $request->email, 'password' => $request->password]) ) {
            // attempt trả ra là true/false
            return redirect()->route('admin');
        }

        return redirect()->back()->with('msg', 'Sai thông tin đăng nhâp');
    }
}
