<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    //
    public function checkoutClient(){
        return view('checkout.checkout');
    }

    public function storeaddOrder(Request $request){
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
                'pay' => 'required',
            ],
            [
                'required' => 'Vui lòng nhập :attribute!',
                'email' => ':attribute không đúng định dạng!',
                'integer' => 'Vui lòng nhập lại :attribute!',
                'regex' => ':attribute không đúng định dạng!',
                'min' => 'Vui lòng nhập lại :attribute có độ dài ít nhất 8 kí tự!'
            ],
            [
                'fullname' => 'tên',
                'gender' => 'giới tính',
                'phone' => 'số điện thoại',
                'email' => 'email',
                'address' => 'địa chỉ',
                'city' => 'tỉnh/thành phố',
                'username' => 'tên đăng nhập',
                'password' => 'mật khẩu',
                'pay' => 'Thanh toán',
            ]
        );
        Order::create([
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'username' => $request->username,
            'pay' => $request->pay,
            'bill_total' => Cart::total(),
            'bill_count' => Cart::count(),
            'bill_detail' => json_encode(Cart::content()),
            'password' => Hash::make($request->password),
        ]);
        $request->session()->put('fullname',$request->fullname);
        $request->session()->put('address',$request->address);
        $request->session()->put('email',$request->email);
        $request->session()->put('phone',$request->phone);
        $data = array(
            'fullname' => $request->session()->get('fullname'),
            'address' => $request->session()->get('address'),
            'email' => $request->session()->get('email'),
            'phone' => $request->session()->get('phone'),
        );
        Mail::to($request->email)->send(new OrderMail($data));
        return redirect('checkout')->with('status', 'Quý khách đặt hàng thành công. Vui lòng kiểm tra mail để xem chi tiết đơn hàng!');
    }

    public function listOrder(Request $request){
        return view('mails.listOrder');
    }
}
