@extends('layouts.admin')

@section('content')
    
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục 
                </div>
                <div class="card-body">
                    <form action="{{url('admin/product/cat/store_cat')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="url">Tên đường dẫn (Ví dụ: Tên danh mục là: Máy tính thì tên đường dẫn là: may-tinh)</label>
                            <input class="form-control" type="text" name="url" id="url">
                        </div>
                        <div class="form-group">
                            <label for="">Người tạo</label>
                            <select class="form-control" id="" name="list_created_user">
                                <option>Chọn người tạo</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục cha</label>
                            <select class="form-control" id="" name="parent_cat">
                                <option>Chọn danh mục</option>
                                <option value="0">Là danh mục cha</option>
                                @foreach ($product_cats as $product_cat)
                                    <option value="{{$product_cat->id}}"><?php echo str_repeat('|--', $product_cat->parent_id) . $product_cat->name; ?></option>
                                @endforeach                             
                            </select>
                        </div>
                        <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-header font-weight-bold">
                    Danh sách danh mục sản phẩm
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $t = 0;
                            @endphp
                            @foreach ($product_cats as $product_cat)
                            @php
                                $t++;
                            @endphp
                            <tr>
                                <th scope="row">{{$t}}</th>
                                <td>{{$product_cat->name}}</td>
                                <td>{{$product_cat->user->name}}</td>
                                <td>{{$product_cat->created_at}}</td>
                                <td>
                                    <a href="{{route('product.edit_cat', $product_cat->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>                     
                                    <a href="{{route('product.delete_cat', $product_cat->id)}}" onclick="return confirm('Bạn có chắc chắn xóa danh mục này không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach                           
                        </tbody>
                    </table>
                    {{$product_cats->links()}}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection