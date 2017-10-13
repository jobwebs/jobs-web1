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
            bottom: 12px;
        }

        .news-aside img {
            width: 100%;
        }

        .news-content {
            display: inline-block;
            width: 400px;
            padding: 8px 16px 8px 0;
        }

        .news-content h6 {
            font-size: 18px;
            font-weight: 500;
            margin: 0 0 8px 0;
        }

        .news-content .content-body {
            font-size: 14px;
            font-weight: 300;
            color: #737373;
        }

        .news-content .content-appendix {
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
                            <div class="news-aside">
                                {{--<img src="{{$news->picture or asset('images/lamian.jpg')}}"/>--}}
                                <img src="{{asset('images/lamian.jpg')}}"/>
                            </div>

                            <div class="news-content">
                                <h6>[{{$news->quote}}] {{mb_substr($news->title, 0, 20)}}</h6>
                                <div class="content-body">
                                    {{mb_substr($news->content, 0, 30)}}
                                </div>
                                <small class="content-appendix">
                                    <span>作者: admin</span><span>发布时间: {{$news->created_at}}</span>
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

                @include('components.hotNewsList', ['array'=>$data['hottest']])

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
