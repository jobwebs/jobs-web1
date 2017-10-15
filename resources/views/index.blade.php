@extends('layout.master')
@section('title', 'esporthr首页')

@section('custom-style')
    <style>
        body {
            background-color: #ffffff;
        }

        .header-post {
            width: 100%;
            height: 120px;
            background-color: #333333;
        }

        .search-box {
            padding-top: 25px;
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
            padding-top: 15px;
        }

        .search-box-appendix span,
        .search-box-appendix a {
            margin-left: 6px;
            font-size: 10pt;
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

        .title h4 {
            font-weight: 300;
            margin-top: 0;
        }

        .title h4 > a {
            text-decoration-line: none;
        }

        .title h4 > a > small {
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

        .image_ad {
            width: 180px;
            display: block;
            position: relative;
        }

        .word_ad {
            width: 180px;
        }

        .image_ad > .ad_info {
            position: absolute;
            bottom: 0;
            z-index: 99;
            width: 180px;
            background-color: rgba(0, 0, 0, .4);
            display: none;
            cursor: pointer;
        }

        .image_ad > .ad_info > h5 {
            color: #fff;
            padding: 8px 8px 0 8px;
        }

        .image_ad > .ad_info > h6 {
            color: #ffffff;
            padding: 4px 8px;
        }

        .image_ad > .ad_info > p {
            color: #fff;
            padding: 0 8px 4px 8px;
        }

        .ad_info > h5,
        .ad_info > h6 {
            margin: 0;
            font-size: 14px;
            font-weight: normal;
            padding: 8px;
        }

        .word_ad, .hot-position_ad {
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .word_ad:hover,
        .hot-position_ad:hover {
            cursor: pointer;
            border-radius: 2px;
            background: #f5f5f5;
        }

        .word_ad > .ad_info h6,
        .hot-position_ad > .ad_info h6 a {
            color: #373737;
            margin-left: 8px;
            font-size: 12px;
        }

        .word_ad > .ad_info p a:hover,
        .news-panel ul li a:hover {
            color: #F44336;
        }

        .ad_info > p {
            font-weight: 300;
            margin-bottom: 0;
            padding: 0 8px 8px 8px;
        }

        .none_margin {
            margin: 0 !important;
        }

        .hot-position_ad {
            padding: 4px;
            width: 248px;
        }

        .position-card.mdl-card {
            display: inline-block;
            width: 32%;
            height: 120px !important;
            margin: 0 5px;
            font-weight: 300;

        }

        .position-card > .mdl-card__title {
            font-size: 20px;
            padding-bottom: 0;
        }

        .position-card > .mdl-card__supporting-text {
            padding-top: 8px;
            height: 72px;
        }

        .hot-position {
            padding-top: 45px;
        }

        .news-panel {
            padding-bottom: 40px;
        }

        .news-panel ul {
            padding-left: 0;
        }

        .news-panel ul li {
            display: block;
            list-style: none;
            margin: 8px 0;
        }

        .news-panel ul li a {
            font-weight: 300;
            text-decoration: none;
            color: #000;
        }

        .news-panel ul li a small {
            margin-left: 16px;
            font-weight: 300;
            color: rgba(0, 0, 0, .4);
        }

        .title {
            border-bottom: 1px solid #ebebeb;
        }

        .ad_info p {
            padding-top: 8px !important;
        }

        .ad_info p,
        .ad_info p a {
            color: #232323;
            padding-bottom: 0;
        }


    </style>
@endsection

@section('custom-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".image_ad").mouseenter(function () {
                $(this).find(".ad_info").show(300);
            }).mouseleave(function () {
                $(this).find(".ad_info").hide(300);
            });
        });
    </script>
@endsection

@section('header-nav')
    @if($data['uid'] == 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 1,'type' => $data['type']])
@endsection

@section('content')
    <div class="header-post">
        <div class="container">
            <div class="search-box">
                <form action="/index/search">

                    <input type="text" name="keyword" placeholder="输入搜索内容"/>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised
                        mdl-js-ripple-effect button-accent">立即搜索
                    </button>

                    <div style="display: inline-block; float: right;">

                        @if($data['uid'] == 0)
                            <a class="mdl-button mdl-js-button mdl-button--raised
                        mdl-js-ripple-effect button-blue-sky" style="margin-right: 8px;" to="/position/advanceSearch">找工作</a>
                            <a class="mdl-button mdl-js-button mdl-button--raised
                        mdl-js-ripple-effect button-blue-sky" to="/account/register">发职位</a>
                        @elseif($data['type'] == 1)
                            <a class="mdl-button mdl-js-button mdl-button--raised
                        mdl-js-ripple-effect button-blue-sky" style="margin-right: 8px;" to="/position/advanceSearch">找工作</a>
                        @elseif($data['type'] == 2)
                            <a class="mdl-button mdl-js-button mdl-button--raised
                        mdl-js-ripple-effect button-blue-sky" to="/account/">发职位</a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="search-box-appendix">
                <span>热门分类: </span>
                @foreach($data['industry'] as $industry)
                    <a href="/position/advanceSearch?industry={{$industry->id}}">{{$industry->name}}</a>
                @endforeach
                <a href="/position/advanceSearch">使用高级搜索</a>
            </div>

        </div>
    </div>

    <section class="main">
        <div class="container">
            <div class="info-panel--left info-panel">
                <div class="recommended-company" style="margin-top: 20px;">
                    <ul>
                        @if(count($data['ad']['ad0']) === 0)
                            <p>暂无大图推荐</p>
                        @else
                            @for ($i = count($data['ad']['ad0']) - 1; $i >= 0; $i--)
                                <li>
                                    <div class="image_ad">
                                        <a>
                                            <img src="{{$data['ad']['ad0'][$i]->picture or asset('images/welcome_card.jpg')}}"
                                                 width="180" height="100">
                                        </a>

                                        {{--<div class="ad_info" to="http://{{$data['ad']['ad0'][$i]->homepage or '#'}}">--}}
                                        <div class="ad_info" to="/company?eid={{$data['ad']['ad0'][$i]->eid}}">
                                            <h5>{{$data['ad']['ad0'][$i]->title}}</h5>
                                            <p>{{$data['ad']['ad0'][$i]->content}}</p>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                        @endif

                        {{--small size image ad--}}
                        <div style="margin-top: 20px;"></div>

                        @if(count($data['ad']['ad1']) === 0)
                            <p>暂无小图推荐</p>
                        @else
                            @for ($i = count($data['ad']['ad1'])-1; $i >= 0; $i--)
                                <li>
                                    <div class="image_ad">
                                        <a>
                                            <img src="{{$data['ad']['ad1'][$i]->picture or asset('images/house.jpg')}}"
                                                 width="180" height="80">
                                        </a>
                                        {{--<div class="ad_info" to="http://{{$data['ad']['ad1'][$i]->homepage or '#'}}">--}}
                                        <div class="ad_info" to="/company?eid={{$data['ad']['ad1'][$i]->eid}}">
                                            <h6>{{$data['ad']['ad1'][$i]->title}}</h6>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                        @endif
                    </ul>

                    <div style="clear:both;"></div>
                    <div style="margin: 10px 0; border-bottom: 1px solid #ebebeb;"></div>

                    <ul>
                        @if(count($data['ad']['ad2']) === 0)
                            <p>暂无公司推荐</p>
                        @else
                            @for ($i = count($data['ad']['ad2'])-1; $i >=0 ; $i--)
                                {{--<li to="http://{{$data['ad']['ad2'][$i]->homepage or '#'}}">--}}
                                <li to="/company?eid={{$data['ad']['ad2'][$i]->eid}}">
                                    <div class="word_ad">
                                        <div class="ad_info">
                                            <h6>{{$data['ad']['ad2'][$i]->title}}</h6>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                        @endif
                    </ul>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel" style="padding-left: 16px;">
                <div class="title" style="margin-top: 20px;">
                    <h4>最新资讯<a href="news/">
                            <small>查看全部</small>
                        </a></h4>
                </div>

                <div class="news-panel">

                    <?php
                    $index = 0;
                    $count = 25;
                    ?>
                    <ul>
                        @foreach($data['news']['news'] as $newsItem)
                            @if($index++ < $count)
                                <li>
                                    <a href="news/detail?nid={{$newsItem->nid}}">[{{$newsItem->quote or ''}}
                                        ] {{$newsItem->title}}</a>
                                    {{--<br>--}}
                                    {{--<small><i>{{$newsItem->created_at}}</i></small>--}}
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </section>


    <section class="main">

        <div class="hot-position">
            <div class="container">

                <div class="title">
                    <h4>热门招聘
                        <small>共计 {{count($data['position']['position'])}} 个</small>
                    </h4>
                </div>

                <ul style="padding: 30px 0;">
                    @if(count($data['position']['position']) === 0)
                        <p>暂无急聘职位</p>
                    @else
                        @for ($i = 0; $i < sizeof($data['position']['position']); $i++)
                            <li>
                                <div class="hot-position_ad"
                                     to="/position/detail?pid={{$data['position']['position'][$i]->pid}}">
                                    <div class="ad_info">
                                        <p>
                                            <b>急聘: </b>
                                            <a><b>{{$data['position']['position'][$i]->title}}</b></a>
                                        </p>
                                        <h6>
                                            @if(empty($data['position']['position'][$i]->byname))
                                                {{$data['position']['position'][$i]->ename}}
                                            @else
                                                {{$data['position']['position'][$i]->byname}}
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </li>
                        @endfor
                    @endif
                </ul>

                <div style="clear: both;"></div>
            </div>
        </div>
    </section>
@endsection
