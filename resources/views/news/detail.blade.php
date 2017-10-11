@extends('layout.master')
@section('title', '新闻详情')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">

    <style>
        .news-detail .mdl-card__title h5 {
            font-size: 24px !important;
            font-weight: 500 !important;
        }

        .base-info--panel {
            text-align: right;
            padding: 4px 0;
        }

        .base-info--panel label {
            margin-right: 20px;
        }

        .base-info--panel label i,
        .base-info--panel label span {
            vertical-align: middle;
            font-size: 14px;
            font-weight: 300;
            color: #737373;
        }

        .news-detail .mdl-card__supporting-text {
            width: 100%;
            color: #737373;
        }

        .news-detail .mdl-card__supporting-text img {
            width: 100%;
            margin-bottom: 8px;
        }

        .comment-card {
            padding: 12px;
            min-height: 0;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .error[for='additional-content'] {
            min-height: 20px;
        }

        #btn-comment {
            float: right;
        }

        .comment-list--panel {
            margin-top: 12px;
        }

        .comment-item {
            margin-bottom: 16px;
        }

        .comment-item .head-img {
            border-radius: 24px;
            padding: 3px;
            background-color: #f5f5f5;
            vertical-align: top;
        }

        .comment-content {
            display: inline-block;
            width: 900px;
            margin-left: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            margin-bottom: 12px;
        }

        .comment-content p {
            margin-bottom: 0;
        }

        .comment-content span {
            font-size: 12px;
            display: inline-block;
            color: #737373;
            font-weight: 300;
            padding: 3px 0 6px 0;
        }

        .comment-panel.affix {
            position: absolute;
            top: 0; /* Set the top position of pinned element */
        }

    </style>
@endsection

@section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 4,'type' =>$data['type']])
@endsection

@section('content')

    <div class="info-panel">
        <div class="container">
            <div class="info-panel">
                <div class="mdl-card mdl-shadow--2dp info-card news-detail">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text" data-content="{{$data['news']->nid}}">
                            {{$data['news']->title}}
                        </h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border base-info--panel">
                        {{--<label><span>作者: {{$data['news']->uid}}</span></label>--}}
                        <label><span>作者: admin</span></label>
                        <label><span>发布时间: {{$data['news']->created_at}}</span></label>
                        <label><i class="material-icons">visibility</i>
                            <span>{{$data['news']->view_count}}</span></label>
                        <label><i class="material-icons">comment</i> <span>{{sizeof($data['review'])}}</span></label>
                    </div>

                    <div class="mdl-card__supporting-text">

                    </div>
                </div>
            </div>

            {{--<div class="gap"></div>--}}

            <div class="info-panel">

                <div class="comment-panel">
                    <div class="mdl-card info-card comment-card">
                        <form id="comment-form" method="post">
                            <input type="hidden" name="nid" value="{{$data['news']->nid}}"/>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="2" class="form-control" name="content"
                                              id="additional-content"
                                              placeholder="写点什么..."></textarea>
                                </div>
                                <div class="help-info" id="comment-help">还可输入114字</div>
                                <label class="error" for="additional-content"></label>
                            </div>

                            <button id="btn-comment" type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                评论
                            </button>
                        </form>
                    </div>

                    <h6>评论列表</h6>

                    <div class="mdl-card__actions mdl-card--border comment-list--panel">

                        @if(sizeof($data['review']) === 0)
                            <p>暂无评论</p>
                        @else
                            @foreach($data['review'] as $comment)
                                <div class="comment-item">
                                    @if($comment->photo == null || $comment->photo == "")
                                        <img src="{{asset('images/default-img.png')}}" class="head-img" width="48"
                                             height="48"/>
                                    @else
                                        @if($comment->type == 1)
                                            <img src="{{$comment->photo}}" class="head-img" width="48" height="48"/>
                                        @else
                                            <img src="{{$comment->elogo}}" class="head-img" width="48" height="48"/>
                                        @endif
                                    @endif

                                    <div class="comment-content">
                                        <p><b>{{$comment->username}}: </b>&nbsp;&nbsp;{{$comment->content}}</p>
                                        <span>{{$comment->created_at}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            var nid = $(".mdl-card__title-text").attr("data-content");

            $.ajax({
                url: "/news/content?nid=" + nid,
                type: "get",
                success: function (data) {
                    var content = data['news']['content'];
                    var images = data['news']['picture'];
                    var imageTemp = images.split(";");
                    var imagesArray = [];

                    for (var i in imageTemp) {
                        imagesArray[i + ''] = imageTemp[i + ''].split("@");
                    }

                    var baseUrl = imagesArray[0][0].substring(0, imagesArray[0][0].length - 1);
                    imagesArray[0][0] = imagesArray[0][0].replace(baseUrl, '');

                    console.log(imagesArray);
                    console.log(baseUrl);
                    console.log();

                    for (var j = 0; j < imagesArray.length; j++) {
                        content = content.replace("[图片" + imagesArray[j][0] + "]", "<img src='" + baseUrl + imagesArray[j][1] + "'/>");
                    }

                    $(".mdl-card__supporting-text").html(content);
                }
            })
        });

        var maxSize = 114;

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $('textarea').keyup(function () {

            var length = $(this).val().length;
            if (length > maxSize) {
                $(".error[for='additional-content']").html("内容超过114字");
                $("#btn-comment").prop("disabled", true);
            } else {
                $(".error[for='additional-content']").html("");
                $("#btn-comment").prop("disabled", false);
            }

            $("#comment-help").html("还可输入" + (maxSize - length < 0 ? 0 : maxSize - length) + "字");

        });

        $commentForm = $("#comment-form");

        $("button[type='submit']").click(function (event) {
            event.preventDefault();
            var $commentContent = $("#additional-content").val();

            if ($commentContent.length === 0) {
                $(".error[for='additional-content']").html("内容不能为空");
                $("#btn-comment").prop("disabled", true);
                return;
            }

            if ($commentContent.length > maxSize) {
                $(".error[for='additional-content']").html("内容超过" + maxSize + "字");
                $("#btn-comment").prop("disabled", true);
                return;
            }

            var formData = new FormData();
            formData.append("nid", $("input[name='nid']").val());
            formData.append("content", $commentContent);

            $.ajax({
                url: "/news/addReview",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "评论成功", result.msg, null);
                }
            })

        })
    </script>
@endsection
