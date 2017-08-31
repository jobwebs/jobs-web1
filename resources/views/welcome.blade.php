<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/icon-fonts.css')}}">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        p i,
        p a{
            vertical-align: middle;
        }

        p i {
            position: relative;
            top:-2px;
        }

        .container {
            text-align: center;
            display: table-cell;
            padding-top: 20px;
            /*vertical-align: middle;*/
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 50px;
            padding-top: 20px;
        }

        .web-contents {
            width:800px;
            margin:20px auto;
            text-align: left;
            padding:20px;
        }

        .web-contents a {
            font-weight: 300;
            font-size:10pt;
            color: #000000;
            text-decoration-line: none;
        }

        .contents-title {
            font-size: 20px;
            background: #f5f5f5;
            border-left: 5px solid #03A9F4;
            vertical-align: middle;
            padding-left: 16px;
            margin-top: 60px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Jobs UI Content</div>
    </div>

    <div class="web-contents">
        <p><a href="/index">/index&nbsp;&nbsp;首页</a> <i class="material-icons">check</i></p>

        <p class="contents-title">Account</p>

        <p><a href="/account/register">/account/register&nbsp;&nbsp;注册页面</a> <i class="material-icons">check</i></p>
        <p><a href="/account/login">/account/login&nbsp;&nbsp;登录页面</a> <i class="material-icons">check</i></p>
        <p><a href="/account/findPassword">/account/findPassword&nbsp;&nbsp;找回密码</a> <i class="material-icons">check</i></p>
        <p><a href="/account/index">/account/index&nbsp;&nbsp;个人中心</a> <i class="material-icons">check</i></p>
        <p><a href="/account/edit">/account/edit&nbsp;&nbsp;个人资料修改</a> <i class="material-icons">check</i></p>
        <p><a href="/account/enterpriseVerify">/account/enterpriseVerify&nbsp;&nbsp;企业号验证</a> <i class="material-icons">check</i></p>

        <p class="contents-title">Position</p>

        <p><a href="/position/applyList">/position/applyList&nbsp;&nbsp;申请记录</a> <i class="material-icons">check</i></p>
        <p><a href="/position/detail">/position/detail&nbsp;&nbsp;职位详情</a> <i class="material-icons">check</i></p>
        <p><a href="/position/publishList">/position/detail&nbsp;&nbsp;已发布职位列表</a> <i class="material-icons">check</i></p>
        <p><a href="/position/publish">/position/detail&nbsp;&nbsp;发布职位</a> <i class="material-icons">check</i></p>
        <p><a href="/position/advanceSearch">/position/advanceSearch&nbsp;&nbsp;职位搜索</a> <i class="material-icons"></i></p>


        <p class="contents-title">Resume</p>

        <p><a href="/resume/add">/resume/add&nbsp;&nbsp;添加简历</a> <i class="material-icons">check</i></p>
        <p><a href="/resume/preview">/resume/preview&nbsp;&nbsp;预览简历</a> <i class="material-icons">check</i></p>

        <p class="contents-title">News</p>

        <p><a href="/news/index">/news/index&nbsp;&nbsp;新闻中心</a> <i class="material-icons">check</i></p>
        <p><a href="/news/detail">/news/index&nbsp;&nbsp;新闻详情</a> <i class="material-icons">check</i></p>

        <p class="contents-title">Message</p>

        <p><a href="/message/index">/message/index&nbsp;&nbsp;消息列表</a> <i class="material-icons">check</i></p>
        <p><a href="/message/detail">/message/detail&nbsp;&nbsp;消息详情</a> <i class="material-icons">check</i></p>

        <p class="contents-title">About</p>

        <p><a href="/about/index">/about/index&nbsp;&nbsp;关于页面</a> <i class="material-icons">check</i></p>
    </div>
</div>
</body>
</html>
