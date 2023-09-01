@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
        </div>
        <div class="filter-wp clearfix">
            <ul class="post-status fl-left">
                <a href="" class="text-primary">Tổng đơn hàng
                    <span class="text-muted">(<?php echo count($orders); ?>)</span>
                </a>
            </ul>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        {{-- <th>
                            <input type="checkbox" name="checkall">
                        </th> --}}
                        <th scope="col">STT</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders->total() > 0)
                    
                    @php
                        $t = 0;
                    @endphp
                    @foreach ($orders as $order)
                        @php
                            $t++;
                        @endphp
                    <tr>
                        <td>{{$t}}</td>
                        <td>{{$order->fullname}}</td>
                        <td>{{$order->phone}}</td>
                        <td><span class="badge badge-success">{{ $order->status }}</span></td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm rounded-0 text-white" type="button" 
                                data-toggle="modal" data-target="#confirmationModal{{$order->id}}">
                                <i class="fa fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="confirmationModal{{$order->id}}" tabindex="-1" role="dialog" 
                                aria-labelledby="confirmationModalLabel{{$order->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel{{$order->id}}">Xóa Đơn Hàng</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có chắc chắn xóa đơn hàng này không?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                            <a href="{{route('order.delete', $order->id)}}" class="btn btn-danger">Xóa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{$order->url = route('order.detail', $order->id)}}">Chi tiết <i
                                    class="fas fa-arrow-right"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="bg-white">Không tìm thấy đơn hàng nào</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>
</div>
@endsection