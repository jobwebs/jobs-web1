@extends('layout.master')
@section('title', '投递详情')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .mdl-card__title-text {
            position: relative;
            top: 4px;
        }

        .base-info__title {
            width: 480px !important;
        }

        .resume-child-card {
            width: 100%;
            min-height: 0;
            padding-bottom: 40px;
            /*margin-bottom:20px;*/
        }

        .resume-child-card .mdl-card__title-text {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .resume-child-card .mdl-card__supporting-text {
            padding-bottom: 0;
        }

        .intention-panel p,
        .education-panel p {
            padding: 5px 25px;
            display: inline-block;
            color: var(--primary-color);
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p {
            display: block !important;
        }

        .intention-panel p span {
            color: var(--text-color-secondary);
            font-size: 14px;
        }

        .education-panel p span {
            margin-right: 10px;
        }

        .skill-panel span {
            display: inline-block;
            background: var(--blue-sky);
            padding: 8px 25px 8px 12px;
            margin: 6px;
            font-size: 13px;
            font-weight: 300;
            color: var(--snow);
            border-radius: 3px;
            position: relative;
        }

        .additional-panel p {
            padding: 0 8px;
        }

        h6.resume-response--title {
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

                <div class="mdl-card mdl-shadow--2dp info-card">
                    <div class="mdl-card resume-child-card">
                        <div class="mdl-card__title">
                            <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                    to="/position/deliverList">
                                <i class="material-icons">arrow_back</i>
                            </button>

                            <h5 class="mdl-card__title-text" style="margin-left: 16px;">xxx的简历</h5>
                        </div>

                        {{--base resume info--}}
                        <div class="mdl-card resume-child-card base-info--user" style="padding-bottom: 50px;">
                            <div class="base-info__header">
                                <img class="img-circle info-head-img" src="{{asset('images/avatar.png')}}" width="70px"
                                     height="70px">

                                <div class="base-info__title">
                                    <p>姓名未填写</p>
                                    <p><span>性别未填写</span> |
                                        <span>生日未填写</span> |
                                        <span>居住地未填写</span>
                                    </p>
                                </div>
                            </div>

                            <div class="mdl-card__actions mdl-card--border">
                                <div class="mdl-card__supporting-text">
                                    自我评价未填写
                                </div>
                            </div>

                            <ul class="mdl-list base-info__contact">
                                <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">phone</i>
                               手机号未填写
                            </span>
                                </li>
                                <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">email</i>
                               邮箱未填写
                            </span>
                                </li>
                            </ul>
                        </div>

                        {{--intention--}}
                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <h5 class="mdl-card__title-text">求职意向</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border intention-panel">
                                {{--<div class="mdl-card__supporting-text">--}}
                                {{--没有填写求职意向--}}
                                {{--</div>--}}

                                <p>地区：
                                    <span>任意</span>
                                </p>

                                <p>行业分类：
                                    <span>任意</span>
                                </p>

                                <p>职业分类：
                                    <span>任意</span>
                                </p>
                                <p>工作类型：
                                    <span>任意</span>
                                </p>

                                <p>期望薪资（月）:
                                    <span>未指定</span>
                                </p>
                            </div>
                        </div>

                        {{--education--}}
                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <h5 class="mdl-card__title-text">教育经历</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border education-panel">

                                <p>
                                    <span>四川大学</span>
                                    <span>2016-09-01入学</span>
                                    <span>计算机技术</span>
                                    <span>硕士及以上</span>
                                </p>

                                {{--<div class="mdl-card__supporting-text">--}}
                                {{--您还没有填写过教育经历--}}
                                {{--</div>--}}
                            </div>
                        </div>

                        {{--skill--}}
                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <h5 class="mdl-card__title-text">技能特长</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border skill-panel">
                                {{--|@|王者荣耀|至尊星耀|@|LOL|最强王者--}}

                                {{--<div class="mdl-card__supporting-text">--}}
                                {{--没有填写技能特长--}}
                                {{--</div>--}}

                                <span>
                                    <small class="skill-item">王者荣耀|荣耀王者</small>
                                </span>
                            </div>
                        </div>

                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <h5 class="mdl-card__title-text">附加信息</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border additional-panel">

                                <div class="mdl-card__supporting-text">
                                    没有填写附加信息
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">

                <h6 class="resume-response--title">
                    回复 xxxx 的简历
                </h6>

                <div class="mdl-card info-card response-card">
                    <form method="post" id="response-form">
                        <input type="hidden" name="rid" value=""/>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="3" class="form-control" name="content"
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

                <h6 class="resume-response--title">
                    快速回复
                </h6>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">
                    立即录用
                </button>
                <br>
                <br>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-tomato">
                    婉拒
                </button>

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
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {

                $.ajax({
                    url: "/message/delDialog?id=" + $("input[name='id']").val(),
                    type: "get",
                    success: function (data) {
                        swal(data['status'] === 200 ? "删除成功" : "删除失败");

                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/message";
                            }, 1000);
                        }
                    }
                });
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
