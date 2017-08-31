@extends('layout.master')
@section('title', '消息详情')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

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
            margin:24px 0 16px 0;
        }

        .response-card {
            padding: 12px;
            min-height: 0;
        }

        #btn-response {
            margin-top: 12px;
            float: right;
        }
    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => true])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">
            <div class="info-panel--left info-panel">
                <h6>与xxx的对话</h6>

                <div class="mdl-card mdl-shadow--2dp info-card">

                    <div class="mdl-card__title">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list" to="/message/">
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
                                @foreach([1,2,3] as $messageItem)
                                    <li>
                                        <div class="date">
                                            <div class="divider"></div>
                                            <span>2017-08-24</span>
                                        </div>

                                        <div class="pic">
                                            <a href="">
                                                <img src="{{asset('images/avatar.png')}}">
                                            </a>
                                        </div>

                                        <div class="title">

                                            <div class="sender">
                                                <span class="time">10:29</span>
                                                <span class="from">发送者姓名</span>
                                            </div>
                                            <p>
                                                消息通知内容。Lorem ipsum Nam quam nunc, blandit vel, luctus pulvinar,
                                                hendrerit id,
                                                lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut
                                                libero
                                                venenatis faucibus. Nullam quis ante. Etiam sit
                                            </p>
                                        </div>

                                        <div class="operations">
                                            <a>删除</a>
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

                <h6 class="message-response--title">回应xxx的消息</h6>

                <div class="mdl-card info-card response-card">
                    <div class="form-group">
                        <div class="form-line">
                                <textarea rows="2" class="form-control" name="response"
                                          id="additional-content"
                                          placeholder="写点什么..."></textarea>
                        </div>

                        <button id="btn-response"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            回应
                        </button>
                    </div>
                </div>
            </div>
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
