@extends('layout.master')
@section('title', 'ehunter首页')

@section('custom-style')
    <style>
        body {
            background-color: #ffffff;
        }

        .search-box input {
            width: 500px;
            height: 43px;
            padding: 10px 10px;
            border: none;
            font-size: 16px;
            margin-right: 8px;
        }

        .search-box button {
            font-weight: 300;
            position: relative;
            top: -3px;
        }

        .search-box-appendix {
            padding-top: 4px;
        }

        .search-box-appendix span,
        .search-box-appendix a {
            margin-left: 6px;
            font-size: 6pt;
            font-weight: 300;
            color: #f5f5f5;
            text-decoration: none;
        }

        .search-box-appendix a:hover {
            color: #F44336;
        }

        .search-box-appendix a:last-child {
            margin-left: 20px;
            text-decoration-line: underline;
        }

        .search-box button {
            width: 100px;
            height: 45px;
        }

        .main {
            padding-top: 24px;
            /*background-color: #d1c4e9;*/
        }

        .title h4 {
            font-weight: 300;
            margin-top: 0;
        }

        .title h4 > small {
            margin-left: 16px;
            color: #4c4c4c;
            font-weight: 300;
        }

        .button-accent,
        .button-accent:hover,
        .button-accent.mdl-button--raised,
        .button-accent.mdl-button--fab {
            color: rgb(255, 255, 255);
            background-color: #D32F2F;
        }

        .button-accent .mdl-ripple {
            background: rgb(255, 255, 255);
        }

        .content {
            min-height: 800px;
        }

        .publish-item {
            border-top: 1px solid #f5f5f5;
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

        .position-info > h5 > a,
        .news-content > h6 > a {
            color: #232323;
        }

        .position-info > h5 > a:hover,
        .news-content > h6 > a:hover {
            text-decoration: underline;
        }

        .position-info > p {
            margin: 0;
            display: inline-block;
            font-size: 12px;
            font-weight: 300;
        }

        .position-info > span {
            font-size: 12px;
            color: #aaaaaa;
            margin-right: 6px;
        }

        .position-card {
            min-height: 0;
        }

    </style>
@endsection

@section('custom-script')
    <script type="text/javascript">

    </script>
@endsection

@section('header-nav')
    {{--@if($data['uid'] === 0)--}}
    {{--@include('components.headerNav', ['isLogged' => false])--}}
    {{--@else--}}
    {{--@include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])--}}
    {{--@endif--}}

    @include('components.headerNav', ['isLogged' => false])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 1,'type' => 0])
@endsection

@section('content')

    <section class="main">

        <div class="container">

            <div class="content">

                <div class="info-panel--left info-panel">

                    @foreach([1,2,3,4,5] as $item)
                        <div class="mdl-card mdl-shadow--2dp info-card position-card">
                            <div class="mdl-card__title">
                                <h5 class="mdl-card__title-text">
                                    没有填写职位名称
                                </h5>
                            </div>
                            <div class="mdl-card__supporting-text">
                                <b>介绍: </b>
                                <span>
                                没有填写职位描述
                            </span>
                            </div>

                            <div class="mdl-card__actions mdl-card--border">
                                <div class="button-panel">
                                    <button data-content=""
                                            class="position-view mdl-button mdl-js-button mdl-js-ripple-effect button-link">
                                        查看详情
                                    </button>
                                    <button data-toggle="modal" data-target="#chooseResumeModal"
                                            data-content=""
                                            class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                        投简历
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="gap"></div>
                <div class="info-panel--right  info-panel">

                    <div class="mdl-card mdl-shadow--2dp base-info--enterprise info-card">
                        <div class="base-info__header">
                            @if($info->elogo == null)
                                <img class="img-circle info-head-img" src="{{asset('images/default-img.png')}}" width="70px"
                                     height="70px">
                            @else
                                <img class="img-circle info-head-img" src="{{$info->elogo}}" width="70px"
                                     height="70px">
                            @endif

                            <div class="base-info__title">
                                <p>{{$info->ename or "公司名称未填写"}}</p>
                                <p>{{$info->byname or "公司别名未填写"}}</p>
                                <p>
                <span>
                    @if($info->industry == null)
                        行业未知
                    @else
                        @foreach($industry as $item)
                            @if($info->industry == $item->id)
                                {{$item->name}}
                            @endif
                        @endforeach
                    @endif
                </span> |
                                    <span>
                    @if($info->enature == null || $info->enature == 0)
                                            企业类型未知
                                        @elseif($info->enature == 1)
                                            国有企业
                                        @elseif($info->enature == 2)
                                            民营企业
                                        @elseif($info->enature == 3)
                                            中外合资企业
                                        @elseif($info->enature == 4)
                                            外资企业
                                        @endif
                </span> |
                                    <span>
                    @if($info->escale == null)
                                            规模未知
                                        @elseif($info->escale == 0)
                                            10人以下
                                        @elseif($info->escale == 1)
                                            10～50人
                                        @elseif($info->escale == 2)
                                            50～100人
                                        @elseif($info->escale == 3)
                                            100～500人
                                        @elseif($info->escale == 4)
                                            500～1000人
                                        @elseif($info->escale == 5)
                                            1000人以上
                                        @endif
                </span>
                                </p>
                            </div>
                        </div>


                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__title">
                                <h6 class="mdl-card__title-text">公司简介</h6>
                            </div>

                            <div class="mdl-card__supporting-text">
                                公司简介暂无
                            </div>
                        </div>

                        <ul class="mdl-list base-info__contact">
                            <li class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <i class="material-icons mdl-list__item-icon">open_in_new</i>
                                    <a>公司主页未填写</a>
                                </span>
                            </li>
                            <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon">phone</i>
                            {{$info->etel or "手机号未填写"}}
                            </span>
                            </li>
                            <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon">email</i>
                            {{$info->email or "邮箱未填写"}}
                            </span>
                            </li>
                        </ul>

                    </div>

                    <div class="button-panel left">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                    广告超链接
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
