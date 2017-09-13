@extends('layout.master')
@section('title', '重置密码')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

    <style>
        .findPassword-card-holder {
            width: 100%;
            min-height: 450px;
            background: url({{asset('images/akali_vs_baron_3.jpg')}}) no-repeat center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding: 80px 0
        }

        .form-group .form-line input {
            background-color: transparent;
        }

        .findPassword-card {
            width: 800px;
            height: 380px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, .95);
            padding: 0 30px;
            border: 1px solid lightgray;
        }

        .findPassword-card > h5 {
            font-weight: 300;
            text-align: center;
            color: rgb(0, 0, 0);
            padding-bottom: 40px;
        }

        .findPassword-input {
            width: 370px;
            display: block;
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

        .findPassword-card > button {
            width: 88px;
            margin-right: 16px;
        }

        small {
            margin-bottom: 16px;
        }

        .reset-type--btn {
            width: 200px !important;
            vertical-align: middle;
            margin-bottom: 24px;
        }
    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => false])
@endsection

@section('content')
    <div class="findPassword-card-holder">

        <div class="findPassword-card mdl-card mdl-shadow--2dp reset-1">
            <h5>忘记密码了？重置密码</h5>
            <small>第1步：选择验证方式</small>

            <button data-content="phone"
                    class="reset-type--btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                <i class="material-icons">phone</i>&nbsp;&nbsp;使用手机号重置密码
            </button>

            <button data-content="email"
                    class="reset-type--btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                <i class="material-icons">email</i>&nbsp;&nbsp;使用邮箱重置密码
            </button>
        </div>

        <div class="findPassword-card mdl-card mdl-shadow--2dp reset-2">
            <h5>忘记密码了？重置密码</h5>
            <small>第2步：验证手机号／邮箱</small>

            <div class="form-group findPassword-input" id="phone-form">
                <div class="form-line">
                    <input type="text" id="phone" name="tel" class="phone form-control"
                           placeholder="手机号...">
                </div>
                <label class="error" for="phone"></label>
            </div>

            <div class="findPassword-input form-group" id="email-form">
                <div class="form-line">
                    <input type="text" id="email" name="mail" class="email form-control"
                           placeholder="邮箱...">
                </div>
                <label class="error" for="email"></label>
            </div>

            <div class="findPassword-input form-group" id="phone-verify-code">
                <div class="form-line">
                    <input type="text" id="register-verify-code" name="verify-code" class="form-control"
                           placeholder="验证码...">
                    <input type="button" id="send-SMS" value="发送验证码"
                           class="mdl-button mdl-js-button mdl-button-default button-border"/>
                </div>
                <label class="error" for="register-verify-code"></label>
            </div>

            <label>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky next-step">
                    下一步
                </button>
                <button class="mdl-button button-link prev-step">
                    返回上一步
                </button>
            </label>
        </div>

        <div class="findPassword-card mdl-card mdl-shadow--2dp reset-3">
            <h5>忘记密码了？重置密码</h5>
            <small>第3步：设置新的登录密码</small>

            <div class="findPassword-input form-group">
                <div class="form-line">
                    <input type="password" id="password" name="password" class="password form-control"
                           placeholder="密码...">
                </div>
                <label class="error" for="password"></label>
            </div>

            <div class="findPassword-input form-group">
                <div class="form-line">
                    <input type="password" id="conform-password" name="passwordConfirm"
                           class="form-control"
                           placeholder="确认密码...">
                </div>
                <label class="error" for="conform-password"></label>
            </div>

            <label>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky next-step">
                    确认重置
                </button>
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect button-link prev-step">
                    上一步
                </button>
            </label>
        </div>
    </div>
@endsection

@section("custom-script")
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

    <script type="text/javascript">
        var currentStep = 1;

        $registerVerifyCode = $("#register-verify-code");
        $registerVerifyCode.prop("disabled", true);

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $(".email").inputmask({alias: "email"});
        $(".phone").inputmask('99999999999', {placeholder: '___________'});

        $step1 = $(".reset-1");
        $step2 = $(".reset-2");
        $step3 = $(".reset-3");

        $step2.hide();
        $step3.hide();

        var type = 1; // 1:phone; 2:email;

        $(".reset-type--btn[data-content='phone']").click(function () {
            $step1.hide();
            currentStep = 2;
            type = 1;

            $("#email-form").hide();
            $("#phone-form").show();
            $("#phone-verify-code").show();
            $step2.fadeIn(500);
        });

        $(".reset-type--btn[data-content='email']").click(function () {
            $step1.hide();
            currentStep = 2;
            type = 2;

            $("#email-form").show();
            $("#phone-form").hide();
            $("#phone-verify-code").hide();
            $step2.fadeIn(500);
        });

        $(".prev-step").click(function () {
            currentStep--;
            if (currentStep === 1) {
                $step1.fadeIn(500);
                $step2.hide();
                $step3.hide();
            }
            if (currentStep === 2) {
                $step1.hide();
                $step2.fadeIn(500);
                $step3.hide();
            }
        });

        $(".next-step").click(function () {
            currentStep++;
            if (currentStep === 2) {
                $step1.hide();
                $step2.fadeIn(500);
                $step3.hide();
            }
            if (currentStep === 3) {
                if (type === 2) {
                    // todo 发送重置密码的邮件给指定的邮箱
                    alert("重置密码的链接已发送至您的邮箱\n请前往邮箱查看");
                    $step1.fadeIn(500);
                    $step2.hide();
                    $step3.hide();
                } else {
                    $step1.hide();
                    $step2.hide();
                    $step3.fadeIn(500);
                }
            }
            if (currentStep > 3) {
                currentStep = 3;
                // todo 调用接口重置密码
                console.log("重置密码");
            }
        });

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
