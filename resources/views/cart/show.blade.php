@extends('layouts.home')

@section('content')

<div id="main-content-wp" class="cart-page">
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <p><strong>Hiện có {{Cart::count()}} sản phẩm trong giỏ hàng</strong></p>
                <form action="{{route('cart.update')}}" method="POST">
                    @if (Cart::total() > 0)
                        
                    
                    @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Stt</th>
                            <td scope="col">Ảnh</td>
                            <td scope="col">Tên sản phẩm</td>
                            <td scope="col">Giá</td>
                            <td scope="col">Số lượng</td>
                            <td scope="col">Thành tiền</td>
                            <td scope="col">Tác vụ</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @foreach (Cart::content() as $row)
                        @php
                            $t++;
                        @endphp
                        <tr>
                            <td scope="row">{{$t}}</td>
                            <td scope="col">
                                <a href="" title="" class="thumb">
                                    <img src="{{asset($row->options->thumbnail)}}" alt="">
                                </a>
                            </td>
                            <td scope="col">
                                <a href="" title="" class="name-product">{{$row->name}}</a>
                            </td>
                            <td scope="col">{{number_format($row->price, 0, ',', '.')}}đ</td>
                            <td scope="col">
                                <input type="number" min="1" style="width:50px; text-align: center" data-id="{{$row->rowId}}" name="qty[{{$row->rowId}}]" value="{{$row->qty}}" class="num_order">
                            </td>
                            <td scope="col" id="sub_total-{{$row->rowId}}">{{number_format($row->total, 0, ',', '.')}}đ</td>
                            <td scope="col">
                                <a href="{{route('cart.remove', $row->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach              
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span>{{Cart::total()}}đ</span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        {{-- <input type="submit" class="btn btn-primary" name="btn_update" value="Cập nhật giỏ hàng"> --}}
                                        <a href="{{route('checkout')}}" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>                  
                </table>
                @endif
            </form>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                {{-- @if (Cart::total() > 0)
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                @endif --}}
                <a href="{{route('dashboard')}}" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="{{route('cart.destroy')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>

@endsection