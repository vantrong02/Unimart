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
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <div class="form-group">
                    <form action="#">
                        <input type="" class="form-control form-search" name="keyword" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status' => 'in_of_stock'])}}" class="text-primary">Những sản phẩm còn hàng<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status' => 'out_of_stock'])}}" class="text-primary">Những sản phẩm hết hàng<span class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form action="{{url('admin/product/action')}}" method="">
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="act">
                    <option>Chọn</option>
                    @foreach ($list_act as $key => $act)
                        <option value="{{$key}}">{{$act}}</option>
                    @endforeach                   
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Người tạo</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($products->total() > 0)
                        
                    
                    @php
                        $t = 0;
                    @endphp
                    @foreach ($products as $product)
                    @php
                        $t++;
                    @endphp
                    <tr class="">
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{$product->id}}">
                        </td>
                        <td>{{$t}}</td>
                        <td><img src="{{asset($product->thumbnail)}}" width="65px" alt=""></td>
                        <td><a href="#">{{$product->name}}</a></td>
                        <td>{{number_format($product->price, 0, ',', '.')}}đ</td>
                        <td>{{$product->product_cat->name}}</td>
                        <td>{{$product->user->name}}</td>
                        <td>{{$product->created_at}}</td>
                        <td><span class="badge {{$product->status == 'Còn hàng'?'badge-success':'badge-dark'}}">{{$product->status}}</span></td>
                        <td>
                            <a href="{{route('product.edit', $product->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('product.delete', $product->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" onclick="return confirm('Bạn có chắc chắn xóa sản phẩm này không?')" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>     
                    @endforeach                           
                </tbody>
                @else
                        <tr>
                            <td colspan="10" class="bg-white">Không tìm thấy sản phẩm nào</td>
                        </tr>
                @endif
            </table>
        </form>
            {{$products->links()}}
        </div>
    </div>
</div>

@endsection