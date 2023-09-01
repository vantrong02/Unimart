<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(){
        return view('login.login');
    }
    public function checkLogin(Request $request)
    {
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'required' => 'Vui lòng nhập :attribute!',
                'min' => ':attribute có độ dài ít nhất 5 kí tự!'
            ],
            [
                'email' => 'tên đăng nhập',
                'password' => 'mật khẩu',
            ]
        );

        $arr = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(Auth::attempt($arr)){
            return redirect('home/dashboard');
        }else{
            return redirect('login')->with('status', 'Email hoặc mật khẩu không chính xác!');
        }
    }
}
