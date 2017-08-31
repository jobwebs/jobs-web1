@extends('layout.master')
@section('title', '消息中心')

@section('custom-style')
    <style>
        .message-panel {
            min-height: 500px;
            padding: 0;
        }

        .message-list {
            width: 100%;
        }

        .message-list p,
        .message-list a {
            color: var(--text-color-primary);
        }

        .message-list ul {
            display: block;
            float: none;
        }

        .message-list ul li {
            display: block;
            position: relative;
            overflow: hidden;
            zoom: 1;
            padding: 15px 10px 14px;
            border-bottom: 1px solid var(--divider-light);
            margin: 0;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .message-list .pic {
            float: left;
            margin: 0 16px 0 0;
            position: relative;
        }

        .pic img {
            width: 36px;
            height: 36px;
        }

        .message-list .title {
            zoom: 1;
            word-wrap: break-word;
            line-height: 1.5;
            cursor: pointer;
        }

        .message-list .title .sender {
            margin: -2px 0 2px;
            color: var(--text-color-secondary);
            font-size: 13px;
        }

        .sender .time {
            float: right;
            color: #999;
        }

        .message-list p {
            margin: 0;
            width: 80%;
            min-height: 14px;
            line-height: 1.4;
            display: block;
            color: var(--text-color-primary);
            font-weight: 400;
            font-size: 13px;
        }

        .message-list .select {
            position: absolute;
            width: 12px;
            top: 37px;
            right: 10px;

        }

        .select input {
            position: relative;
            left: 0 !important;
            opacity: 1 !important;
        }

        .message-list li:hover {
            background-color: var(--divider-light);
        }

        .message-list li:hover .operations a {
            display: inline-block;
        }

        .message-list .operations {
            position: absolute;
            top: 34px;
            right: 32px;
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

        /*已选择*/
        .message-list li.checked {
            background-color: var(--divider);
        }

        /*已读*/
        .read .title p {
            color: var(--text-color-secondary);
        }

        .mdl-card__menu input[type='checkbox'] {
            left: 0 !important;
            opacity: 1 !important;
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
                <h6>收到的消息</h6>

                <div class="mdl-card mdl-shadow--2dp info-card">

                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">&nbsp;</h5>
                    </div>

                    <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="filter-message">
                            <i class="material-icons">storage</i>
                        </button>

                        <button class="mdl-button mdl-button--icon mdl-js-button" id="delete-all--selected_message">
                            <i class="material-icons">delete_sweep</i>
                        </button>

                        <button class="mdl-button mdl-button--icon mdl-js-button" id="select-all--message">
                            <i class="material-icons">done_all</i>
                        </button>



                        <div class="mdl-tooltip" data-mdl-for="delete-all--selected_message">
                            删除选择的消息
                        </div>

                        <div class="mdl-tooltip" data-mdl-for="filter-message">
                            筛选
                        </div>

                        <div class="mdl-tooltip" data-mdl-for="select-all--message">
                            选择所有
                        </div>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="filter-message">
                            <li class="mdl-menu__item"><a href="#">全部消息</a></li>
                            <li class="mdl-menu__item"><a href="#">未读消息</a></li>
                            <li class="mdl-menu__item"><a href="#">已读消息</a></li>
                        </ul>
                    </div>

                    <div class="mdl-card__actions mdl-card--border message-panel">
                        <div class="message-list">
                            <ul>
                                @foreach([1,2,3] as $item)
                                    <li class="">
                                        <div class="pic">
                                            <a href="">
                                                <img src="{{asset('images/avatar.png')}}">
                                            </a>
                                        </div>

                                        <div class="title">
                                            <div class="sender">
                                                <span class="time">2017-08-10</span>
                                                <span class="from">发送者姓名</span>
                                            </div>
                                            <p>
                                                消息通知内容。Lorem ipsum ....
                                            </p>
                                        </div>

                                        <div class="select">
                                            <input type="checkbox" id="md_checkbox_9" class="chk-col-teal"/>
                                        </div>

                                        <div class="operations">
                                            <a>删除</a>
                                        </div>
                                    </li>
                                @endforeach

                                {{--已读消息--}}
                                <li class="read">
                                    <div class="pic">
                                        <a href="">
                                            <img src="{{asset('images/avatar.png')}}">
                                        </a>
                                    </div>

                                    <div class="title">
                                        <div class="sender">
                                            <span class="time">2017-08-10</span>
                                            <span class="from">发送者姓名</span>
                                        </div>
                                        <p>
                                            消息通知内容。Lorem ipsum ....
                                        </p>
                                    </div>

                                    <div class="select">
                                        <input type="checkbox" id="md_checkbox_9" class="chk-col-teal"/>
                                    </div>

                                    <div class="operations">
                                        <a>删除</a>
                                    </div>
                                </li>

                                <div class="apply-empty">
                                    <img src="{{asset('images/message-empty.png')}}" width="50px">
                                    <span>&nbsp;&nbsp;没有消息</span>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">
            </div>
        </div>
    </div>
@endsection

@section('custom-script')

    <script type="text/javascript">
        $checkedAll = false;

        $(".message-list").find("input[type='checkbox']").click(function () {
            $item = $(this.parentNode.parentNode);
            if ($item.hasClass('checked')) {
                $item.removeClass('checked');
            } else {
                $item.addClass('checked');
            }
        });

        $(".message-list").find(".title").click(function () {
            self.location="/message/detail";
        });

        $("#select-all--message").click(function () {
            $items = $(".message-list").find("li");
            if ($checkedAll) {
                $checkedAll = false;
                $items.removeClass("checked");
                $(".message-list").find("input[type='checkbox']").prop("checked", false);
                $("#select-all--message").find("i").html("done_all");
                $("div[data-mdl-for='select-all--message']").html("选择所有");
            } else {
                $checkedAll = true;
                $items.addClass("checked");
                $(".message-list").find("input[type='checkbox']").prop("checked", true);
                $("#select-all--message").find("i").html("clear");
                $("div[data-mdl-for='select-all--message']").html("取消所有");
            }
        })
    </script>
@endsection
