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
                <p><?=$site_name ?></p>
                <span><small><?=$site_desc ?></small></span>
                <br>
                <br>
                <small>联系：xxxxxxxxxxxx@xxxx.com</small>
                <br>
                <small>联系：(86)021-65642222</small>
                <br>
                <small>地址：上海市杨浦区邯郸路220号</small>
                <br>
                <small>邮编：200433</small>
                <br>

            </div>

            <div class="middle">
                <p></p>
            </div>

            <div class="right">
                <span class="copy-right">site design & develop &copy;2017 Four2Nine Studio<br>
                    esporthr 版权所有 | All rights receives</span>
            </div>
            <div style="clear: both;"></div>
        </div>
    </footer>
@show

<script src="{{asset('js/jquery-3.2.1.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/material.js')}}"></script>
<script type="text/javascript">
    $("*[to]").click(function () {
        self.location = $(this).attr('to');
    });

    function setError(element, forStr, errorStr) {
        element.parent().addClass('error');
        $(".error[for='" + forStr + "']").html(errorStr);
        element.focus();
    }

    function removeError(element, forStr) {
        element.parent().removeClass('error');
        $(".error[for='" + forStr + "']").html("");
    }
</script>

@section('custom-script')
@show
</body>
</html>
