<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post_cat;
use App\Post;

class AdminPostController extends Controller
{
    //
    function __construct(){
        $this->middleware(function($request, $next){
            session(['module_active' => 'post']);
            return $next($request);
        });
    }
    function list_cat(){   
        $users = User::all(); 
        $post_cats = Post_cat::with('user')->paginate(5);
        return view('admin.post.list_cat', compact('post_cats', 'users'));
    }
    function add_cat(){
        return view('admin.post.list_cat');
    }
    function store_cat(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:255',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh mục',
            ]
        );
        Post_cat::create(
            [
                'name' => $request->input('name'),
                'user_id' => $request->input('list_created_user')
            ]
        );
        
        return redirect('admin/post/cat/list')->with('status', 'Đã thêm danh mục thành công');
    }
    function delete_cat($id){
        $post_cat = Post_cat::find($id);
        $post_cat->delete();
        return redirect('admin/post/cat/list')->with('status', 'Đã xóa danh mục thành công');
    }
    function edit_cat($id){
        $users = User::all(); 
        $post_cat = Post_cat::find($id);
        return view('admin.post.edit_cat', compact('post_cat', 'users'));
    }
    function update_cat(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|string|max:255',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh mục',
            ]
        );
        Post_cat::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'user_id' => $request->input('list_created_user')
            ]
        );
        
        return redirect('admin/post/cat/list')->with('status', 'Đã cập nhật danh mục thành công');
    }
    
    function list(Request $request){   
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        if($status == 'trash'){
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            $posts = Post::onlyTrashed()->paginate(5);
        }else{
            $keyword = "";
            if($request->input('keyword')){
                $keyword = $request->input('keyword');
            }
            $posts = Post::with('user', 'post_cat')->where('title', 'LIKE', "%$keyword%")->paginate(5);
        }   

        $count_post_action = Post::count();
        $count_post_trash = Post::onlyTrashed()->count();
        $count = [$count_post_action, $count_post_trash];

        return view('admin.post.list', compact('posts', 'count', 'list_act'));
    }
    function add(){
        $users = User::all();
        $post_cats = Post_cat::all();
        return view('admin/post/add', compact('users', 'post_cats'));
    }
    function store(Request $request){
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'created_user' => 'required',
                'post_cat' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'title' => 'Tiêu đề bài viết',
                'content' => 'Nội dung bài viết',
                'created_user' => 'Người tạo bài viết',
                'post_cat' => 'Danh mục bài viết'
            ]
        );
        Post::create(
            [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'user_id' => $request->input('created_user'),
                'post_cat_id' => $request->input('post_cat'),
            ]
        );
        
        return redirect('admin/post/list')->with('status', 'Đã thêm bài viết thành công');
    }
    function edit($id){
        $users = User::all();
        $post_cats = Post_cat::all();
        $post = Post::find($id);
        return view('admin/post/edit', compact('post', 'users', 'post_cats'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'created_user' => 'required',
                'post_cat' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'title' => 'Tiêu đề bài viết',
                'content' => 'Nội dung bài viết',
                'created_user' => 'Người tạo bài viết',
                'post_cat' => 'Danh mục bài viết'
            ]
        );
        Post::where('id', $id)->update(
            [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'user_id' => $request->input('created_user'),
                'post_cat_id' => $request->input('post_cat'),
            ]
        );
        
        return redirect('admin/post/list')->with('status', 'Đã cập nhật bài viết thành công');
    }
    function delete($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('admin/post/list')->with('status', 'Đã xóa bài viết thành công');
    }
    function action(Request $request){
        $list_check = $request->input('list_check');
        if(!empty($list_check)){
            $act = $request->input('act');
            if($act == 'delete'){
                Post::destroy($list_check);
                return redirect()->route('admin/post/list')->with('status', 'Đã xóa bài viết thành công');
            }
            if($act == 'restore'){
                Post::withTrashed()
                ->where('id', $list_check)
                ->restore();
                return redirect()->route('admin/post/list')->with('status', 'Đã khôi phục bài viết thành công');
            }
            if($act == 'forceDelete'){
                 Post::withTrashed()
                ->where('id', $list_check)
                ->forceDelete();
                return redirect()->route('admin/post/list')->with('status', 'Đã xóa vĩnh viễn bài viết');
            }
        }
        return view('admin/post/list')->with('status', 'Bạn cần chọn bài viết cần thực hiện');
    }

}
