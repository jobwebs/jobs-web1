@extends('layout.master')
@section('title', '注册')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

    <style>

        .register-card-holder {
            width: 100%;
            min-height: 450px;
            background: url({{asset('images/akali_vs_baron_3.jpg')}}) no-repeat center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding: 80px 0
        }

        .register-card-holder > h3,
        .register-card-holder > p {
            min-width: 800px;
            font-weight: 300;
            text-align: center;
            /*color: var(--primary-color);*/
            color: white;
        }

        .register-card-holder > p {
            padding-bottom: 32px;
        }

        .register-card {
            width: 800px;
            height: 430px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, .95);
            padding: 0 30px;
            border: 1px solid lightgray;
        }

        .register-card > h5 {
            font-weight: 300;
            text-align: center;
            color: rgb(0, 0, 0);
        }

        .register-form {
            width: 370px;
            border-right: 1px solid #4d4d4d;
        }

        #phone-verify-code .form-line {
            position: relative;
        }

        #phone-verify-code .form-line input[type='button'] {
            width: 150px;
            position: absolute;
            right: 0;
            bottom: 1px;
            color: var(--text-color-primary);
        }

        #phone-verify-code .form-line input[type="button"]:hover {
            color: var(--text-color-primary);
        }

        #register-verify-code {
            width: 206px;
            display: inline-block;
        }

        #right-panel {
            width: 365px;
            padding-left: 30px;
        }

        .form-group {
            width: 340px;
        }

        .form-group .form-line input {
            background-color: transparent;
        }

        #right-panel a {
            color: var(--blue-sky);
            text-decoration: underline;
        }

        a {
            cursor: pointer;
        }

    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => false])
@endsection

@section('content')

    <div class="register-card-holder">
        <h3><?=$site_name ?> <?=$site_desc ?></h3>
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.--}}
        {{--Aenan convallis.</p>--}}

        <div class="register-card mdl-card mdl-shadow--2dp">
            <h5>立即加入 <?=$site_name?></h5>

            <table border="0">
                <tr>
                    <td>
                        <form method="post" class="register-form" id="register-form">

                            <div class="form-group" id="phone-form">
                                <div class="form-line">
                                    <input type="text" id="phone" name="tel" class="phone form-control"
                                           placeholder="手机号...">
                                </div>
                                <label class="error" for="phone"></label>
                            </div>

                            <div class="form-group" id="email-form">
                                <div class="form-line">
                                    <input type="text" id="email" name="mail" class="email form-control"
                                           placeholder="邮箱...">
                                </div>
                                <label class="error" for="email"></label>
                            </div>

                            <div class="form-group" id="phone-verify-code">
                                <div class="form-line">
                                    <input type="text" id="register-verify-code" name="verify-code" class="form-control"
                                           placeholder="验证码...">
                                    <input type="button" id="send-SMS" value="发送验证码"
                                           class="mdl-button mdl-js-button mdl-button-default button-border"/>
                                </div>
                                <label class="error" for="register-verify-code"></label>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" name="password" class="password form-control"
                                           placeholder="密码...">
                                </div>
                                <label class="error" for="password"></label>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="conform-password" name="passwordConfirm"
                                           class="form-control"
                                           placeholder="确认密码...">
                                </div>
                                <label class="error" for="conform-password"></label>
                            </div>

                            <div class="form-group">
                                <input name="type" type="radio" id="personal" class="radio-col-light-blue" value="1"
                                       checked/>
                                <label for="personal">个人用户注册</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="type" type="radio" id="enterprise" class="radio-col-light-blue" value="2"/>
                                <label for="enterprise">企业用户注册</label>
                            </div>

                            <button type="submit" id="register-btn"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                立即注册
                            </button>
                        </form>
                    </td>
                    <td>
                        <div id="right-panel">
                            <p>你还可以使用邮箱来注册 esporthr
                                <a for="phone-form" onclick="switchRegisterType(0)">使用手机号注册</a>
                                <a for="email-form" onclick="switchRegisterType(1)">使用邮箱注册</a>
                            </p>
                            <p>已经有账号了？
                                <button to="/account/login"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    立即登录
                                </button>
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

    <script type="text/javascript">
        $registerForm = $("#register-form");
        $registerVerifyCode = $("#register-verify-code");

        $("#email-form").hide();
        $("a[for='phone-form']").hide();
        $registerVerifyCode.prop("disabled", true);

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        function switchRegisterType(type) {
            if (type === 0) {
                $("a[for='phone-form']").hide();
                $("a[for='email-form']").fadeIn(500);
                $("#email-form").hide();
                $("#phone-form").fadeIn(500);
                $("#phone-verify-code").fadeIn(500);
            } else if (type === 1) {
                $("a[for='phone-form']").fadeIn(500);
                $("a[for='email-form']").hide();
                $("#email-form").fadeIn(500);
                $("#phone-form").hide();
                $("#phone-verify-code").hide();
            }
        }

        $registerForm.find(".email").inputmask({alias: "email"});
        $registerForm.find(".phone").inputmask('99999999999', {placeholder: '___________'});

        $("#send-SMS").click(function () {
            var phone = $('#phone');
            if (phone.is(':visible') && phone.val() === '') {
                setError(phone, 'phone', '不能为空');
            } else {
                removeError(phone, 'phone');

                var form_data = new FormData();
                form_data.append('telnum', phone.val());

                countDown(this, 30);

                // todo 2017-09-12 /account/sendSms 使用这个接口
                // t
                $.ajax({
                    url: "/account/sms",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: "post",
                    data: form_data,
                    success: function () {
                        $registerVerifyCode.prop("disabled", false);
                        $registerVerifyCode.focus();
                    }
                });
            }
        });


        $("button[type='submit']").click(function (event) {
            event.preventDefault();

            var phone = $('#phone');
            var email = $('#email');
            var code = $('#register-verify-code');
            var pwd = $('#password');
            var conformPwd = $('#conform-password');

            if (phone.is(':visible') && phone.val() === '') {
                setError(phone, 'phone', '不能为空');
                return;
            } else {
                removeError(phone, 'phone');
            }

            if (code.is(':visible') && code.val() === '') {
                setError(code, 'register-verify-code', '不能为空');
                return;
            } else {
                removeError(code, 'register-verify-code');
            }

            if (email.is(':visible') && email.val() === '') {
                setError(email, 'email', '不能为空');
                return;
            } else {
                removeError(email, 'email')
            }

            if (pwd.val() === '') {
                setError(pwd, 'password', '不能为空');
                return;
            } else {
                removeError(pwd, 'password');
            }

            if (conformPwd.val() === '') {
                setError(conformPwd, 'conform-password', '不能为空');
                return;
            } else if (pwd.val() !== conformPwd.val()) {
                setError(conformPwd, 'conform-password', '两次密码输入不一致');
            } else {
                removeError(conformPwd, 'conform-password');
            }

            $registerForm.action = '/account/register';
            $registerForm.submit();

        });

        function countDown(obj, second) {

            // 如果秒数还是大于0，则表示倒计时还没结束
            if (second >= 0) {
                // 获取默认按钮上的文字
                if (typeof buttonDefaultValue === 'undefined') {
                    buttonDefaultValue = obj.defaultValue;
                }
                // 按钮置为不可点击状态
                obj.disabled = true;
                // 按钮里的内容呈现倒计时状态
                obj.value = buttonDefaultValue + ' (' + second + ')';
                // 时间减一
                second--;
                // 一秒后重复执行
                setTimeout(function () {
                    countDown(obj, second);
                }, 1000);
                // 否则，按钮重置为初始状态
            } else {
                // 按钮置未可点击状态
                obj.disabled = false;
                // 按钮里的内容恢复初始状态
                obj.value = buttonDefaultValue;
            }
        }
    </script>
@endsection
