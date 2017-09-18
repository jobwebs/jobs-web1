@extends('layout.master')
@section('title', '个人中心')

@section('custom-style')
    <style>

        .base-info--position {
            border-top: 3px solid var(--grap);
            min-height: 0;
        }

        .base-info--recommendation,
        .base-info--apply__list {
            border-top: 3px solid var(--orange);
            min-height: 0;
        }

        .base-info--apply__list > .mdl-card__menu > button > i {
            color: var(--orange);
        }

        .base-info--enterprise > .mdl-card__menu > button > i {
            color: var(--tomato);
        }

        .base-info--position > .mdl-card__menu > button > i,
        .base-info--position > .mdl-card__menu > button > span {
            color: var(--grap);
        }

        .base-info__contact li > span > a {
            text-decoration: none;
            color: var(--text-color-primary);
            font-weight: 300;
        }

        .base-info--resume {
            min-height: 250px;
            border-top: 3px solid var(--blue-sky);
        }

        .resume-item {
            display: inline-block;
            margin: 8px;
            padding: 8px;
            -webkit-transition: all 0.6s ease;
            -moz-transition: all 0.6s ease;
            -o-transition: all 0.6s ease;
            transition: all 0.6s ease;
        }

        .resume-item a {
            display: inline-block;
        }

        .resume-item p {
            margin: 4px 0 0 0;
            font-weight: 300;
            font-size: 12px;
            text-align: center;
        }

        .resume-bg {
            border-radius: 2px;
            background-color: var(--blue-sky);
            color: var(--snow);
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .recommendation-panel > ul > li {
            width: 280px;
        }

        .word_re {
            margin-left: 16px;
        }

        .re_info {
            padding: 8px;
            border-radius: 3px;

            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .re_info:hover {
            background-color: var(--divider-light);
            cursor: pointer;
        }

        .re_info > h6 {
            margin: 0;
            font-weight: 500;
            padding: 8px;
        }

        .re_info > p {
            margin: 0;
        }

        .word_re > .re_info h6,
        .word_re > .re_info p a {
            font-weight: 300;
            color: #000;
            text-decoration: none;
            font-size: 13px;
        }

        .word_re > .re_info h6 {
            padding: 8px 0 0 0;
        }

        .word_re > .re_info p a {
            color: #373737;
            margin-left: 8px;
            font-size: 12px;
        }

        .news-panel ul li a:hover {
            color: var(--tomato);
        }

        .ad_info > p {
            font-weight: 300;
            margin-bottom: 0;
            padding: 0 8px 8px 8px;
        }

        .apply-panel {
            padding: 0;
        }

        .apply-ul {
            width: 100%;
            display: block !important;
        }

        .apply-item {
            display: block !important;
            padding: 8px 16px;
            margin: 0;
            border-bottom: 1px solid var(--divider);
        }

        .applier-info {
            width: 510px;
            display: inline-block;
            vertical-align: middle;
        }

        .applier-info > p {
            margin-bottom: 0;
            font-weight: 300;
        }

        .applier-info > p > small {
            color: var(--text-color-light);
        }

        .applier-info > p > span {
            font-size: 10px;
            cursor: pointer;
        }

        .applier-info > p > span:hover {
            color: var(--tomato);
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
                @if($data["type"] == 1)
                    <div class="mdl-card mdl-shadow--2dp base-info--resume info-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">我的简历</h5>
                        </div>

                        <div class="mdl-card__actions mdl-card--border resume-panel">

                            @foreach($data['resumeList'] as $resume)
                                <div class="resume-item">
                                    <a to="/resume/add?rid={{$resume->rid}}"><img src="{{asset('images/resume.png')}}"
                                                                                  width="100px"/></a>
                                    <p>{{$resume->resume_name}}</p>
                                </div>
                            @endforeach

                            @if(count($data['resumeList']) < 3)
                                <div class="resume-item">
                                    <a id="add-resume"><img src="{{asset('images/resume_add.png')}}" width="100px"/></a>
                                    <p>添加简历</p>
                                </div>
                            @endif
                        </div>

                    </div>
                @endif

                @if($data["type"] == 1)
                    <div class="mdl-card mdl-shadow--2dp base-info--recommendation info-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">为您推荐</h5>
                        </div>

                        {{--<div class="mdl-card__menu">--}}
                        {{--<button class="mdl-button mdl-button--icon mdl-js-button">--}}
                        {{--<i class="material-icons">more</i>--}}
                        {{--</button>--}}
                        {{--</div>--}}

                        <div class="mdl-card__actions mdl-card--border recommendation-panel">
                            <ul>
                                <?php
                                $index = 0;
                                ?>

                                @foreach($data["recommendPosition"]["position"] as $position)
                                    @if(++$index < 11)
                                        <li>
                                            <div class="word_re" to="/position/detail?pid={{$position->pid}}">
                                                <div class="re_info">
                                                    <h6>{{$position->eid}}</h6>
                                                    <p>
                                                        <small><b>职位: {{$position->title}}</b></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                            @if(count($data['recommendPosition']["position"]) == 0)
                                <div class="position-empty">
                                    <img src="{{asset('images/desk.png')}}" width="40px">
                                    <span>&nbsp;&nbsp;暂无推荐职位</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if($data["type"] == 2)

                    <div class="mdl-card mdl-shadow--2dp base-info--position info-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">发布的职位</h5>
                        </div>

                        <div class="mdl-card__menu">

                            <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                                <i class="material-icons">more_vert</i>
                            </button>

                            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                for="demo-menu-lower-right">
                                <li class="mdl-menu__item" to="/position/publish">发布职位</li>
                                <li class="mdl-menu__item" to="/position/publishList">查看所有</li>
                            </ul>
                        </div>

                        <div class="mdl-card__actions mdl-card--border recommendation-panel">
                            <ul>
                                <?php
                                $index = 0;
                                ?>
                                @forelse($data["positionList"] as $position)
                                    @if(++$index < 12)
                                        <li>
                                            <div class="word_re">
                                                <div class="re_info" to="/position/detail?pid={{$position->pid}}">
                                                    <h6><b>@if($position->title == null || $position->title == "")
                                                                未命名职位 @else {{$position->title}} @endif</b></h6>
                                                    <p>
                                                        <small><b>描述：</b>
                                                            @if($position->pdescribe == null || $position->pdescribe == "")
                                                                没有职位描述
                                                            @else
                                                                {{substr($position->pdescribe, 0, 20)}}
                                                            @endif
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @empty
                                    <div class="position-empty">
                                        <img src="{{asset('images/desk.png')}}" width="40px">
                                        <span>&nbsp;&nbsp;没有发布职位</span>
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                @endif

                @if($data["type"] == 2)
                    <div class="mdl-card mdl-shadow--2dp base-info--apply__list info-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">收到的申请记录</h5>
                        </div>

                        <div class="mdl-card__menu">

                            <button class="mdl-button mdl-js-button mdl-button--icon" id="check-all"
                                    to="/position/deliverList">
                                <i class="material-icons">list</i>
                            </button>

                            <div class="mdl-tooltip" data-mdl-for="check-all">
                                查看所有
                            </div>

                        </div>

                        <div class="mdl-card__actions mdl-card--border apply-panel">
                            <ul class="apply-ul">
                                @foreach([1, 2, 3, 4] as $id)
                                    <li class="apply-item">
                                        <img class="img-circle info-head-img" src="{{asset('images/avatar.png')}}"
                                             width="45px"
                                             height="45px">

                                        <div class="applier-info">
                                            <p>Jobs</p>
                                            <p>
                                                <span>详情</span>&nbsp;&nbsp;&nbsp;
                                                <small>申请时间:2017-08-16</small>
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div style="clear:both;"></div>

                            <div class="apply-empty">
                                <img src="{{asset('images/apply-empty.png')}}" width="50px">
                                <span>&nbsp;&nbsp;没有申请记录</span>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">

                @if($data["type"] == 1)
                    @include('components.baseUserProfile', ['isShowEditBtn'=>true, 'isShowFunctionPanel' => true, "info" => $data["personInfo"][0], "messageNum" => $data["messageNum"], "deliveredNum" => $data["deliveredNum"]])
                @elseif($data["type"] == 2)
                    @include('components.baseEnterpriseProfile', ['isShowMenu'=>true, 'isShowFunctionPanel' => true, "info"=>$data["enterpriseInfo"][0], "messageNum" => $data["messageNum"], "industry" => $data["industry"]])
                @endif
            </div>

        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        $('.resume-item').mouseenter(function () {
            $(this).addClass("resume-bg");
        }).mouseleave(function () {
            $(this).removeClass("resume-bg");
        });

        $("#add-resume").click(function () {
            //todo 先判断现在有几份简历，达到限制后不能新增简历
            $.ajax({
                url: "/resume/addResume",
                type: "get",
                success: function (data) {
                    if (data['status'] === 200) {
                        self.location = "/resume/add?rid=" + data['rid'];
                    } else if (data['status'] === 400) {
                        alert(data['msg']);
                    }
                }
            });
        })
    </script>
@endsection
