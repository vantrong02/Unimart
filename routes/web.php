<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// Route::get('/dashboard', 'DashboardController@show')->middleware('auth');

// Route::get('admin/user/list', 'AdminUserController@list');
// //Route->AdminUserController@add->view->ghep giao dien->xu ly submit->validation->them user
// Route::get('admin/user/add', 'AdminUserController@add');
// Route::post('admin/user/store', 'AdminUserController@store');

Route::middleware('auth')->group(function(){
    //module dashboard
    Route::get('/dashboard', 'AdminDashboardController@show');

    //module user
    Route::get('admin/user/list', 'AdminUserController@list');
    Route::get('admin/user/add', 'AdminUserController@add');
    Route::post('admin/user/store', 'AdminUserController@store');
    Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->name('delete_user');
    Route::get('admin/user/action', 'AdminUserController@action');
    Route::get('admin/user/edit/{id}', 'AdminUserController@edit')->name('user.edit');
    Route::post('admin/user/update/{id}', 'AdminUserController@update')->name('user.update');

    //module post
    Route::get('admin/post/cat/list', 'AdminPostController@list_cat');
    Route::get('admin/post/cat/add', 'AdminPostController@add_cat');
    Route::post('admin/post/cat/store_cat', 'AdminPostController@store_cat');
    Route::get('admin/post/cat/delete/{id}', 'AdminPostController@delete_cat')->name('post.delete_cat');
    Route::get('admin/post/cat/edit/{id}', 'AdminPostController@edit_cat')->name('post.edit_cat');
    Route::post('admin/post/cat/update/{id}', 'AdminPostController@update_cat')->name('post.update_cat');

    Route::get('admin/post/list', 'AdminPostController@list')->name('admin/post/list');
    Route::get('admin/post/add', 'AdminPostController@add');
    Route::post('admin/post/store', 'AdminPostController@store');
    Route::get('admin/post/delete/{id}', 'AdminPostController@delete')->name('post.delete');
    Route::get('admin/post/action', 'AdminPostController@action');
    Route::get('admin/post/edit/{id}', 'AdminPostController@edit')->name('post.edit');
    Route::post('admin/post/update/{id}', 'AdminPostController@update')->name('post.update');

    //module product
    Route::get('admin/product/cat/list', 'AdminProductController@list_cat');
    Route::get('admin/product/cat/add', 'AdminProductController@add_cat');
    Route::post('admin/product/cat/store_cat', 'AdminProductController@store_cat');
    Route::get('admin/product/cat/delete/{id}', 'AdminProductController@delete_cat')->name('product.delete_cat');
    Route::get('admin/product/cat/edit/{id}', 'AdminProductController@edit_cat')->name('product.edit_cat');
    Route::post('admin/product/cat/update/{id}', 'AdminProductController@update_cat')->name('product.update_cat');

    Route::get('admin/product/list', 'AdminProductController@list')->name('admin.product.list');
    Route::get('admin/product/add', 'AdminProductController@add');
    Route::post('admin/product/store', 'AdminProductController@store');
    Route::get('admin/product/delete/{id}', 'AdminProductController@delete')->name('product.delete');
    Route::get('admin/product/action', 'AdminProductController@action');
    Route::get('admin/product/edit/{id}', 'AdminProductController@edit')->name('product.edit');
    Route::post('admin/product/update/{id}', 'AdminProductController@update')->name('product.update');

    //module order
    Route::get('admin/order/list', 'AdminOrderController@list')->name('order.list');
    Route::get('admin/order/delete/{id}', 'AdminOrderController@delete')->name('order.delete');
    Route::get('admin/order/detail/{id}', 'AdminOrderController@detail')->name('order.detail');
    Route::post('admin/order/update/{id}', 'AdminOrderController@update')->name('order.update');
});

//module home
Route::get('home/dashboard', 'DashboardController@show')->name('dashboard');

//Sub_menu
Route::post('/get_img','ContainerController@get_img');

//Check out
Route::get('checkout', 'CheckoutController@checkoutClient')->name('checkout');
Route::post('checkout/storeaddOrder','CheckoutController@storeaddOrder');
Route::get('checkout/listOrder','CheckoutController@listOrder');

//module product
Route::get('product/list/{id}', 'ProductController@list')->name('product.list');

// Xem chi tiết sản phẩm
Route::get('product/detail/{id}', 'ProductController@detail')->name('product.detail');

//Lọc giá theo thứ tự
Route::post('product/get_price_order_by', 'ProductController@get_price_order_by');

// Lọc theo giá
Route::post('product/get_price', 'ProductController@get_price');

// Tìm kiếm
Route::post('get_search', 'ContainerController@get_search');

// Đăng ký
Route::get('register','RegisterController@register')->name('register');

// Đăng nhập
Route::get('log', 'LoginController@login')->name('log');
Route::post('login/checkLogin', 'LoginController@checkLogin');

//Đăng xuất
Route::post('user/logout', 'LogoutController@logoutUser')->name('logout');

// UserClient
Route::post('register/storeaddClient', 'RegisterController@storeaddClient')->name('reg.storeaddClient');


//module cart
Route::get('cart/show', 'CartController@show')->name('cart.show');
Route::get('cart/add/{id}', 'CartController@add')->name('cart.add');
Route::get('cart/remove/{rowId}', 'CartController@remove')->name('cart.remove');
Route::get('cart/destroy', 'CartController@destroy')->name('cart.destroy');
Route::post('cart/update', 'CartController@update')->name('cart.update');


