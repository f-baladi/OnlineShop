<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app_url" content="{{ url(('/')) }}">
    <title>پنل مدیریت</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
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
                    <a href="">مدیریت محصولات</a>
                    <a href="">افزودن محصول</a>
                    <a href="">مدیریت دسته ها</a>
                </div>
            </li>
        </ul>
    </div>
    <div class="page_content">
        <div class="content_box" id="app">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/admin.js') }}" defer></script>
</body>
</html>
