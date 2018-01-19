<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>@yield('title','电竞猎人')</title>
    @section('esh-css')
        <link rel="stylesheet" href="{{asset('mobile/styles/mdl/material.min.css')}}">
        <link rel="stylesheet" href="{{asset('mobile/plugins/sweetalert/sweetalert.css')}}">
        <link rel="stylesheet" href="{{asset('mobile/styles/default/styles.css')}}">
        @show

</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
    @section('esh-header')
        @show
    <main class="mdl-layout__content esh-layout__content" id="esh-content">

    @section('esh-content')
        @show
    </main>

    @section('esh-footer')
        @show
</div>
@section('esh-js')
    <script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('mobile/js/utils/utils.js')}}"></script>
@show
</body>
</html>