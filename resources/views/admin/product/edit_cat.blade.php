@extends('layouts.admin')

@section('content')
    
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhật danh mục 
                </div>
                <div class="card-body">
                    <form action="{{route('product.update_cat', $product_cat->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$product_cat->name}}">
                        </div>
                        <div class="form-group">
                            <label for="url">Tên danh mục</label>
                            <input class="form-control" type="text" name="url" id="url" value="{{$product_cat->url}}">
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
                                @foreach ($product_cats as $product_cat)
                                    <option value="{{$product_cat->id}}"><?php echo str_repeat('|--', $product_cat->parent_id) . $product_cat->name ?></option>
                                @endforeach                           
                            </select>
                        </div>
                        <button type="submit" name="btn-edit" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection