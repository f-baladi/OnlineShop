<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app_url" content="{{ url(('/')) }}">
    <title>فروشگاه آنلاین</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
</head>
<body>

<div id="app">
    <div class="header">
        <a href="{{ url('') }}">
            <img src="{{ url('shop_icon.jpg') }}" class="shop_logo">

        </a>
        <div class="header_row">

            <div class="input-group index_header_search">
                <input type="text" class="form-control" placeholder="جستجو در فروشگاه آنلاین">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-search"></span>
                    </div>

                </div>

            </div>

            <div class="header_action">

                <div class="dropdown">
                    <div class="index_auth_div" role="button" data-toggle="dropdown">
                        <span>
                            @if(Auth::check())
                                @if(!empty(Auth::user()->name))
                                    {{ Auth::user()->name }}
                                @else
                                    {{ replace_number(Auth::user()->mobile) }}
                                @endif
                            @else
                                ورود / ثبت‌نام
                            @endif
                        </span>
                        <span class="fa fa-angle-down"></span>
                    </div>
                    <div class="dropdown-menu header-auth-box" aria-labelledby="dropdownMenuButton">

                        @if(Auth::check())
                            @if(Auth::user()->role_id>0 || Auth::user()->role=='admin')
                                <a class="dropdown-item admin" href="{{ url('admin') }}">
                                    پنل مدیریت
                                </a>
                            @endif
                        @else
                            <a class="btn btn-primary"
                               href="{{ route('login') }}">ورود {{ config('shop-info.shop_name') }}</a>
                            <div class="register-link">
                                <a class="btn btn-success" href="{{ route('register') }}">ثبت نام</a>
                            </div>
                            <div class="dropdown-divider"></div>

                        @endif
                        <a class="dropdown-item profile" href="{{ url('users/profile') }}">
                            پروفایل
                        </a>
                        <a class="dropdown-item orders" href="{{ url('users/profile/orders') }}">
                            پیگیری سفارش
                        </a>

                        @if(Auth::check())
                            <form method="post" action="{{ url('logout') }}" id="logout_form">@csrf</form>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item logout">
                                خروج از حساب کاربری
                            </a>
                        @endif
                    </div>
                </div>

                <div class="header_divider"></div>

                <div class="cart-header-box">
                    <div class="btn-cart" data-toggle="dropdown">
                        <span id="cart-product-count" data-counter="{{ 0 }}">سبد خرید</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('partials.categoryList',['categories'=>$categories])

    <div class="container-fluid">
        @yield('content')
    </div>

</div>


<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/shop.js') }}" type="text/javascript"></script>
@yield('script')
</body>
</html>
