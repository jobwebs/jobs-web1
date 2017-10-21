<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/icon-fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/style.css')}}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">

    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('favicon/android-icon-192x192.png')}}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    @section('custom-style')
    @show
</head>
<body>

<header class="header-layout">

    @section('header-nav')
    @show

    @section('header-tab')
    @show
</header>

@section('content')

@show

@section('footer')
    <footer>
        <div class="container">
            <div class="left">
                <img src="{{asset("images/logo-white.png")}}" width="150px"/><br>
                <span style="position: relative; top: 4px;"><small><?=$site_desc ?></small></span>
                <br>
                <br>
                <small>联系：kefu@eshunter.com</small>
                <br>
                <small>联系：(86)021-63339866</small>
                <br>
                <small>地址：上海市黄浦区会稽路8号金天地国际大厦708室</small>
                <br>
                <small>邮编：200021</small>
                <br>

            </div>

            <div class="middle">
                <p></p>
            </div>

            <div class="right">
                <span class="copy-right">site design & develop &copy; 2017 Four2Nine Studio<br>
                    电竞猎人 | E-sport Hunter版权所有 </br>
                    沪ICP备17037845号-1
                </span>
            </div>
            <div style="clear: both;"></div>
        </div>
    </footer>
@show

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/material.js')}}"></script>
<script src="{{asset('js/master.js')}}"></script>
<script type="text/javascript">
    $("*[to]").click(function () {
        self.location = $(this).attr('to');
    });
</script>

@section('custom-script')
@show
</body>
</html>
