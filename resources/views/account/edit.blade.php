@extends('layout.master')
@section('title', '修改资料')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .edit-card {
            width: 100%;
            margin: 50px 0;
            padding-bottom: 20px;
        }

        .edit-panel {
            padding: 20px 32px;

        }

        .head-img--holder {
            display: inline-block;
            border: 2px dashed var(--divider);
            margin-right: 32px;
        }

        .base-info-holder {
            width: 500px;
            display: inline-block;
            vertical-align: top;
        }

        .head-img--holder .head-img {
            width: 100px;
            height: 100px;
            display: inline-block;
        }

        .head-img--holder span {
            display: inline-block;
            cursor: pointer;
            width: 100px;
            padding: 3px 10px;
            font-size: 14px;
            text-align: center;
        }

        .head-img--holder span:hover {
            background: var(--divider);
        }

        label[for="male"],
        label[for="female"],
        label[for="married"],
        label[for="unmarried"] {
            margin-right: 48px;
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
    </style>
@endsection

@section('header-nav')
    @if($uid === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $username])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">

            @if($type == 1)
                <div class="edit-card mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                to="/account/">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <h5 class="mdl-card__title-text" style="margin-left: 16px;">个人资料修改</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border edit-panel">
                        <form class="edit-form" method="post" id="edit-form">
                            <div class="head-img--holder">
                                <img class="head-img" id="head-img" src="{{asset('images/default-img.png')}}"><br>
                                <input type="file" hidden name="head-img" onchange="showPreview(this)">
                                <span id="upload-head--img">上传头像</span>
                            </div>

                            <div class="base-info-holder">

                                <label for="pname">名字</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="pname" name="pname" class="form-control"
                                               placeholder="真实姓名">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中，建议填写真实姓名</div>
                                    <label class="error" for="pname"></label>
                                </div>

                                <label for="residence">居住地</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="residence" name="residence" class="form-control"
                                               placeholder="现居住城市">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中，建议填写：城市-区县</div>
                                    <label class="error" for="residence"></label>
                                </div>

                                <label for="register_place">户口所在地</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="register_place" name="register_place"
                                               class="form-control"
                                               placeholder="户口所在地">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中，建议填写：省份-城市-区县</div>
                                    <label class="error" for="register_place"></label>
                                </div>

                                <label for="tel">联系电话</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="tel" name="tel" class="form-control phone"
                                               placeholder="手机号: 999-9999-9999">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中</div>
                                    <label class="error" for="tel"></label>
                                </div>

                                <label for="mail">联系邮箱</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="mail" name="mail" class="form-control email"
                                               placeholder="邮箱地址: example@example.com">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中</div>
                                    <label class="error" for="mail"></label>
                                </div>

                                <div style="height: 150px;"></div>

                                <label for="male">性别</label>
                                <div class="form-group" style="margin-top: 8px;">
                                    <div class="form-line">
                                        <input name="sex" type="radio" id="male" class="radio-col-light-blue"
                                               value="1"/>
                                        <label for="male">男</label>
                                        <input name="sex" type="radio" id="female" class="radio-col-light-blue"
                                               value="2"/>
                                        <label for="female">女</label>
                                        <input name="sex" type="radio" id="sex-question" class="radio-col-light-blue"
                                               value="0" checked/>
                                        <label for="sex-question">未填写</label>
                                    </div>
                                    <div class="help-info">将显示在简历中</div>
                                </div>

                                <label for="marriage">婚姻</label>
                                <div class="form-group" style="margin-top: 8px;">
                                    <div class="form-line">
                                        <input name="is_marry" type="radio" id="unmarried" class="radio-col-light-blue"
                                               value="1"/>
                                        <label for="unmarried">未婚</label>
                                        <input name="is_marry" type="radio" id="married" class="radio-col-light-blue"
                                               value="2"/>
                                        <label for="married">已婚</label>
                                        <input name="is_marry" type="radio" id="question-marry"
                                               class="radio-col-light-blue"
                                               value="0" checked/>
                                        <label for="question-marry">未填写</label>
                                    </div>
                                    <div class="help-info">将显示在简历中</div>
                                </div>

                                <label for="birthday">出生日期</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" id="birthday" name="birthday" class="form-control"
                                               placeholder="不能为空">
                                    </div>
                                    <div class="help-info">将用于职位推荐</div>
                                    <label class="error" for="birthday"></label>
                                </div>

                                <label for="political">政治面貌</label>
                                <div class="form-group">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="political"
                                            name="political">
                                        <option value="-1">请选择政治面貌</option>
                                        <option value="0">少先队</option>
                                        <option value="1">共青团团员</option>
                                        <option value="2">共产党党员</option>
                                        <option value="3">其他党派</option>
                                        <option value="4">无党派人士</option>
                                        <option value="5">人民群众</option>
                                    </select>
                                    <div class="help-info"></div>
                                    <label class="error" for="enterprise-type"></label>
                                </div>

                                <label for="education">最高学历</label>
                                <div class="form-group">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="education"
                                            name="education">
                                        <option value="9">请选择最高学历</option>
                                        <option value="0">高中</option>
                                        <option value="1">本科</option>
                                        <option value="2">研究生及以上</option>
                                    </select>
                                    <div class="help-info">将用于职位推荐</div>
                                    <label class="error" for="education"></label>
                                </div>

                                <label for="self-evaluation">自我评价</label>
                                <div class="form-group">
                                    <div class="form-line">
                                <textarea rows="3" class="form-control" name="self_evalu" id="self-evaluation"
                                          placeholder="可选"></textarea>
                                    </div>
                                    <div class="help-info">将显示在简历中</div>
                                    <label class="error" for="self-evaluation"></label>
                                </div>

                                <button id="personal-info--change_button"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    确认修改
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif


            @if($type==2)
                <div class="edit-card mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                to="/account/">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <h5 class="mdl-card__title-text" style="margin-left: 16px;">公司资料修改</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border edit-panel">
                        <form class="edit-form" method="post" id="edit-form">
                            <div class="head-img--holder">
                                <img class="head-img" id="head-img" src="{{asset('images/default-img.png')}}"><br>
                                <input type="file" hidden name="head-img">
                                <span id="upload-head--img">上传Logo</span>
                            </div>

                            <div class="base-info-holder">

                                <label for="name">公司名称</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control" value="公司名称"
                                               disabled="disabled">
                                    </div>
                                    <div class="help-info">公司名称只有在企业审核时修改</div>
                                    <label class="error" for="name"></label>
                                </div>

                                <label for="name">所在城市</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="公司所在城市">
                                    </div>
                                    <div class="help-info">如果有多个办公城市，使用空格隔开</div>
                                    <label class="error" for="name"></label>
                                </div>

                                <label for="enterprise-type">企业类型</label>
                                <div class="form-group">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="enterprise-type"
                                            name="type">
                                        <option value="0">请选择企业类型</option>
                                        <option value="1">国有企业</option>
                                        <option value="2">民营企业</option>
                                        <option value="3">中外合资企业</option>
                                        <option value="4">外资企业</option>
                                    </select>
                                    <div class="help-info">将显示在已发布的职位详情中</div>
                                    <label class="error" for="enterprise-type"></label>
                                </div>

                                <label for="enterprise-scale">企业规模</label>
                                <div class="form-group">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="enterprise-scale"
                                            name="scale">
                                        <option value="0">请选择企业规模</option>
                                        <option value="1">少于50人</option>
                                        <option value="2">50人至200人</option>
                                        <option value="3">200至500人</option>
                                        <option value="4">500人至1000人</option>
                                        <option value="5">1000人以上</option>
                                    </select>
                                    <div class="help-info">将显示在已发布的职位详情中</div>
                                    <label class="error" for="enterprise-scale"></label>
                                </div>

                                <label for="enterprise-url">公司官网</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="url" id="enterprise-url" name="url" class="url form-control"
                                               placeholder="可选，Ex：https://www.example.com">
                                    </div>
                                    <div class="help-info">将显示在已发布的职位详情中，请以 http://, https://开头</div>
                                    <label class="error" for="enterprise-url"></label>
                                </div>

                                <label for="phone">公司联系电话</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="phone" name="phone" class="form-control phone"
                                               placeholder="可选，Ex: 999-9999-9999">
                                    </div>
                                    <div class="help-info">将显示在已发布的职位详情中</div>
                                    <label class="error" for="phone"></label>
                                </div>

                                <label for="email">公司联系邮箱</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email" name="email" class="form-control email"
                                               placeholder="可选，Ex: example@example.com">
                                    </div>
                                    <div class="help-info">将显示在已发布的职位详情中</div>
                                    <label class="error" for="email"></label>
                                </div>

                                <label for="self-evaluation">公司简介</label>
                                <div class="form-group">
                                    <div class="form-line">
                                <textarea rows="3" class="form-control" name="address" id="self-evaluation"
                                          placeholder="可选"></textarea>
                                    </div>
                                    <div class="help-info">将显示在已发布的职位详情中</div>
                                    <label class="error" for="enterprise-address"></label>
                                </div>

                                <button type="submit"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    确认修改
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script type="text/javascript">

        var isCorrect;

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $editForm = $(".edit-form");
        $editForm.find(".email").inputmask({alias: "email"});
        $editForm.find(".phone").inputmask('999-9999-9999', {placeholder: '___-____-____'});

        $("#upload-head--img").click(function () {
            swal({
                title: "要求",
                text: "上传图片要求：格式为：.jpg，.jpeg，.png\n分辨率最大支持 1000像素 * 1000像素\n图片文件大小最大支持5MB",
                confirmButtonText: "知道了",
                closeOnConfirm: true
            }, function () {
                $("input[name='head-img']").click();
            });
        });

        $("#personal-info--change_button").click(function (event) {
            event.preventDefault();
            var pname = $("input[name='pname']");
            var residence = $("input[name='residence']");
            var registerPlace = $("input[name='register_place']");
            var tel = $("input[name='tel']");
            var mail = $("input[name='mail']");

            // optional
            var gender = $("input[name='sex']").val();
            var marriage = $("input[name='is_marry']").val();
            var birthday = $("input[name='birthday']").val();
            var political = $("select[name='political']").val();
            var degree = $("select[name='education']").val();
            var selfEvaluation = $("textarea[name='self_evalu']").val();

            if (pname.val() === "") {
                setError(pname, "pname", "不能为空");
                return;
            } else {
                removeError(pname, "pname");
            }

            if (residence.val() === "") {
                setError(residence, "residence", "不能为空");
                return;
            } else {
                removeError(residence, "residence");
            }

            if (registerPlace.val() === "") {
                setError(registerPlace, "register_place", "不能为空");
                return;
            } else {
                removeError(registerPlace, "register_place");
            }

            if (tel.val() === "") {
                setError(tel, "tel", "不能为空");
                return;
            } else {
                removeError(tel, "tel");
            }

            if (mail.val() === "") {
                setError(mail, "mail", "不能为空");
                return;
            } else {
                removeError(mail, "mail");
            }

            var formData = new FormData();
            formData.append("pname", pname.val());
            formData.append("residence", residence.val());
            formData.append("register_place", registerPlace.val());
            formData.append("tel", tel.val());
            formData.append("mail", mail.val());
            if (gender === "") formData.append("sex", gender);
            if (marriage === "") formData.append("is_marry", marriage);
            if (birthday === "") formData.append("birthday", birthday);
            if (political === "") formData.append("political", political);
            if (degree === "") formData.append("education", degree);
            if (selfEvaluation === "") formData.append("self_evalu", selfEvaluation);


            $.ajax({
                url: "/account/editPersonInfo",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "资料已修改", result.msg, null);
                }
            })
        });

        function showPreview(element) {
            isCorrect = true;

            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            console.log(objectUrl);


            var headImagePath = $("input[name='head-img']").val();

            console.log(headImagePath);


            if (!/.(jpg|jpeg|png)$/.test(headImagePath)) {
                isCorrect = false;
                swal({
                    title: "错误",
                    text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else {
                var size = file.size;
                console.log(size);

                if (size > 2 * 1024 * 1024) {
                    swal({
                        title: "错误",
                        text: "图片文件最大支持：2MB",
                        cancelButtonText: "关闭",
                        showCancelButton: true,
                        showConfirmButton: false
                    });
                } else {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var data = e.target.result;
                        //加载图片获取图片真实宽度和高度
                        var image = new Image();
                        image.onload = function () {
                            var width = image.width;
                            var height = image.height;
                            console.log(width + "//" + height);

                            if (width > 1000 || height > 1000) {
                                isCorrect = false;

                                swal({
                                    title: "错误",
                                    text: "当前选择图片分辨率为: " + width + "px * " + height + "px \n图片分辨率最大支持 1000像素 * 1000像素",
                                    cancelButtonText: "关闭",
                                    showCancelButton: true,
                                    showConfirmButton: false
                                });
                            } else if (isCorrect) {
                                $("#head-img").attr("src", objectUrl);
                            }
                        };
                        image.src = data;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
@endsection
