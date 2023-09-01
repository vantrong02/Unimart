<?php

namespace App\Http\Controllers;

use App\User_clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function register(){
        return view('register.register');
    }

    public function storeaddClient(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required',
                'gender' => 'required',
                'phone' => 'required',
                'email' => 'required | email',
                'address' => 'required',
                'city' => 'required',
                'username' => 'required',
                'password' => 'required | min :8',
            ],
            [
                'required' => 'Vui lòng nhập :attribute!',
                'email' => ':attribute không đúng định dạng!',
                'min' => 'Vui lòng nhập lại :attribute có độ dài ít nhất 8 kí tự!'
            ],
            [
                'fullname' => 'tên',
                'gender' => 'giới tính',
                'phone' => 'điện thoại',
                'email' => 'email',
                'address' => 'địa chỉ',
                'city' => 'tỉnh/thành phố',
                'username' => 'tên đăng nhập',
                'password' => 'mật khẩu',
            ]
        );
        User_clients::create([
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        
        return redirect('register')->with('status', 'Thông tin quý khách đã được ghi nhận. Cảm ơn quý khách!');
    }
}
