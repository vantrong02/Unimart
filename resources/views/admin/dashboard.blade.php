@extends('layouts.admin')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 16rem;">
                <div class="card-header">THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count[0]}}</h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count[1]}}</h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG VẬN CHUYỂN</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count[1]}}</h5>
                    <p class="card-text">Số lượng đơn hàng đang vận chuyển</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count[3]}}</h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">{{number_format($sales, 0, ',', '.')}} đồng</h5>
                    <p class="card-text">Doanh số toàn bộ hệ thống</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection