@extends('layouts.home')
<?php $url = 'http://localhost/laravelpro/unimart/'; ?>
@section('title')
    @foreach ($imgs as $img)
        {{ $img->name }}
    @endforeach
@endsection
@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                @foreach ($list_product as $product)
                    <input type="hidden" name="" id="category_save" value="<?php echo $product->product_cat_id; ?>">
                @endforeach
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm</a>
                    </li>
                    @foreach ($list_catId as $title)
                    @php
                        $parent_id = $title->parent_id;
                        $categories = [];
                        while ($parent_id != 0) {
                            foreach ($product_cats as $item) {
                                if ($item->id == $parent_id) {
                                    $categories[] = $item->name;
                                    $parent_id = $item->parent_id;
                                    break;
                                }
                            }
                        }
                        $categories = array_reverse($categories);
                    @endphp
                    @foreach ($categories as $category)
                    <li>
                        <a href="" title="">{{$category}}</a>
                    </li>
                    @endforeach
                    <li>
                        <a href="" title="">{{$title->name}}</a>
                    </li>
                    @endforeach     
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <span>{{count($list_product)}}</span> trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form >
                                <select name="select" id="common_selector">
                                    <option value="0">Giá</option>
                                    <option value="1">Giá cao đến thấp</option>
                                    <option value="2">Giá thấp đến cao</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    @if (count($list_product) > 0)
                    <ul class="list-product clearfix">
                        @foreach ($list_product as $product)
                        <li>
                            <a href="{{route('product.detail', $product->id)}}" title="" class="thumb">
                                <img src="{{asset($product->thumbnail)}}">
                            </a>
                            <a href="{{route('product.detail', $product->id)}}" title="" class="product-name">{{$product->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($product->price, 0, ',', '.')}}đ</span>
                            </div>
                        </li>
                        @endforeach                   
                    </ul>    
                    {{$products->links()}}           
                    @else
                    <div class="text-center">
                        <h5 class="text-danger">Hiện tại không có sản phẩm nào!</h5>
                    </div>
                    @endif
                </div>
            </div>           
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form action="" method="">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" class="common_selector-price" name="r-price" data-price="1000000"></td>
                                    <td>Dưới 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" class="common_selector-price" name="r-price" data-price="1000000 AND 10000000"></td>
                                    <td>1.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" class="common_selector-price" name="r-price" data-price="10000000 AND 20000000"></td>
                                    <td>10.000.000đ - 20.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" class="common_selector-price" name="r-price" data-price="20000000 AND 30000000"></td>
                                    <td>20.000.000đ - 30.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" class="common_selector-price" name="r-price" data-price="30000000"></td>
                                    <td>Trên 30.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="{{asset('images/banner.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection