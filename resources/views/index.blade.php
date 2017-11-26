@extends('layout.master')
@section('title', '电竞猎人|首页')

@section('custom-style')
    <style>
        body {
            background-color: #ffffff;
        }

        .header-post {
            min-width: 1025px;
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
            text-decoration: underline;
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

        .image_ad img{
            border-radius: 5px;
        }
        .image_ad {
            width: 195px;
            display: block;
            position: relative;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
        }

        .word_ad {
            width: 180px;
        }


        .image_ad > .ad_info {
            position: absolute;
            bottom: 0;
            z-index: 99;
            width: 193px;
            background-color: rgba(0, 0, 0, .4);
            display: none;
            cursor: pointer;
        }
        .small_image > .ad_info h6{
            font-size: 12px;
            padding: 2px!important;
        }    
        .small_image > .ad_info {
            width: 113px;
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

        .small_image {
            display: inline-block;
            width: 115px;
            margin: 5px;
        }

        .word_ad_item {
            background: #f5f5f5;
            border-radius: 20px;
        }

        .word_ad_item:hover {
            cursor: pointer;
            border-radius: 20px;
            background: rgba(0, 0, 0, .15);
        }

        .ad_info > h5,
        .ad_info > h6 {
            margin: 0;
            font-size: 14px;
            font-weight: normal;
            padding: 8px;
        }

        .word_ad_item, .hot-position_ad {
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

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
            width: 240px;
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

        .news-panel ul {
            padding-left: 0;
        }

        .news-panel ul li {
            display: block;
            list-style: none;
            margin: 8px 0;
            padding-bottom: 5px;
            border-bottom: 1px dashed #f5f5f5;
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

                    <div style="display: inline-block; float: right;margin-right: 10px ">

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
        <div class="container" style="margin-bottom: -2.5rem;">

            <div class="">
            <div class="info-panel--left info-panel">
                <div class="" style="margin-top: 20px;">
                    <ul>
                        @if(count($data['ad']['ad0']) === 0)
                            <p>暂无大图推荐</p>
                        @else
                            @foreach($data['ad']['ad0'] as $ad0)
                                <li>
                                    <div class="image_ad">
                                        <a>
                                            <img src="{{$ad0->picture or asset('images/welcome_card.jpg')}}"
                                                 width="193" height="100">
                                        </a>

                                        {{--<div class="ad_info" to="http://{{$data['ad']['ad0'][$i]->homepage or '#'}}">--}}
                                        <div class="ad_info" to="/company?eid={{$ad0->eid}}">
                                            <h5>{{$ad0->title}}</h5>
                                            <p>{{$ad0->content}}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel" style="padding-left: 16px;">
                <div class="tuwen">
                    <h3>最新资讯<a href="news/"><span class="pull-right look-all">查看全部>></span></a></h3>
                    <?php
                    $index = 0;
                    $count = 5;
                    ?>
                    <ul>
                        @foreach($data['news']['news'] as $newsItem)
                            @if($index++ < $count)
                                @if($newsItem->picture != null)
                                    <?php
                                    $pics = explode(';', $newsItem->picture);
                                    $baseurl = explode('@', $pics[0])[0];
                                    $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                                    $imagepath = explode('@', $pics[0])[1];
                                    ?>
                                @endif
                        <li>
                            <a href="news/detail?nid={{$newsItem->nid}}">
                                <img src="{{$baseurl}}{{$imagepath}}">
                                {{--<b>{{mb_substr($newsItem->title, 0, 40)}}</b>--}}
                                <b>{{$newsItem->title}}</b>
                            </a>
                            {{--<p>--}}
                                {{--<span class="tulanmu">--}}
                                  {{--<a href="news/detail?nid={{$newsItem->nid}}" target="_blank">奥委会宣布电子竞技为正式体育项目，最</a>--}}
                                {{--</span>--}}
                            {{--</p>--}}
                        </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section>
        <div class="container">
            <ul>
                @foreach($data['ad']['ad00'] as $ad00)
                    <li>
                        <div class="image_ad">
                            <a>
                                <img src="{{$ad00->picture or asset('images/welcome_card.jpg')}}"
                                     width="193" height="100">
                            </a>

                            {{--<div class="ad_info" to="http://{{$data['ad']['ad0'][$i]->homepage or '#'}}">--}}
                            <div class="ad_info" to="/company?eid={{$ad00->eid}}">
                                <h5>{{$ad00->title}}</h5>
                                <p>{{$ad00->content}}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <div style="margin: 10px 0 40px 0; border-bottom: 1px solid #ebebeb;"></div>

    <section>
        <div class="container">
            @if(count($data['ad']['ad1']) === 0)
                <p>暂无小图推荐</p>
            @else
                @foreach($data['ad']['ad1'] as $ad1)
                    <div class="image_ad small_image">
                        <a>
                            <img src="{{$ad1->picture or asset('images/house.jpg')}}"
                                 width="113" height="50">
                        </a>
                        {{--<div class="ad_info" to="http://{{$data['ad']['ad1'][$i]->homepage or '#'}}">--}}

                        {{--//暂时关闭滑动显示小图广告标题功能--}}
                        <div class="ad_info" to="/company?eid={{$ad1->eid}}">
                            {{--<h6>{{$ad1->title}}</h6>--}}
                            <h6>查看公司职位</h6>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <div style="margin: 40px 0; border-bottom: 1px solid #ebebeb;"></div>

    <section>
        <div class="container">

            @if(count($data['ad']['ad2']) === 0)
                {{--<p>暂无公司推荐</p>--}}
            @else
                @foreach($data['ad']['ad2'] as $ad2)
                    <div class="small_image word_ad_item" to="/company?eid={{$ad2->eid}}">
                        <div class="word_ad">
                            <div class="ad_info">
                                <h6>{{$ad2->title}}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
                            <li class="hot-recruitment-li">
                                <div class="hot-position_ad"
                                     to="/position/detail?pid={{$data['position']['position'][$i]->pid}}">
                                    <div class="ad_info">
                                        <p>
                                            <b>急聘: </b>
                                            <a><b>{{mb_substr($data['position']['position'][$i]->title, 0, 12, 'utf-8')}}</b></a>
                                        </p>
                                        <h6>
                                            @if(empty($data['position']['position'][$i]->byname))
                                                {{mb_substr($data['position']['position'][$i]->ename, 0, 14, 'utf-8')}}
                                            @else
                                                {{mb_substr($data['position']['position'][$i]->byname, 0, 14, 'utf-8')}}
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
