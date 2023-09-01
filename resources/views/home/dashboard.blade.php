@extends('layouts.home')
@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="{{asset('images/slider-01.png')}}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{asset('images/slider-02.png')}}" alt="">
                    </div>
                    <div class="item">
                        <img src="{{asset('images/slider-03.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-1.png')}}">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-2.png')}}">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-3.png')}}">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-4.png')}}">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-5.png')}}">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($list_products as $product)
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{asset($product->thumbnail)}}">
                            </a>
                            <a href="" title="" class="product-name">{{$product->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($product->price, 0, ',', '.')}}đ</span>
                            </div>
                            {{-- <div class="action clearfix">
                                <a href="{{route('cart.add', $product->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div> --}}
                        </li>
                        @endforeach  
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-product clearfix">
                        @foreach ($list_products as $product)
                        <li>
                            <a href="{{route('product.detail', $product->id)}}" title="" class="thumb">
                                <img src="{{asset($product->thumbnail)}}">
                            </a>
                            <a href="{{route('product.detail', $product->id)}}" title="" class="product-name">{{$product->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($product->price, 0, ',', '.')}}đ</span>
                            </div>
                            {{-- <div class="action clearfix">
                                <a href="{{route('cart.add', $product->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div> --}}
                        </li>
                        @endforeach                      
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục</h3>
                </div>
                <div class="secion-detail">
                    <ul id="main-menu">
                        @foreach ($product_cats as $cat)
                            @if ($cat->parent_id == 0)
                                <?php $list_cat_pr_lv2 = DB::table('product_cats')
                                    ->where('parent_id', $cat->id)
                                    ->get(); ?>
                                <li>
                                    <a href="{{$cat->url = route('product.list', $cat->id)}}" class="sub_cat has-children"
                                        data-id="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </a>
                                    <ul class="sub-menu">
                                        @foreach ($list_cat_pr_lv2 as $cat_lv2)
                                            @if ($cat_lv2->parent_id == $cat->id)
                                                <?php $list_cat_pr_lv3 = DB::table('product_cats')
                                                ->where('parent_id', $cat_lv2->id)
                                                ->get(); ?>
                                            <li>
                                                <a href="{{$cat_lv2->url = route('product.list', $cat_lv2->id)}}">
                                                    {{ $cat_lv2->name }}
                                                </a>
                                                <ul class="sub-menu">
                                                    @foreach ($list_cat_pr_lv3 as $cat_lv3)
                                                        <a href="{{$cat_lv3->url = route('product.list', $cat_lv3->id)}}">
                                                            {{ $cat_lv3->name }}
                                                        </a>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{asset('images/img-pro-13.png')}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Laptop Asus A540UP I5</a>
                                <div class="price">
                                    <span class="new">5.190.000đ</span>
                                    <span class="old">7.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="{{asset('images/banner.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection