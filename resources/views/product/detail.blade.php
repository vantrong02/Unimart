@extends('layouts.home')
<?php $url = 'http://localhost/laravelpro/unimart/'; ?>
@section('title')
    @foreach ($products as $product)
        {{ $product->name }}
    @endforeach
@endsection
@section('content')
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail breadcumb">
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
        <div class="main-content-detail fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img src="{{ asset($product->thumbnail) }}" />
                        </a>
                        <div id="list-thumb">
                            @foreach ($slides as $slide)
                                <a class="thumb-item">
                                    <img src="{{ asset($slide->product_slide_img) }}" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="{{asset('images/img-pro-01.png')}}" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name">{{$product->name}}</h3>
                        <div class="desc">
                            <?php 
                            $description = $product->description;
                            $formattedDescription = nl2br($description);
                            echo "<p>" . $formattedDescription . "</p>";
                            ?>
                        </div>
                        <div class="num-product">
                            <span class="title">Tình trạng: </span>
                            <span class="status">{{$product->status}}</span>
                        </div>
                        <p class="price">{{number_format($product->price, 0, ',', '.')}}VNĐ</p>
                        <div id="num-order-wp">
                            <span class="title">Số lượng </span>
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <a href="{{route('cart.add', $product->id)}}" title="Mua ngay" class="buy">Mua ngay</a>  
                        @if (isset(Auth::user()->name))
                            <a href="{{route('cart.add', $product->id)}}" title="Thêm vào giỏ hàng" class="add-cart">Thêm vào giỏ hàng</a>
                        @else
                            <a href="{{route('log')}}" title="Thêm vào giỏ hàng" class="add-cart">Thêm vào giỏ hàng</a>
                        @endif
                                                     
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php 
                    $description = $product->content;
                    $formattedDescription = nl2br($description);
                    echo "<p>" . $formattedDescription . "</p>";
                    ?>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm liên quan</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($product_related as $item)
                        <li>
                            <a href="{{route('product.detail', $item->id)}}" title="" class="thumb">
                                <img src="{{asset($item->thumbnail)}}">
                            </a>
                            <a href="{{route('product.detail', $item->id)}}" title="" class="product-name">{{$item->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($item->price, 0, ',', '.')}}VNĐ</span>
                            </div>
                        </li>
                        @endforeach                    
                    </ul>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Bình luận</h3>
                </div>
            </div>
        </div>
    </div>
</div> 


@endsection