@extends('layouts.admin')

@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật sản phẩm
        </div>
        <div class="card-body">
            <form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$product->name}}">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input class="form-control" type="text" name="price" id="price" value="{{$product->price}}">
                            @error('price')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            <textarea name="description" class="form-control" id="intro" cols="30" rows="5">{{$product->description}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="content" class="form-control" id="intro" cols="30" rows="5">{{$product->content}}</textarea>
                    @error('content')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Người tạo</label>
                    <select class="form-control" id="" name="user_id">
                        <option>Chọn người tạo</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}" {{$user->id == $product->user_id?'selected':''}}>{{$user->name}}</option>
                        @endforeach                
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="product_cat_id">
                        <option>Chọn danh mục</option>
                        @foreach ($product_cats as $product_cat)
                            <option value="{{$product_cat->id}}" {{$product_cat->id == $product->product_cat_id?'selected':''}}><?php echo str_repeat('|--', $product_cat->parent_id) . $product_cat->name ?></option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select class="form-control" id="" name="status">
                        <option>Chọn trạng thái</option>
                        <option value="Còn hàng" {{$product->status == 'Còn hàng'?'selected':''}}>Còn hàng</option>
                        <option value="Hết hàng" {{$product->status == 'Hết hàng'?'selected':''}}>Hết hàng</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="thumbnail">Hình ảnh</label>
                    <input class="form-control-file" type="file" name="thumbnail" id="thumbnail">
                    @error('thumbnail')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" name="btn-edit" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

@endsection