<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_cat;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Cache;

class AdminProductController extends Controller
{
    //
    function __construct(){
        $this->middleware(function($request, $next){
            session(['module_active' => 'product']);
            return $next($request);
        });
    }
    function list_cat(){
        $users = User::all();
        $product_cats = Product_cat::with('user')->paginate(15);
        return view('admin.product.list_cat', compact('product_cats', 'users'));
    }
    function add_cat(){
        return view('admin.product.list_cat');
    }
    function store_cat(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'url' => 'required|string',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh mục',
                'url' => 'Tên đường dẫn'
            ]
        );
        Product_cat::create(
            [
                'name' => $request->input('name'),
                'parent_id' => $request->input('parent_cat'),
                'user_id' => $request->input('list_created_user'),
                'url' => $request->input('url')
            ]
        );
        
        return redirect('admin/product/cat/list')->with('status', 'Đã thêm danh mục thành công');
    }
    function delete_cat($id){
        $product_cat = Product_cat::find($id);
        $product_cat->delete();
        return redirect('admin/product/cat/list')->with('status', 'Đã xóa danh mục thành công');
    }
    function edit_cat($id){
        $users = User::all(); 
        $product_cats = Product_cat::all();
        $product_cat = Product_cat::find($id);
        return view('admin.product.edit_cat', compact('product_cat', 'product_cats', 'users'));
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
        Product_cat::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'parent_id' => $request->input('parent_cat'),
                'user_id' => $request->input('list_created_user')
            ]
        );
        
        return redirect('admin/product/cat/list')->with('status', 'Đã cập nhật danh mục thành công');
    }
    function list(Request $request){
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa'
        ];
        if($status == 'out_of_stock'){
            $list_act = [
                'restore' => 'Khôi phục'
            ];
            $products = Product::onlyTrashed()->paginate(5);
        }else{
            $keyword = "";
            if($request->input('keyword')){
                $keyword = $request->input('keyword');
            }
            $products = Product::with('product_cat', 'user')->where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        }

        $count_product_in_of_stock = Product::count();
        $count_product_out_of_stock = Product::onlyTrashed()->count();
        $count = [$count_product_in_of_stock, $count_product_out_of_stock];

        return view('admin.product.list', compact('products', 'count', 'list_act'));
    }
    function add(){
        $users = User::all();
        $product_cats = Product_cat::all();
        return view('admin.product.add', compact('users', 'product_cats'));
    }
    function store(Request $request){
        $request->validate(
            [
                'name' => 'required|string',
                'thumbnail' => 'required|file',
                'description' => 'required',
                'content' => 'required',
                'price' => 'required|integer',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên sản phẩm',
                'thumbnail' => 'Ảnh sản phẩm',
                'description' => 'Mô tả sản phẩm',
                'content' => 'Nội dung sản phẩm',
                'price' => 'Giá sản phẩm',
            ]
        );
        $data = $request->all();

        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $filename = $file->getClientOriginalName();
            $file->move('public/images', $filename);
            $thumbnail = 'images/'.$filename;
            $data['thumbnail'] = $thumbnail; 
        } 

        // return $input;
        //return $thumbnail;
        Product::create($data);
        
        return redirect('admin/product/list')->with('status', 'Đã thêm sản phẩm thành công');
    }
    function delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.product.list')->with('status', 'Đã xóa sản phẩm thành công');
    }
    function action(Request $request){
        $lisk_check = $request->input('list_check');
        if(!empty($lisk_check)){
            $act = $request->input('act');
            if($act == 'delete'){
                Product::destroy($lisk_check);
                return redirect('admin/product/list')->with('status', 'Đã xóa sản phẩm thành công');
            }
            if($act == 'restore'){
                Product::withTrashed()
                ->whereIn('id', $lisk_check)
                ->restore();
                return redirect('admin/product/list')->with('status', 'Đã khôi phục sản phẩm thành công');
            }
        }
        return redirect('admin/product/list')->with('status', 'Bạn cần chọn sản phẩm cần thực hiện');
    }
    function edit($id){
        $users = User::all();
        $product_cats = Product_cat::all();
        $product = Product::find($id);
        return view('admin.product.edit', compact('product', 'users', 'product_cats'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|string',
                'thumbnail' => 'required|file',
                'description' => 'required',
                'content' => 'required',
                'price' => 'required|integer',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên sản phẩm',
                'thumbnail' => 'Ảnh sản phẩm',
                'description' => 'Mô tả sản phẩm',
                'content' => 'Nội dung sản phẩm',
                'price' => 'Giá sản phẩm',
            ]
        );
        //$data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $file->getClientOriginalName();
            $directory = 'public/images';
        
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
        
            $file->move($directory, $filename);
            $thumbnail = 'images/'.$filename;
            //$data['thumbnail'] = $thumbnail; 
        }

        $data = $request->except(['_token', 'btn-edit']);

        Product::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'price' => $request->input('price'),
                'product_cat_id' => $request->input('product_cat_id'),
                'user_id' => $request->input('user_id'),
                'status' => $request->input('status'),
                'thumbnail' => $thumbnail 
            ]
        );
        
        return redirect('admin/product/list')->with('status', 'Đã cập nhật sản phẩm thành công');
    }
}
