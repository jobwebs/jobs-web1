@extends('layout.master')
@section('title', '重置密码')

@section('custom-style')
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
            width:370px;
            display: block;
        }

        #findPassword-verify-code {
            width:276px;
            display: inline-block;
        }

        .findPassword-card>button{
            width:88px;
        }
    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => false])
@endsection

@section('content')
    <div class="findPassword-card-holder">

        <div class="findPassword-card mdl-card mdl-shadow--2dp">
            <h5>忘记密码了？重置密码</h5>
            <small>第1步：验证手机号</small>

            <div class="findPassword-input mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?"
                       id="findPassword-input-phone">
                <label class="mdl-textfield__label" for="findPassword-input-phone">手机号...</label>
                <span class="mdl-textfield__error">请输入正确的手机号!</span>
            </div>

            <div class="findPassword-input mdl-textfield mdl-js-textfield" id="phone-verify-code">
                <input class="mdl-textfield__input" type="text" id="findPassword-verify-code">
                <button class="mdl-button mdl-js-button mdl-button-default button-border">发送验证码</button>
                <label class="mdl-textfield__label" for="findPassword-verify-code">验证码...</label>
                <span class="mdl-textfield__error">请输入格式正确的验证码!</span>
            </div>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                下一步
            </button>
        </div>

        <div class="findPassword-card mdl-card mdl-shadow--2dp">
            <h5>忘记密码了？重置密码</h5>
            <small>第2步：设置新的登录密码</small>

            <div class="findPassword-input mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="password" pattern=""
                       id="findPassword-input-password">
                <label class="mdl-textfield__label" for="findPassword-input-password">密码...</label>
                <span class="mdl-textfield__error"></span>
            </div>

            <div class="findPassword-input mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="password" pattern=""
                       id="findPassword-confirm-password">
                <label class="mdl-textfield__label" for="findPassword-confirm-password">确认密码...</label>
                <span class="mdl-textfield__error"></span>
            </div>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                确认重置
            </button>
        </div>
    </div>
@endsection
