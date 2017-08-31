@extends('layout.master')
@section('title', '新闻中心')

@section('custom-style')
    <style>
        body {
            background-color: var(--snow);
        }

        .news-body{
            width: 100%;
            min-height: 0;
            padding: 24px 0;
            margin: 0 !important;
            border-bottom: 1px solid var(--divider-light);
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .news-body:hover{
            cursor: pointer;
            background-color: var(--divider-light);
        }

        .news-body:first-child{
            padding-top: 0;
        }

        .news-body:last-child{
            padding-bottom: 0;
        }

        .news-aside {
            display: inline-block;
            width: 180px;
            margin-right: 24px;
            float: left;
        }

        .news-aside img{
             width: 100%;
         }

        .news-content {
            display: inline-block;
            width: 424px;
            padding: 8px 16px 8px 0;
        }

        .news-content h6{
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

        .mdl-card__title {
            padding: 0 16px 16px 0;
        }

        .mdl-card__title h5 {
            border-left: 5px solid var(--blue-sky);
            padding-left: 16px;
            font-size: 20px;
        }

        .load-more {
            padding:12px 0;
            text-align: center;
            cursor: pointer;
            color: var(--text-color-secondary);
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .load-more:hover{
            color: var(--text-color-primary);
            background-color: var(--divider-light);
        }
    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => true])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 4])
@endsection

@section('content')

    <div class="info-panel">
        <div class="container">
            <div class="info-panel--left info-panel">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">最新</h5>
                </div>

                <div class="mdl-card info-card">
                    @foreach([1, 2, 3, 4, 5, 6, 7, 8, 9] as $news)
                        <div class="news-body">
                            <div class="news-aside">
                                <img src="{{asset('images/lamian.jpg')}}"/>
                            </div>

                            <div class="news-content">
                                <h6>兰州拉面进军日本，和风设计唤醒舌尖上的味蕾</h6>
                                <div class="content-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.Mauris sagittis
                                    pellentesque
                                    lacus eleifend lacinia...
                                </div>
                                <small class="content-appendix">
                                    <span>作者: author_ly</span><span>发布时间: 2017-7-17 15:48:55</span>
                                </small>
                            </div>
                        </div>
                    @endforeach

                    <div class="load-more">
                        加载更多
                    </div>
                </div>

            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">

                @include('components.hotNewsList', ['array'=>[1,2,3,4,5,6,7]])

            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        $(".news-body").click(function () {
            self.location = "/news/detail"
        })
    </script>
@endsection
