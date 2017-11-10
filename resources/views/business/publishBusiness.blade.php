@extends('layout.master')
@section('title', '发布合作信息')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .verify-card {
            width: 100%;
            margin: 50px 0;
            padding-bottom: 20px;
        }

        .verify-card > .mdl-card__title {
            padding-bottom: 3px;
        }

        .verify-card > .mdl-card__supporting-text {
            padding-top: 3px;
        }

        .verify-panel {
            padding: 8px 32px;
        }

        .verify-form {
            margin-top: 16px;
        }

        .verify-form {
            width: 100%;
            display: inline-block;
            vertical-align: top;
            padding: 20px 10px;
        }

        .verify-form h3 {
            font-size: 18px;
            font-weight: 500;
            margin: 0 0 30px 0;
            padding: 10px 0 10px 10px;
            background: #f5f5f5;
            /*border-left: 5px solid #03A9F4;*/
            /*width: 380px;*/
        }

        .mdl-card__title-text i {
            color: #4CAF50;
            position: relative;
            font-size: 30px;
            margin-right: 16px;
        }

        .submit-holder {
            margin-top: 24px;
            text-align: end;
        }

        /*.verify-form > button[type='submit'] {*/
        /*text-align: end;*/
        /*}*/

        .verify-form label {
            display: inline-block;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            display: inline-block;
            padding: 6px 12px 6px 0;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
        }

        .dropdown-menu li {
            display: inline-block;
            width: 100%;
            margin: 0;
        }

        .bs-searchbox > input {
            display: inline-block;
            width: 385px !important;

            padding: 6px 12px !important;
        }

        .preview {
            display: inline-block;
            min-width: 100px;
            max-width: 400px;
            min-height: 100px;
            border: 6px solid #ebebeb;
            margin-bottom: 32px;
            position: relative;
        }

        .preview i.material-icons {
            cursor: pointer;
            position: absolute;
            top: 0;
            right: 0;
            background: #F44336;
            color: #ffffff;
        }

        .waiting-verified > h3 {
            font-size: 30px;
        }

        .waiting-verified > h3 > i {
            color: #4CAF50;
            position: relative;
            top: 5px;
            font-size: 30px;
            margin-right: 16px;
        }

        .waiting-verified > p {
            margin-left: 48px;
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
    @include('components.headerTab', ['activeIndex' => 2, 'type'=>$data['type']])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">

            <div class="verify-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                            to="/business/">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    <h5 class="mdl-card__title-text" style="margin-left: 16px;"><i
                                class="material-icons">verified_user</i>企业圈</h5>
                </div>

                <div class="mdl-card__supporting-text" style="margin-left: 48px;">
                    通过发布企业圈消息，吸引更多的商业合作机会。
                </div>

                <div class="mdl-card__actions mdl-card--border verify-panel">
                    @if($data['status']==400)
                        <h3>仅支持审核通过后的企业用户发布企业圈内容</h3>
                        <p>企业号审核通过后即可发布合作信息</p>
                    @else
                    <form class="verify-form" onkeydown="if(event.keyCode==13){return false;}">
                        {{--必填项--}}
                        <label for="enterprise-name">项目标题</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="enterprise-name" name="enterprise-name" class="form-control"
                                       placeholder="不能为空" value="">
                            </div>
                            <div class="help-info" style="color: #F44336">必填项，限制字数20字</div>
                            <label class="error" for="enterprise-name"></label>
                        </div>

                        <label for="enterprise-industry">项目所在城市</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="enterprise-industry"
                                    name="enterprise-industry">
                                <option value="0">请选择城市</option>
                                @foreach($data['region'] as $region)
                                    <option value="{{$region->name}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                            <div class="help-info" style="color: #F44336">必填项</div>
                            <label class="error" for="enterprise-industry"></label>
                        </div>
                        <label for="enterprise-email">联系邮箱</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="enterprise-email" name="enterprise-email"
                                       class="form-control email"
                                       placeholder="必填，Ex: example@example.com"
                                       value="{{$data['connect']->email}}">
                            </div>
                            <div class="help-info" style="color: #F44336">必填项</div>
                            <label class="error" for="enterprise-email"></label>
                        </div>

                        <label for="enterprise-phone">联系电话</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="enterprise-phone" name="enterprise-phone" class="form-control"
                                       placeholder="必填，Ex: (999)999999"
                                       value="{{$data['connect']->etel}}">
                            </div>
                            <div class="help-info" style="color: #F44336">必填项</div>
                            <label class="error" for="enterprise-phone"></label>
                        </div>

                        <label for="enterprise-address">合作详情描述</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="3" class="form-control" name="enterprise-address"
                                          id="enterprise-address"
                                          placeholder="必填，对合作细节进行描述"
                                          value=""></textarea>
                            </div>
                            <div class="help-info" style="color: #F44336">必填项</div>
                            <label class="error" for="enterprise-address"></label>
                        </div>

                        <label for="enterprise-id__card">合作描述图片</label><br>

                        <div class="form-group" id="id-card_holder" style="margin-top: 16px">
                            <button id="id-card__upload-btn"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">
                                点击上传
                            </button>
                        </div>

                        <div id="id-card__preview-holder">
                        </div>

                        {{--<img class="license-img" src="{{asset('images/default-img.png')}}" width="128px">--}}

                        <br>
                        <div class="submit-holder">
                            <button id="submit-verify"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                立即发布
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        var isUploadIdCard = false;

        var idCardHolder = $("#id-card_holder");
        var idCardPreviewHolder = $("#id-card__preview-holder");

        $("#id-card__upload-btn").click(function (event) {
            event.preventDefault();
            swal({
                title: "要求",
                type: "info",
                text: "请上传合法内容图片\n大小限制5M以内\n仅支持.jpg .jpeg .png类型",
                confirmButtonText: "知道了",
                closeOnConfirm: true
            }, function () {
                idCardHolder.append("<input type='file' name='id-card' hidden onchange='showIdCardPreview(this)'/>");
                $("input[name='id-card']").click();
            });
        });

        function showIdCardPreview(element) {
            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            var idCardPath = $("input[name='id-card']").val();

            if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(idCardPath)) {
                isCorrect = false;
                swal({
                    title: "错误",
                    type: "error",
                    text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else if (file.size > 5 * 1024 * 1024) {
                swal({
                    title: "错误",
                    type: "error",
                    text: "图片文件最大支持：5MB",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else {
                idCardPreviewHolder.html("<div class='preview'>" +
                        "<i class='material-icons' onclick='removeIdCardPreview()'>close</i>" +
                        "<img src='" + objectUrl + "' width='384'></div>");
                isUploadIdCard = true;
            }
        }

        function removeIdCardPreview() {
            swal({
                title: "确认",
                text: "确认删除该图片吗？",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true
            }, function () {
                idCardPreviewHolder.html("");
                $("input[name='id-card']").val("");
                isUploadIdCard = false;
            });
        }

        $("#submit-verify").click(function (event) {
            event.preventDefault();

            var idCard = $("input[name='id-card']");
            var title = $("input[name='enterprise-name']");
            var city = $("select[name='enterprise-industry']");
            var email = $("input[name='enterprise-email']");
            var phone = $("input[name='enterprise-phone']");
            var describe = $("textarea[name='enterprise-address']");

            if (title.val() === "") {
                setError(title, "enterprise-name", "不能为空");
                return;
            } else {
                removeError(title, "enterprise-name");
            }

            if (city.val() === "0") {
                setError(city, "enterprise-industry", "请选择所在城市");
                return;
            } else {
                removeError(city, "enterprise-industry");
            }

            if (email.val() === "") {
                setError(email, "enterprise-email", "不能为空");
                return;
            } else {
                removeError(email, "enterprise-email");
            }

            if (phone.val() === "") {
                setError(phone, "enterprise-phone", "不能为空");
                return;
            } else {
                removeError(phone, "enterprise-phone");
            }

            if (describe.val() === "") {
                setError(describe, "enterprise-address", "不能为空");
                return;
            } else {
                removeError(describe, "enterprise-address");
            }

            var formData = new FormData();

            formData.append("title", title.val());
            formData.append("city", city.val());
            formData.append("email", email.val());
            formData.append("etel", phone.val());
            formData.append("content", describe.val());

            if (!isUploadIdCard) {
                swal({
                    title: "确认",
                    type: "info",
                    text: "确定不上传描述图片",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else {
                formData.append('picture', idCard.prop("files")[0]);
            }

            $.ajax({
                url: "/business/publish/upload",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    console.log(data);
                    var result = JSON.parse(data);
                    checkResult(result.status, "资料已修改", result.msg, null);
                }
            })
        });


        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });
        $verifyForm = $(".verify-form");
        $verifyForm.find(".email").inputmask({alias: "email"});
        $verifyForm.find(".id-card").inputmask('999999 99999999 999*', {placeholder: '______ ________ ____'});
    </script>
@endsection
