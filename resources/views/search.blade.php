@extends('layout.master')
@section('title', 'ehunter首页')

@section('custom-style')
    <style>
        body {
            background-color: var(--snow);
        }

        .header-post {
            width: 100%;
            height: 120px;
            background-color: var(--primary-color);
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
            color: var(--tomato);
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
            background-color: var(--tomato-dark);
        }

        .button-accent .mdl-ripple {
            background: rgb(255, 255, 255);
        }

        .content {
            min-height: 800px;
        }

        .publish-item {
            border-top: 1px solid var(--divider-light);
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
            color: var(--text-color-primary);
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
            color: var(--text-color-light);
            margin-right: 6px;
        }

        .news-body {
            width: 100%;
            min-height: 120px;
            padding: 24px 0;
            margin: 0 !important;
            border-top: 1px solid var(--divider-light);
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .news-aside {
            display: inline-block;
            width: 180px;
            margin-left: 24px;
            float: right;
        }

        .news-aside img {
            width: 100%;
        }

        .news-content {
            display: inline-block;
            width: 420px;
            padding: 16px 0 16px 16px;
        }

        .news-content h6 {
            font-size: 18px;
            font-weight: 500;
            margin: 0 0 8px 0;
        }

        .news-content .content-body {
            font-size: 14px;
            font-weight: 300;
            color: var(--text-color-secondary);
        }

        .news-content .content-appendix {
            font-size: 12px;
            font-weight: 300;
            color: var(--text-color-light);
        }

        .news-content .content-appendix span {
            margin-right: 8px;
        }

        .divider-light--line {
            width: 100%;
            height: 1px;
            background-color: var(--divider-light);
        }
    </style>
@endsection

@section('custom-script')
    <script type="text/javascript">

    </script>
@endsection

@section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection

@section('content')
    <div class="header-post">
        <div class="container">

            <div class="search-box">
                <form action="/index/search">

                    <input type="text" name="keyword" value="{{$searchResult['keyword'] or ''}}" placeholder="输入搜索内容"/>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised
                        mdl-js-ripple-effect button-accent">立即搜索
                    </button>
                </form>
                <div class="search-box-appendix">
                    <span>热门分类: </span>
                    <a href="#">电竞培训</a>
                    <a href="#">电竞传媒</a>
                    <a href="#">电竞俱乐部</a>
                    <a href="#">使用高级搜索</a>
                </div>
            </div>

        </div>
    </div>



    <section class="main">

        <div class="container">
            <div class="title">
                <h4>搜索结果
                    <small>共计 {{count($searchResult['position']) + count($searchResult['news'])}} 个</small>
                </h4>
            </div>

            <div class="content">

                <div class="info-panel--left info-panel">

                    @forelse($searchResult['position'] as $position)
                        <div class="publish-item">
                            <div class="position-info">
                                <h5><a href="/position/detail?pid={{$position->pid}}">{{$position->title}}</a></h5><br>
                                <p>{{$position->describe}}</p><br>
                                <span>{{$position->created_at}} 发布</span>
                                <span>{{$position->vaildity}} 过期</span>
                            </div>
                        </div>
                    @empty
                        <p>未搜索到与"{{$searchResult['keyword']}}"相关的职位</p>
                    @endforelse


                    @forelse($searchResult['news'] as $news)

                        <div class="news-body">
                            <div class="news-aside">
                                <img src="{{asset('images/lamian.jpg')}}"/>
                            </div>

                            <div class="news-content">
                                <h6>
                                    <a href="/news/detail?nid={{$news->nid}}">
                                        [{{$news->quote}}] {{$news->title}}
                                        <small>&nbsp;&nbsp;{{$news->subtitle}}</small>
                                    </a>
                                </h6>
                                <div class="content-body">
                                    {{$news->content}}
                                </div>
                                <small class="content-appendix">
                                    <span>作者: author_ly</span><span>发布时间: {{$news->created_at}}</span>
                                </small>
                            </div>
                        </div>
                    @empty
                        <p>未搜索到与"{{$searchResult['keyword']}}"相关的新闻资讯</p>
                    @endforelse

                    <div class="divider-light--line" style="clear: both;"></div>
                </div>

                <div class="gap"></div>

                <div class="info-panel--right  info-panel">
                    {{--ad--}}
                </div>

            </div>
        </div>

    </section>
@endsection
