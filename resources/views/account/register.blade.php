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
            height: 400px;
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

        #phone-verify-code .form-line a {
            position: absolute;
            right: 0;
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
                        <form action="#" class="register-form">

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="phone" name="phone" class="form-control"
                                           placeholder="手机号...">
                                </div>
                                <label class="error" for="phone"></label>
                            </div>

                            <div class="form-group" id="phone-verify-code">
                                <div class="form-line">
                                    <input type="text" id="register-verify-code" name="verify-code" class="form-control"
                                           placeholder="验证码...">
                                    <a class="mdl-button mdl-js-button mdl-button-default button-border">发送验证码</a>
                                </div>
                                <label class="error" for="register-verify-code"></label>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" name="password" class="form-control"
                                           placeholder="密码...">
                                </div>
                                <label class="error" for="password"></label>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" name="password" class="form-control"
                                           placeholder="确认密码...">
                                </div>
                                <label class="error" for="password"></label>
                            </div>

                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                立即注册
                            </button>
                        </form>
                    </td>
                    <td>
                        <div id="right-panel">
                            <p>你还可以使用邮箱来注册 esporthr <a href="#">使用邮箱注册</a></p>
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

    <script type="text/javascript">

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

    </script>
@endsection
