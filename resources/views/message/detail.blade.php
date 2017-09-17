@extends('layout.master')
@section('title', '消息详情')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .message-panel {
            min-height: 500px;
            padding: 0;
        }

        .message-content {
            width: 100%;
            padding: 25px 16px;
        }

        .message-content p,
        .message-content a {
            color: var(--text-color-primary);
        }

        .message-content ul {
            display: block;
            float: none;
        }

        .message-content ul li {
            display: block;
            position: relative;
            overflow: hidden;
            zoom: 1;
            padding: 15px 10px 14px;
            margin: 0;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .message-content .pic {
            float: left;
            margin: 0 16px 0 0;
            position: relative;
        }

        .pic img {
            width: 36px;
            height: 36px;
        }

        .message-content .date {
            display: block;
            text-align: center;
            padding-top: 16px;
        }

        .date .divider {
            width: 100%;
            height: 1px;
            background: var(--divider);
        }

        .date span {
            background-color: var(--snow);
            position: relative;
            top: -12px;
            padding: 0 12px;
            font-size: 13px;
            color: var(--text-color-light);
        }

        .message-content .title {
            zoom: 1;
            word-wrap: break-word;
            line-height: 1.5;
            cursor: pointer;
        }

        .message-content .title .sender {
            margin: -2px 0 2px;
            color: var(--text-color-secondary);
            font-size: 13px;
        }

        .sender .time {
            float: right;
            color: #999;
        }

        .message-content p {
            margin: 0;
            width: 80%;
            min-height: 14px;
            line-height: 1.4;
            display: block;
            color: var(--text-color-primary);
            font-weight: 400;
            font-size: 13px;
            margin-left: 52px;
        }

        .message-content li:hover .operations a {
            display: inline-block;
        }

        .message-content .operations {
            position: absolute;
            bottom: 12px;
            right: 12px;
        }

        .operations a {
            display: none;
            position: relative;
            font-weight: 400;
            font-size: 12px;
            cursor: pointer;
        }

        .operations a:hover {
            color: var(--blue-sky);
            text-decoration: underline;
        }

        .mdl-card__menu input[type='checkbox'] {
            left: 0 !important;
            opacity: 1 !important;
            float: right;
        }

        #back-to--message-list {
            float: left;
        }

        h6.message-response--title {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            margin: 24px 0 16px 0;
        }

        .response-card {
            padding: 12px;
            min-height: 0;
        }

        #btn-response {
            margin-top: 12px;
            float: right;
        }

        .error[for='response-content'] {
            min-height: 20px;
        }

        #btn-response {
            float: right;
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
    @include('components.headerTab', ['activeIndex' => 2])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">
            <div class="info-panel--left info-panel">
                <h6>
                    与
                    @if($data['userinfo'][0]->pname == "")
                        "未命名"
                    @else
                        "{{$data['userinfo'][0]->pname}}"
                    @endif
                    的对话
                </h6>

                <div class="mdl-card mdl-shadow--2dp info-card">

                    <div class="mdl-card__title">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                to="/message/">
                            <i class="material-icons">arrow_back</i>
                        </button>
                    </div>

                    <div class="mdl-card__menu">

                        <button class="mdl-button mdl-button--icon mdl-js-button" id="delete-message">
                            <i class="material-icons">delete</i>
                        </button>


                        <div class="mdl-tooltip" data-mdl-for="delete-message">
                            删除对话
                        </div>

                    </div>

                    <div class="mdl-card__actions mdl-card--border message-panel">
                        <div class="message-content">
                            <ul>
                                @foreach($data['message'] as $item)
                                    <li>
                                        <div class="date">
                                            <div class="divider"></div>
                                            <span>{{$item->created_at}}</span>
                                        </div>

                                        <div class="pic">
                                            <a href="">
                                                <img src="{{asset('images/avatar.png')}}">
                                            </a>
                                        </div>

                                        <div class="title">

                                            <div class="sender">
                                                {{--<span class="time">12:00</span>--}}
                                                <span class="from">
                                                    @if($data['from_id'] == $item->from_id)
                                                        @if($data['userinfo'][0]->pname == "")
                                                            未命名
                                                        @else
                                                            {{$data['userinfo'][0]->pname}}
                                                        @endif
                                                    @else
                                                        我
                                                    @endif
                                                </span>
                                            </div>
                                            <p>
                                                {{$item->content}}
                                            </p>
                                        </div>

                                        <div class="operations">
                                            <a data-content="{{$item->mid}}">删除</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">

                <h6 class="message-response--title">
                    回应
                    @if($data['userinfo'][0]->pname == "")
                        "未命名"
                    @else
                        "{{$data['userinfo'][0]->pname}}"
                    @endif
                    的消息
                </h6>

                <div class="mdl-card info-card response-card">
                    <form method="post" id="response-form">
                        <input type="hidden" name="to_id" value="{{$data['from_id']}}"/>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="2" class="form-control" name="content"
                                          id="response-content"
                                          placeholder="写点什么..."></textarea>
                            </div>
                            <div class="help-info" id="response-help">还可输入114字</div>
                            <label class="error" for="response-content"></label>

                            <button id="btn-response" type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                回应
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">

        var maxSize = 114;

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $(".operations").find("a").click(function () {
            var mid = new Array($(this).attr("data-content"));

            var formData = new FormData();
            formData.append("mid", mid);

            swal({
                title: "确认",
                text: "确定删除该条消息吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/message/delete",
                    type: "post",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        var result = JSON.parse(data);
                        swal(result.status === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal(xhr.status + "：" + thrownError);
                        //checkResult(400, "", xhr.status + "：" + thrownError, null);
                    }
                })
            });
        });

        $("#delete-message").click(function () {
            swal({
                title: "确认",
                text: "确定删除整个对话吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                swal("删除整个对话的接口未完成");
            });
        });

        $('textarea').keyup(function () {
            var length = $(this).val().length;
            if (length > maxSize) {
                $(".error[for='response-content']").html("内容超过114字");
                $("#btn-response").prop("disabled", true);
            } else {
                $(".error[for='response-content']").html("");
                $("#btn-response").prop("disabled", false);
            }

            $("#response-help").html("还可输入" + (maxSize - length < 0 ? 0 : maxSize - length) + "字");

        });

        $responseForm = $("#response-form");

        $("button[type='submit']").click(function (event) {
            event.preventDefault();

            var content = $("#response-content").val();
            var to_id = $("input[name='to_id']").val();

            if (content.length === 0) {
                $(".error[for='response-content']").html("内容不能为空");
                $("#btn-response").prop("disabled", true);
                return;
            }

            if (content.length > maxSize) {
                $(".error[for='response-content']").html("内容超过" + maxSize + "字");
                $("#btn-response").prop("disabled", true);
                return;
            }

            console.log(to_id);
            console.log(content);

            var formData = new FormData();
            formData.append('to_id', to_id);
            formData.append('content', content);

            $.ajax({
                url: "/message/sendMessage",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "消息已回复", result.msg, null);
                }
            })
        })
    </script>
@endsection
