<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;

class CartController extends Controller
{
    //
    function show(){
        // Lấy thông tin giỏ hàng từ session
        $cart = session('cart', []);

        return view('cart.show', ['cart' => $cart]);
        //return view('cart.show');
    }
    function add(Request $request, $id){
        //Cart::destroy();
        $product = Product::find($id);
        Cart::add([
            [
                'id' => $product->id, 
                'name' => $product->name, 
                'qty' => 1, 
                'price' => $product->price, 
                'options' => ['thumbnail' => $product->thumbnail]
            ]
        ]);
        // Lấy thông tin giỏ hàng từ session
        $cart = session('cart', []);

        // Thêm sản phẩm vào giỏ hàng
        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'options' => ['thumbnail' => $product->thumbnail]
        ];

        // Lưu thông tin giỏ hàng vào session
        session(['cart' => $cart]);

        return redirect('cart/show');
    }
    function remove($rowId){
        Cart::remove($rowId);
        // Lấy thông tin giỏ hàng từ session
        $cart = session('cart', []);

        // Xóa sản phẩm khỏi giỏ hàng trong session
        unset($cart[$rowId]);

        // Lưu thông tin giỏ hàng vào session
        session(['cart' => $cart]);

        return redirect('cart/show');
    }
    function destroy(){
        Cart::destroy();

        // Xóa thông tin giỏ hàng trong session
        session(['cart' => []]);

        return redirect('cart/show');
    }
    function update(Request $request){
        //dùng ajax để xử lý giỏ hàng
        $data = $request->json()->all();
        $id = $data['id'];
        $qty = $data['qty'];

        // Xử lý cập nhật giỏ hàng
        Cart::update($id, $qty);

        // Tính toán lại các giá trị liên quan đến giỏ hàng
        $sub_total = Cart::subtotal();
        $total = Cart::total();
        $num_order = Cart::count();

        // Gửi kết quả JSON về cho yêu cầu Ajax
        $response = [
            'sub_total' => $sub_total,
            'total' => $total,
            'num_order' => $num_order,
        ];

        return response()->json($response);
    }
}
