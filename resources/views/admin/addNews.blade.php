@extends('layout.admin')
@section('title', 'Add News')

@section('custom-style')
    <style>
        ul.mdl-menu,
        li.mdl-menu__item {
            padding: 0;
        }

        li.mdl-menu__item a {
            cursor: pointer;
            display: block;
            padding: 0 16px;
        }

        .button-blue-sky,
        .button-blue-sky:hover,
        .button-blue-sky.mdl-button--raised,
        .button-blue-sky.mdl-button--fab {
            color: rgb(255, 255, 255);
            background-color: #03A9F4;
        }

        .button-link,
        .button-link:hover,
        .button-link.mdl-button--raised,
        .button-link.mdl-button--fab {
            color: rgb(0, 0, 0);
            background-color: transparent;
        }

        button[type="submit"] {
            margin-top: 16px;
        }

        .news-content--title {
            position: relative;
            height: 50px;
            border-bottom: 1px solid #ebebeb;
            margin: 64px 0 32px 0;
        }

        .news-content--title h6 {
            display: inline-block;
            margin: 0;
            vertical-align: middle;
        }

        #insert-image {
            position: absolute;
            right: 0;
            vertical-align: middle;
        }

        .preview {
            margin-top: 16px;
            border: 1px solid #F5F5F5;
            position: relative;
        }

        .preview img {
            padding: 5px;
            border: 1px solid #F5F5F5;
            background-color: #F5F5F5;
        }

        .preview .material-icons {
            position: absolute;
            top: -10px;
            right: -10px;
            cursor: pointer;
            border-radius: 24px;
            border: 1px solid #f5f5f5;
        }

        .preview .material-icons:hover {
            background-color: #f5f5f5;
        }
    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'news', 'subtitle'=>'addNews'])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        发布新闻
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a href="/admin/news">返回新闻列表</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="body">
                    <form role="form" method="post" id="add_project_form">

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="title" name="title" class="form-control" placeholder="新闻标题"
                                       required>
                            </div>
                            <label id="title-error" class="error" for="title"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="subtitle" name="subtitle" class="form-control"
                                       placeholder="新闻副标题"
                                       required>
                            </div>
                            <label id="subtitle-error" class="error" for="subtitle"></label>
                        </div>

                        <div class="news-content--title">
                            <h6>新闻内容</h6>
                            <a id="insert-image"
                               class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-link">
                                插入图片
                            </a>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                    <textarea rows="8" class="form-control no-resize" id="content" name="content"
                                              placeholder="在这里输入新闻内容..." required></textarea>
                            </div>
                            <label id="content-error" class="error" for="content"></label>
                        </div>

                        <div id="preview-holder">
                        </div>

                        <br>

                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            添加项目
                        </button>
                    </form>
                </div><!-- #END# .body-->
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        var index = 1;

        $("#insert-image").click(function () {

            var previewHolder = $("#preview-holder");

            previewHolder.append("<input type='file' name='pic" + index + "' hidden/>");

            $("input[name='pic" + index + "']").click();

            index++;
            {{--previewHolder.append("<div class='preview'>" +--}}
            {{--"<input type='file' name='pic"+index+"' hidden/>" +--}}
            {{--"<img src='{{asset("images/avatar.png")}}' width='100'>"+--}}
            {{--"&nbsp;&nbsp;<label>[Pic01]</label>"+--}}
            {{--"<i class='material-icons' class='close-pic' id='close-pic"+index+"'>close</i></div>");--}}
        });

        $(".close-pic").click(function () {

        })
    </script>
@show
