@extends('layouts.admin')
@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <?php $data_bill = json_decode($order['bill_detail'], true); ?>
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail">{{$order->code}}</span>     
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail">{{ $order->address }}/ {{$order->city}}/ {{$order->phone}}</span>
                    </li>
                    <li>
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail">{{$order->pay}}</span>
                    </li>
                    {!! Form::open(['route' => ['order.update', $order->id], 'method' => 'POST', 'files' => true]) !!}
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select name="status">
                                <option selected='selected' value='Đang xử lý'>Đang xử lý</option>
                                <option value='Đang vận chuyển'>Đang vận chuyển</option>
                                <option value='Thành công'>Thành công</option> 
                                <option value='Hủy đơn hàng'>Hủy đơn hàng</option>                              
                            </select>
                            {!! Form::submit('Cập nhật đơn hàng', ['name' => 'btn_add', 'class' => 'btn btn-primary', 'id' => 'btn_update']) !!}
                        </li>
                    {!! Form::close() !!}
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $t = 0;
                                if(isset($data_bill))
                                    foreach ($data_bill as $bill) {
                                        $t++;
                                    ?>
                            <tr>
                                <td class="thead-text"><?php echo $t; ?></td>
                                <td class="thead-text-img">
                                    <div class="thumb">
                                        <img src="<?php echo asset($bill['options']['thumbnail']); ?>" alt="">
                                    </div>
                                </td>
                                <td class="thead-text"><?php echo $bill['name']; ?></td>
                                <td class="thead-text">{{number_format($bill['price'], 0, ',', '.')}} VNĐ</td>
                                <td class="thead-text"><?php echo $bill['qty']; ?></td>
                                <td class="thead-text">{{number_format($bill['subtotal'], 0, ',', '.')}} VNĐ</td>
                            </tr>
                            <?php 
                                    }   
                                    else{
                                        ?>
                                        <h1>Hiện tại không có sản phẩm nào!</h1>
                                        <?php
                                    }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Trạng thái</span>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee" style="font-weight: 700">{{ $order->status }}</span>
                            <span class="total-fee">{{ $order->bill_count }} sản phẩm</span>
                            <span class="total">{{ $order->bill_total }} VNĐ</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection