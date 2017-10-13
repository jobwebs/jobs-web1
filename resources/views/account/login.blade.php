@extends('layout.master')
@section('title', '登录')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <style>

        .login-card-holder {
            width: 100%;
            min-height: 450px;
            background: url({{asset('images/akali_vs_baron_3.jpg')}}) no-repeat center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding: 80px 0
        }

        .login-card-holder > h3,
        .login-card-holder > p {
            min-width: 800px;
            font-weight: 300;
            text-align: center;
            /*color: #333333;*/
            color: white;
        }

        .login-card-holder > p {
            padding-bottom: 32px;
        }

        .login-card {
            width: 800px;
            height: 300px;
            margin: 0 auto;
            padding: 0 30px;
            background-color: rgba(255, 255, 255, .95);
            border: 1px solid lightgray;
        }

        .login-card > h5 {
            font-weight: 300;
            text-align: center;
            color: rgb(0, 0, 0);
        }

        .login-form {
            width: 370px;
            border-right: 1px solid #4d4d4d;
        }

        #right-panel {
            width: 365px;
            padding-left: 30px;
        }

        #right-panel a {
            color: #03A9F4;
            text-decoration: underline;
        }

        .form-group {
            width: 340px;
        }

        .form-group .form-line input {
            background-color: transparent;
        }

        a {
            cursor: pointer;
        }

        a.forget-pwd {
            color: #03A9F4;
            font-size: 12px;
            margin-left: 24px;
            text-decoration: underline;
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

@section('content')

    <div class="login-card-holder">
        <h3><?=$site_desc ?></h3>
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.--}}
        {{--Aenan convallis.</p>--}}

        <div class="login-card mdl-card mdl-shadow--2dp">

            <h5>立即登录</h5>

            <table border="0">
                <tr>
                    <td>
                        <form method="post" class="login-form" id="login-form">

                            <div class="form-group" id="phone-form">
                                <div class="form-line">
                                    <input type="text" name="phone" style="position: fixed; bottom: -9999px;"
                                           autocomplete="off">
                                    <input type="text" id="phone" name="phone" class="phone form-control"
                                           placeholder="手机号..." autocomplete="off">
                                </div>
                                <label class="error" for="phone"></label>
                            </div>

                            <div class="form-group" id="email-form">
                                <div class="form-line">
                                    <input type="text" name="email" style="position: fixed; bottom: -9999px;">
                                    <input type="text" id="email" name="email" class="email form-control"
                                           placeholder="邮箱..." autocomplete="off">
                                </div>
                                <label class="error" for="email"></label>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" name="password" class="password form-control"
                                           placeholder="密码..." autocomplete="off">
                                </div>
                                <label class="error" for="password"></label>
                            </div>

                            <button type="submit" id="login-btn"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                立即登录
                            </button>

                                <a class="forget-pwd" href="/account/findPassword">忘记密码？</a>
                        </form>
                    </td>
                    <td>
                        <div id="right-panel">
                            <p>
                                切换登录方式
                                <a for="phone-form" onclick="switchLoginType(0)">使用手机号登录</a>
                                <a for="email-form" onclick="switchLoginType(1)">使用邮箱登录</a>
                            </p>
                            <p>还没有账号？
                                <button to="/account/register"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    立即注册
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
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script type="text/javascript">

        var loginType = 0;//0:phone; 1:email

        $loginForm = $("#login-form");

        $("#email-form").hide();
        $("a[for='phone-form']").hide();

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        function switchLoginType(type) {
            if (type === 0) {
                $("a[for='phone-form']").hide();
                $("a[for='email-form']").fadeIn(500);
                $("#email-form").hide();
                $("#phone-form").fadeIn(500);
                $("#phone").val("");
                loginType = 0;
            } else if (type === 1) {
                $("a[for='phone-form']").fadeIn(500);
                $("a[for='email-form']").hide();
                $("#phone-form").hide();
                $("#email-form").fadeIn(500);
                $("#email").val("");
                loginType = 1;
            }
        }

        $loginForm.find(".email").inputmask({alias: "email"});
        $loginForm.find(".phone").inputmask('99999999999', {placeholder: '___________'});


        $("button[type='submit']").click(function (event) {
            event.preventDefault();

            var phone = $('#phone');
            var email = $('#email');
            var password = $('#password');

            if (phone.is(':visible') && phone.val() === '') {
                setError(phone, 'phone', '不能为空');
                return;
            } else {
                removeError(phone, 'phone');
            }

            if (email.is(':visible') && email.val() === '') {
                setError(email, 'email', '不能为空');
                return;
            } else {
                removeError(email, 'email')
            }

            if (password.val() === '') {
                setError(password, 'password', '不能为空');
                return;
            } else {
                removeError(password, 'password')
            }

            var formData = new FormData();
            if (loginType === 0)
                formData.append("phone", phone.val());
            if (loginType === 1)
                formData.append("email", email.val());
            formData.append("password", password.val());

            $.ajax({
                url: "/account/login",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    //console.log(data);
                    var result = JSON.parse(data);
                    checkResultWithLocation(result.status, "登录成功，正在跳转", result.msg, "/index");

                }
            });
        });
    </script>
@endsection
