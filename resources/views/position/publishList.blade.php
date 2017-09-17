@extends('layout.master')
@section('title', '已发布职位')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

    <style>
        .publish-panel {
            min-height: 500px;
            padding: 0;
        }

        .publish-item {
            border-bottom: 1px solid var(--divider);
            cursor: pointer;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .position-info {
            padding: 16px 0 16px 16px;
            display: inline-block;
            width: 500px;
        }

        .position-info > h5 {
            margin: 0 0 8px 0;

            display: inline-block;

        }

        .position-info > p {
            margin: 0;
            display: inline-block;
            font-size: 12px;
            font-weight: 300;
        }

        .position-info > span {
            font-size: 12px;
            color: var(--text-color-light);
            margin-right: 6px;
        }

        .position-data {
            display: inline-block;
            width: 70px;
            height: 86px;
            margin-left: 40px;
            vertical-align: top;
            font-weight: 300;
            font-size: 13px;
            text-align: left;
            padding: 12px 6px;
            color: var(--snow);
            background-image: url({{asset('images/tag-bg.png')}});
        }

        .position-data span small {
            font-size: 14px;
            font-weight: 500;
        }

        .publish-item:hover {
            background-color: var(--divider);
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
    @include('components.headerTab', ['activeIndex' => 2])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">
            <div class="info-panel--left info-panel">
                <div class="mdl-card mdl-shadow--2dp info-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">已发布的职位</h5>
                    </div>

                    <div class="mdl-card__menu">

                        <button class="mdl-button mdl-button--icon mdl-js-button" id="publish-position">
                            <i class="material-icons">add</i>
                        </button>

                        <button class="mdl-button mdl-button--icon mdl-js-button" id="sort-position">
                            <i class="material-icons">sort</i>
                        </button>

                        <div class="mdl-tooltip" data-mdl-for="publish-position">
                            发布新职位
                        </div>

                        <div class="mdl-tooltip" data-mdl-for="sort-position">
                            选择排序方法
                        </div>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="sort-position">
                            <li class="mdl-menu__item"><a href="#">发布时间</a></li>
                            <li class="mdl-menu__item"><a href="#">浏览次数</a></li>
                            <li class="mdl-menu__item"><a href="#">申请次数</a></li>
                        </ul>
                    </div>

                    <div class="mdl-card__actions mdl-card--border publish-panel">
                        @foreach([1, 2, 3, 4] as $id)
                            <div class="publish-item">
                                <div class="position-info">
                                    <h5><?= "#" . $id ?>市场专员</h5><br>
                                    <p>职位信息的描述写在这里。职位信息的描述可能有一行也有可能有两行，感觉显示最多显示两行比较合适</p>
                                    <span>2017-06-20 发布</span>
                                    <span>还剩25天失效</span>
                                </div>

                                <div class="position-data">
                                    <span>浏览&nbsp;&nbsp;<small>99+</small></span><br>
                                    <span>申请&nbsp;&nbsp;<small>12</small></span>
                                </div>
                            </div>
                        @endforeach

                        <div class="position-empty">
                            <img src="{{asset('images/desk.png')}}" width="40px">
                            <span>&nbsp;&nbsp;没有发布职位</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">
                <div class="form-group mdl-card mdl-shadow--2dp search-position">
                    <div class="form-line">
                        <input type="text" id="skill-name" name="skill-name" class="form-control"
                               placeholder="输入职位名称／描述进行搜索">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="publish-position">
                            <i class="material-icons">search</i>
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
//        $(".form-control").focus(function () {
//            $(this.parentNode).addClass("focused");
//        }).blur(function () {
//            $(this.parentNode).removeClass("focused");
//        });

        $("#publish-position").click(function () {
            self.location = "/position/publish";
        })
    </script>
@endsection
