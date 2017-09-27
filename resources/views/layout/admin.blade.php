<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/icon-fonts.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/node-waves/waves.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('style/themes/all-themes.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/admin-style.css')}}">

    <style>
        .sidebar .menu .list .ml-menu li.active a.toggled:not(.menu-toggle):before {
            top: 0;
        }

        a {
            color: #000;
        }

        a:hover {
            color: #000;
            text-decoration: none;
        }
    </style>
    @section('custom-style')
    @show
</head>
<body class="theme-teal">

<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="javascript:void(0);">@yield('title')</a>
        </div>
    </div>
</nav>

@section('sidebar')
@show

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>@yield('title')</h2>
        </div>
        @section('content')
        @show
    </div>
</section>

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/material.js')}}"></script>
<script src="{{asset('js/master.js')}}"></script>

<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset("plugins/node-waves/waves.min.js")}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
<script src="{{asset('js/admin-form-validation.js')}}"></script>

@section('custom-script')
@show
</body>
</html>
