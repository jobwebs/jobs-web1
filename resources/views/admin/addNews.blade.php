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

        .preview label {
            margin: 0 24px 0 16px;
        }

        .preview p {
            display: inline-block;
            /*position: absolute;*/
            /*top: 30px;*/
            /*left:116px;*/
            font-size: 12px;
        }

        .preview p span {
            cursor: pointer;
            margin-right: 6px;
            padding: 2px 4px;
        }

        span.insert:hover {
            text-decoration: underline;
        }

        span.delete:hover {
            background-color: var(--divider);
        }

        span.delete {
            color: var(--text-color-light);
            border: 2px solid var(--divider);
            background-color: var(--divider-light);
        }

        span.insert {
            color: var(--cucumber);
        }

        .preview img {
            padding: 5px;
            border: 1px solid var(--divider-light);
            background-color: var(--divider-light);
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
                    <form role="form" method="post" id="add-news-form">

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
                            <a id="insert-image" onclick="insertImage(this)"
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
        var previewHolder = $("#preview-holder");
        var appendFileInput = true;

        function insertImage() {
            if (appendFileInput) {
                previewHolder.append("<input type='file' name='pic" + index + "' hidden onchange='showPreview(this)'/>");
                appendFileInput = false;
            }

            $("input[name='pic" + index + "']").click();
        }

        function showPreview(element) {
            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            previewHolder.append("<div class='preview'>" +
                "<img src='" + objectUrl + "' width='150'>" +
                "&nbsp;&nbsp;<label>[图片" + index + "]</label>" +
                "<p><span class='insert' onclick='insertImageCode(" + index + ")'>插入</span>" +
                "<span class='delete' onclick='deleteImage(this, " + index + ")'>删除</span></p></div>");

            index++;
            appendFileInput = true;
        }

        function deleteImage(element, i) {
            swal({
                title: "确认",
                text: "确认删除图片吗",
                type: "info",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                swal("图片已删除");

                var content = $("#content");
                content.val(content.val().replace("[图片" + i + "]", ""));

                element.parentNode.parentNode.remove();
                $("input[name='pic" + i + "']").remove();
            });
        }

        function insertImageCode(i) {
            console.log("hello");
            var content = $("#content");
            content.val(content.val() + "[图片" + i + "]");
        }
    </script>
@show
