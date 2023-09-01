@extends('layouts.home')
@section('title')
    Đăng nhập
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
    <div class="content__log-infomation">
        <div class="container content__log-container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Đăng nhập</h2>
                    <div class="content__log-form">
                        {!! Form::open(['url' => 'login/checkLogin', 'method' => 'POST', 'files' => true, 'id' => 'myform']) !!}
                        @if (session('status'))
                            <div class="alert__success">
                                <h6>{{ session('status') }}</h6>
                            </div>
                        @endif
                        <div class="content__log-input">
                            <div class="col content__reg-col">
                                <input type="email" name="email" value="" placeholder="Email (*)">
                                @error('email')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                        </div>
                        <div class="content__log-input">
                            <div class="col content__reg-col">
                                <input type="password" name="password" value="" placeholder="Password (*)">
                                @error('password')
                                    <h6 class="form-text text-danger" style="font-weight: bold;">{{ $message }}</h6>
                                @enderror
                            </div>
                        </div> 
                        <a href="#" class="form-text text-center" style="font-weight: bold;">Quên mật khẩu?</a>
                        {!! Form::close() !!}
                        <div class="content__login">
                            {!! Form::submit('Đăng nhập', ['name' => 'btn_add', 'class' => 'btn btn-primary', 'form' => 'myform']) !!}
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