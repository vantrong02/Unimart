<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class AdminDashboardController extends Controller
{
    //
    function __construct(){
        $this->middleware(function($request, $next){
            session(['module_active' => 'dashboard']);
            return $next($request);
        });
    }
    function show(){
        $count_order_complete = Order::where('status', 'Thành công')->count();
        $count_order_handling = Order::where('status', 'Đang xử lý')->count();
        $count_order_shipping = Order::where('status', 'Đang vận chuyển')->count();
        $count_order_canceled = Order::where('status', 'Hủy đơn hàng')->count();

        $count = [$count_order_complete, $count_order_handling, $count_order_shipping, $count_order_canceled];

        $orders = Order::all();
        $sales = 0;
        foreach($orders as $order){
            $sales += $order->price;
        }
        return view('admin.dashboard', compact('count', 'sales'));
    }
}
