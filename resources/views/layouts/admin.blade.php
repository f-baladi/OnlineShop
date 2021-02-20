<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app_url" content="{{ url(('/')) }}">
    <title>پنل مدیریت</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body>
<div class="container-fluid">

    <div class="page_sidebar">
        <ul id="sidebar_menu">
            <li>
                <a >
                    <span class="fa fa-user-circle"></span>
                    <span>کاربران</span>
                    <span class="fa fa-angle-left"></span>
                </a>
                <div class="child_menu">
                    <a href="">مدیریت کاربران</a>
                    <a href="">افزودن کاربر</a>
                </div>
            </li>

            <li>
                <a >
                    <span class="fa fa-shopping-cart"></span>
                    <span>محصولات</span>
                    <span class="fa fa-angle-left"></span>
                </a>
                <div class="child_menu">
                    <a href="{{route('admin.products.index')}}">مدیریت محصولات</a>
                    <a href="{{route('admin.products.create')}}">افزودن محصول</a>
                    <a href="{{route('admin.categories.index')}}">مدیریت دسته ها</a>
                    <a href="{{route('admin.categories.create')}}">افزودن دسته</a>
                </div>
            </li>

            <li>
                <a >
                    <span class="fa fa-paint-brush"></span>
                    <span>رنگ ها</span>
                    <span class="fa fa-angle-left"></span>
                </a>
                <div class="child_menu">
                    <a href="{{route('admin.colors.index')}}">مدیریت رنگ ها</a>
                    <a href="{{route('admin.colors.create')}}">افزودن رنگ</a>
                </div>
            </li>

            <li>
                <a >
                    <span class="fa fa-bandcamp"></span>
                    <span>برند ها</span>
                    <span class="fa fa-angle-left"></span>
                </a>
                <div class="child_menu">
                    <a href="{{route('admin.brands.index')}}">مدیریت برند ها</a>
                    <a href="{{route('admin.brands.create')}}">افزودن برند</a>
                </div>
            </li>
        </ul>
    </div>
    <div class="page_content" style="padding-top: 70px">
        <div class="content_box" id="app">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/AdminVue.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@yield('script')
</body>
</html>
