<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AdminOrderController extends Controller
{
    //
    function __construct(){
        $this->middleware(function($request, $next){
            session(['module_active' => 'order']);
            return $next($request);
        });
    }
    public function list(Request $request){
        $orders = Order::paginate(10);      
        return view('admin.order.list', compact('orders'));
    }
    public function detail($id){
        $order = Order::find($id);
        return view('admin.order.detail', compact('order'));
    }
    public function delete($id){
        $order = Order::find($id);
        $order->delete();
        return redirect('admin/order/list')->with('status', 'Đã xóa đơn hàng thành công');
    }
    public function update(Request $request, $id){
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();
        $data = [
            'fullname' => $order->fullname,
            'gender' => $order->gender,
            'phone' => $order->phone,
            'email' => $order->email,
            'address' => $order->address,
            'city' => $order->city,
            'status' => $order->status,
            'username' => $order->username,
            'pay' => $order->pay,
            'bill_total' => $order->bill_total,
            'bill_count' => $order->bill_count,
            'bill_detail' => $order->bill_detail,
            'password' => Hash::make($order->password),
        ];
        Mail::to($order->email)->send(new OrderMail($data));
        return redirect()->route('order.detail',$order->id)->with('status', 'Cập nhật đơn hàng thành công!');
    }
}
