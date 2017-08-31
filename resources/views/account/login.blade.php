@extends('layout.master')
@section('title', '登录')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

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
            /*color: var(--primary-color);*/
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
            color: var(--blue-sky);
            text-decoration: underline;
        }

        .form-group {
            width:340px;
        }

        .form-group .form-line input{
            background-color: transparent;
        }

    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => false])
@endsection

@section('content')

    <div class="login-card-holder">
        <h3><?=$site_name ?> <?=$site_desc ?></h3>
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.--}}
        {{--Aenan convallis.</p>--}}

        <div class="login-card mdl-card mdl-shadow--2dp">

            <h5>立即登录 <?=$site_name?></h5>

            <table border="0">
                <tr>
                    <td>
                        <form action="#" class="login-form">

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="手机号...">
                                </div>
                                <label class="error" for="phone"></label>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="密码...">
                                </div>
                                <label class="error" for="password"></label>
                            </div>

                            <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                立即登录
                            </button>
                        </form>
                    </td>
                    <td>
                        <div id="right-panel">
                            <p>切换登录方式 <a href="#">使用邮箱登录</a></p>
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

    <script type="text/javascript">

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

    </script>
@endsection
