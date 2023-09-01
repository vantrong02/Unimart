<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title id="hdtitle">@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="{{asset('reset.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/home.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/header.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/footer.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/global.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/fonts.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/detail_blog.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/detail_product.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/category_product.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/cart.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/checkout.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/register.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/import/login.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('responsive.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/style.css')}}" rel="stylesheet">

        <script src="{{asset('js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/admin.js')}}" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <div id="main-menu-wp" class="fl-left">
                                <ul id="main-menu-header" class="clearfix">
                                    <li>
                                        <a href="" title="">Blog</a>
                                    </li>
                                    <li>
                                        <a href="" title="">Giới thiệu</a>
                                    </li>
                                    <li>
                                        <a href="" title="">Liên hệ</a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/tronggs.tranvan" target="blank" title="">Kết nối facebook</a>                                           
                                    </li>
                                </ul>
                            </div>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu-header" class="login clearfix">
                                    <?php if(!isset(Auth::user()->name)){ ?>
                                    <li>
                                        <a href="{{route('register')}}" title="Đăng ký">Đăng ký</a>
                                    </li>
                                    <li>
                                        <a href="{{route('log')}}" title="Đăng nhập">Đăng nhập</a>
                                    </li>   
                                    <?php } else{
                                        ?>
                                        <div class="btn-group">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{Auth::user()->name}} 
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Tài khoản</a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a> 
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form> 
                                            </div>
                                        </button>
                                    </div>
                                    <?php }
                                    ?>                   
                                </ul>
                            </div>        
                        </div>
                    </div>
        
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="{{route('dashboard')}}" title="" id="logo" class="fl-left"><img src="{{asset('images/logo.png')}}"/></a>
                            <div id="search-wp" class="fl-left">
                                <form action="">
                                    <input type="text" name="keyword" id="search_name" value="{{request()->input('keyword')}}" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                    <button type="submit" name="btn-search" id="sm-s">Tìm kiếm</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0981.379.534</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">2</span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num">{{Cart::count()}}</span>
                                    </div>
                                    <div id="dropdown">
                                        <p class="desc">Có <span>{{Cart::count()}} sản phẩm</span> trong giỏ hàng</p>
                                        <ul class="list-cart">
                                            @foreach (Cart::content() as $row)
                                            <li class="clearfix">
                                                <a href="" title="" class="thumb fl-left">
                                                    <img src="{{asset($row->options->thumbnail)}}" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="" title="" class="product-name">{{$row->name}}</a>
                                                    <p class="price">{{number_format($row->price, 0, ',', '.')}}đ</p>
                                                    <p class="qty">Số lượng: <span>{{$row->qty}}</span></p>
                                                </div>
                                            </li>
                                            @endforeach                                  
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right">{{Cart::total()}}vnđ</p>
                                        </div>
                                        <div class="action-cart clearfix">
                                            <a href="{{route('cart.show')}}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="{{route('checkout')}}" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')


                <div id="footer-wp">
                    <div id="foot-body">
                        <div class="wp-inner clearfix">
                            <div class="block" id="info-company">
                                <h3 class="title">ISMART</h3>
                                <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                                <div id="payment">
                                    <div class="thumb">
                                        <img src="public/images/img-foot.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="block menu-ft" id="info-shop">
                                <h3 class="title">Thông tin cửa hàng</h3>
                                <ul class="list-item">
                                    <li>
                                        <p>106 - Trần Bình - Cầu Giấy - Hà Nội</p>
                                    </li>
                                    <li>
                                        <p>0987.654.321 - 0989.989.989</p>
                                    </li>
                                    <li>
                                        <p>vshop@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="block menu-ft policy" id="info-shop">
                                <h3 class="title">Chính sách mua hàng</h3>
                                <ul class="list-item">
                                    <li>
                                        <a href="" title="">Quy định - chính sách</a>
                                    </li>
                                    <li>
                                        <a href="" title="">Chính sách bảo hành - đổi trả</a>
                                    </li>
                                    <li>
                                        <a href="" title="">Chính sách hội viện</a>
                                    </li>
                                    <li>
                                        <a href="" title="">Giao hàng - lắp đặt</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="block" id="newfeed">
                                <h3 class="title">Bảng tin</h3>
                                <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                                <div id="form-reg">
                                    <form method="POST" action="">
                                        <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                                        <button type="submit" id="sm-reg">Đăng ký</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="foot-bot">
                        <div class="wp-inner">
                            <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
                        </div>
                    </div>
                </div>
                </div>
                <div id="btn-top"><img src="public/images/icon-to-top.png" alt=""/></div>
                <div id="fb-root"></div>
                <script>(function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                </body>
                </html>