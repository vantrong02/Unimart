@extends('layouts.home')
@section('title')
    Đăng ký
@endsection
@section('content')
    {{-- <div class="content__reg">
        <div class="content__cart">
            <div class="content__cart-bg">
                <img src="{{ asset('images/bg-3.jpg') }}" alt="">
                <h2>Đăng ký</h2>
            </div>
        </div>
    </div> --}}
    <div class="content__reg-infomation">
        <div class="container content__reg-container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Đăng ký</h2>
                    <div class="content__reg-form">
                        {!! Form::open(['url' => 'register/storeaddClient', 'method' => 'POST', 'files' => true, 'id' => 'myform']) !!}
                        @if (session('status'))
                            <div class="alert__success">
                                <h6>{{ session('status') }}</h6>
                            </div>
                        @endif
                        <div class="content__reg-input">
                            <div class="col-size-6 ">
                                <input type="text" name="fullname" value="" placeholder="Họ Và Tên (*)">
                                @error('fullname')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                            <div class="col-size-6 input-item">
                                <ul class="content__gender">
                                    <li>
                                        <label>
                                            <input type="radio" aria-label="radio" name="gender" value="Nam">
                                            <span class="radio-mark">

                                            </span>
                                            <span>Nam</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label>
                                            <input type="radio" aria-label="radio" name="gender" value="Nữ">
                                            <span class="radio-mark">

                                            </span>
                                            <span>Nữ</span>
                                        </label>
                                    </li>
                                </ul>
                                @error('gender')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                        </div>
                        <div class="content__reg-input" style="margin-top: 10px">
                            <div class="col-size-6">
                                <input type="phone" name="phone" value="" placeholder="Điện Thoại (*)">
                                @error('phone')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                            <div class="col-size-6 input-item">
                                <input type="email" name="email" value="" placeholder="Email (*)">
                                @error('email')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                        </div>
                        <div class="content__reg-input">
                            <div class="col content__reg-col">
                                <input type="text" name="address" value="" placeholder="Địa chỉ (*)">
                                @error('address')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                        </div>
                        <div class="content__reg-input">
                            <div class="col content__reg-col">
                                <input type="text" name="city" value="" placeholder="Tỉnh / Thành Phố (*)">
                                @error('city')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                        </div>
                        <div class="content__reg-input">
                            <div class="col-size-6">
                                <input type="username" name="username" value="" placeholder="Username (*)">
                                @error('username')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                            <div class="col-size-6 input-item">
                                <input type="password" name="password" value="" placeholder="Password (*)">
                                @error('password')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                        </div>
                        <div class="content__if">
                            <a href="#" class="term-but">Điều khoản điều kiên</a href="#">
                            <div class="check-box">
                                <ul>
                                    <li>
                                        <label>
                                            <input type="checkbox" name="is_admin" value="0">
                                            <span class="check-mask">

                                            </span>
                                            <span class="yes">Đồng ý</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            @error('is_admin')
                                <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                            @enderror
                        </div>
                        {!! Form::close() !!}
                        <div class="content__register">
                            {!! Form::submit('Đăng kí', ['name' => 'btn_add', 'class' => 'btn btn-primary', 'form' => 'myform']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="detail__if">
            <button class="close-popup"></button>
            <div class="detail__if-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="detail__if-outer">
                                <h2 class="if_order">Điều kiện giao dịch</h2>
                                <div class="detail__if-text">
                                    <p>Bằng việc tiến hành Mua ngay, khách hàng đồng ý với các Điều Kiện Giao Dịch Chung
                                        được ban hành bởi LVP:</p>
                                    <ul>
                                        {{-- @foreach ($list_page as $page)
                                            <li><a href="{{ $page->url = Route('page.detailPage', $page->id) }}">{{$page->page_title}}</a></li>
                                        @endforeach --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="overlay__if"></span>
        </div>
    </div>
@endsection