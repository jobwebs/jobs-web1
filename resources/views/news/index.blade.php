@extends('layout.master')
@section('title', '新闻中心')

@section('custom-style')
    <style>
        body {
            background-color: #ffffff;
        }

        .news-body {
            width: 100%;
            min-height: 0;
            padding: 24px 0;
            margin: 0 !important;
            border-bottom: 1px solid #f5f5f5;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .news-body:hover {
            cursor: pointer;
            background-color: #f5f5f5;
        }

        .news-aside {
            display: inline-block;
            width: 180px;
            margin-right: 24px;
            float: left;
            vertical-align: middle;
            position: relative;
            top: 0;
            bottom: 12px;
        }

        .news-aside img {
            width: 100%;
            max-height: 100px;
        }

        .hot-news-aside img {
            width: 100%;
            max-height: 70px;
        }

        .news-content {
            display: inline-block;
            width: 380px;
            padding: 8px 16px 8px 0;
            position: relative;
            top: -10px;
        }

        .news-content h6 {
            font-size: 18px;
            font-weight: 500;
            margin: 0 0 8px 0;
        }

        .hot-news-content .content-body,
        .news-content .content-body {
            font-size: 14px;
            font-weight: 300;
            color: #737373;
        }

        .news-content .content-appendix,
        .hot-news-content .content-appendix {
            font-size: 12px;
            font-weight: 300;
            color: #aaaaaa;
        }

        .news-content .content-appendix span {
            margin-right: 8px;
        }

        .mdl-card__title {
            padding: 0 16px 16px 0;
        }

        .mdl-card__title h5 {
            border-left: 5px solid #03A9F4;
            padding-left: 16px;
            font-size: 20px;
        }

        .load-more {
            padding: 12px 0;
            text-align: center;
            cursor: pointer;
            color: #737373;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .load-more:hover {
            color: #232323;
            background-color: #f5f5f5;
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
    @include('components.headerTab', ['activeIndex' => 4,'type' =>$data['type']])
@endsection

@section('content')

    <div class="info-panel">
        <div class="container">
            <div class="info-panel--left info-panel">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">最新</h5>
                </div>

                <div class="mdl-card info-card">


                    @foreach($data['newest'] as $news)

                        <div class="news-body" data-content="{{$news->nid}}">
                            @if($news->picture != null)
                                <?php
                                $pics = explode(';', $news->picture);
                                $baseurl = explode('@', $pics[0])[0];
                                $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                                $imagepath = explode('@', $pics[0])[1];
                                ?>
                                <div class="news-aside">
                                    {{--<img src="{{$news->picture or asset('images/lamian.jpg')}}"/>--}}
                                    <img src="{{$baseurl}}{{$imagepath}}"/>
                                </div>
                            @endif

                            <div class="news-content">
                                <h6><b>{{mb_substr($news->title, 0, 30)}}</b></h6>
                                <div class="content-body">
                                    {{str_replace("<br>","",mb_substr($news->content, 0, 40))}}
                                </div>
                                <small class="content-appendix">
                                    <span>责任编辑: admin</span><span>新闻来源:{{$news->quote}}</span><span>发布时间: {{mb_substr($news->created_at,0,10,'utf-8')}}</span>
                                </small>
                            </div>
                        </div>
                    @endforeach

                    {{--分页--}}

                    <nav>
                        {!! $data['newest']->render() !!}
                    </nav>
                </div>

            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">最热</h5>
                </div>

                <div class="mdl-card info-card">
                    @foreach($data['hottest'] as $news)
                        <div class="hot-news-body" data-content="{{$news->nid}}">

                            @if($news->picture != null)
                                <?php
                                $pics = explode(';', $news->picture);
                                $baseurl = explode('@', $pics[0])[0];
                                $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                                $imagepath = explode('@', $pics[0])[1];
                                ?>
                                <div class="hot-news-aside">
                                    {{--<img src="{{$news->picture or asset('images/lamian.jpg')}}"/>--}}
                                    <img src="{{$baseurl}}{{$imagepath}}"/>
                                </div>
                            @endif

                            <div class="hot-news-content">
                                <h6><b>{{mb_substr($news->title, 0, 8)}}</b></h6>
                                <div class="content-body">
                                    {{str_replace("<br>","",mb_substr($news->content, 0, 35))}}
                                </div>
                                <small class="content-appendix">
                                    <span>发布时间: {{mb_substr($news->created_at,0,10,'utf-8')}}</span>
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        $(".news-body").click(function () {
            self.location = "/news/detail?nid=" + $(this).attr('data-content');
        });

        $(".hot-news-body").click(function () {
            self.location = "/news/detail?nid=" + $(this).attr('data-content');
        })
    </script>
@endsection
