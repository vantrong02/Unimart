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
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <div class="form-group">
                    <form action="#">
                        <input type="text" class="form-control form-search" name="keyword" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status' => 'active'])}}" class="text-primary">Những bài viết đang hoạt động<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status' => 'trash'])}}" class="text-primary">Những bài viết đang trong tình trạng có thể hết hoạt động<span class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form action="{{url('admin/post/action')}}" method="">
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" name="act" id="">
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
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Người tạo</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($posts->total() > 0)
                                          
                    @php
                        $t = 0;
                    @endphp
                    @foreach ($posts as $post)
                    @php
                        $t++;
                    @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{$post->id}}">
                        </td>
                        <td scope="row">{{$t}}</td>
                        <td><a href="">{{$post->title}}</a></td>
                        <td>{{$post->post_cat->name}}</td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>
                            <a href="{{route('post.edit', $post->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('post.delete', $post->id)}}" onclick="return confirm('Bạn có chắc chắn xóa bài viết này không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr> 
                    @endforeach  
                    @else
                        <tr>
                            <td colspan="7" class="bg-white">Không tìm thấy bài viết nào</td>
                        </tr>
                    @endif                                    
                </tbody>
            </table>
        </form>
            {{$posts->links()}}
        </div>
    </div>
</div>

@endsection