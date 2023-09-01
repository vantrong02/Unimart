@extends('layouts.home')

@section('content')

<div id="main-content-wp" class="checkout-page">
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                {!! Form::open(['url' => 'checkout/storeaddOrder', 'method' => 'POST', 'files' => true, 'id' => 'myform']) !!}
                @if (session('status'))
                    <div class="alert__success">
                        <h6>{{ session('status') }}</h6>
                    </div>
                    @endif
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname">
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address">
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::content() as $row)
                        <tr class="cart-item">
                            <td class="product-name">{{$row->name}}<strong class="product-quantity">x {{$row->qty}}</strong></td>
                            <td class="product-total">{{number_format($row->total, 0, ',', '.')}}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price">{{Cart::total()}}đ</strong></td>
                        </tr>
                    </tfoot>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        <li>
                            <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                        <li>
                            <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                            <label for="direct-payment">Thanh toán qua thẻ ngân hàng</label>
                        </li>
                    </ul>
                </div>
                <div class="place-order-wp clearfix">
                    {!! Form::submit('Đặt hàng', ['name' => 'btn_add', 'class' => 'btn btn-primary', 'form' => 'myform']) !!}
                    {{-- <input type="submit" id="order-now" value="Đặt hàng"> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection