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
        .bs-docs-sidebar .active a{
            color:#fff;
            background-color: #08c!important;
        }
        .bs-docs-sidebar .active{
            background-color: #08c!important;
        }
        .bs-docs-sidebar a{
            color:#08c;
            font-size: 14px;
        }
        .bs-docs-sidebar li:hover .bs-docs-sidebar li a{
            color:#fff;
        }
        .bs-docs-sidebar li:hover{
            /*background-color: #08c;*/
        }
        .bs-docs-sidebar ul{
            border: 1px solid #eee;
        }
        .bs-docs-sidebar{
            float: left;
            width: 135px;
            
            margin-left: 20px;
            position: fixed;
            bottom: 300px;
            top: 161px;
        }
        
        @media(max-width:1400px){
            .bs-docs-sidebar ul li{
                float:left;
                margin-bottom: 0;
            }
            .bs-docs-sidebar ul{
                background-color: #fff;
                padding-left: 10%;
            }
            .bs-docs-sidebar{
                width: 100%;
                z-index: 30;
                margin:0;
                position: inherit;
            }
        }
        .fixed{
            position: fixed;
            top: 0;
        }
        .hot-news-body {
            height: auto;
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
        <div class="span3 bs-docs-sidebar">
            <ul class="nav" style="width: 100%">
              <li @if(isset($data['newtype']) &&$data['newtype'] == 1)
                    class="active"
                  @endif
                  data-content="1"><a href="#typography"><i class="icon-chevron-right"></i> 综合电竞</a></li>
              <li @if(isset($data['newtype']) &&$data['newtype'] == 2)
                    class="active"
                  @endif
                  data-content="2"><a href="#code"><i class="icon-chevron-right"></i> 电竞八卦</a></li>
              <li @if(isset($data['newtype']) &&$data['newtype'] == 3)
                    class="active"
                  @endif
                  data-content="3"><a href="#tables"><i class="icon-chevron-right"></i> 赛事资讯</a></li>
              <li @if(isset($data['newtype']) &&$data['newtype'] == 4)
                    class="active"
                  @endif
                  data-content="4"><a href="#forms"><i class="icon-chevron-right"></i> 游戏快讯</a></li>
              <li @if(isset($data['newtype']) &&$data['newtype'] == 5)
                    class="active"
                  @endif
                  data-content="5"><a href="#buttons"><i class="icon-chevron-right"></i> 职场鸡汤</a></li>
            </ul>
          </div>
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
                                    {{str_replace(array("<br>","<br","<b","&nbsp","&nbs","&nb"),'',mb_substr($news->content, 0, 40))}}
                                </div>
                                <small class="content-appendix">
                                    <span>责任编辑: admin</span><span>新闻来源:{{$news->quote}}</span><span>发布时间: {{mb_substr($news->created_at,0,10,'utf-8')}}</span>
                                </small>
                            </div>
                        </div>
                    @endforeach

                    {{--分页--}}

                    <nav>
                        {!! $data['newest']->appends(['newtype' => $data['newtype']])->render() !!}
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
                                    {{str_replace(array("<br>","<br","<b","&nbsp","&nbs","&nb"),"",mb_substr($news->content, 0, 35))}}
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
        });
        $('.bs-docs-sidebar ul').on('click', 'li', function(event) {
            event.preventDefault();
            $(this).addClass('active').siblings('li').removeClass('active');
            self.location = "/news?newtype=" + $(this).attr('data-content');
        });
        $(document).ready(function(){
          $(window).scroll(function() {
            if (document.body.clientWidth < 1400 && $('.bs-docs-sidebar').offset().top-$(document).scrollTop() <10) {
                $('.bs-docs-sidebar').addClass('fixed');
            }
            if (document.body.clientWidth < 1400 && $('.bs-docs-sidebar').offset().top <200) {
                $('.bs-docs-sidebar').removeClass('fixed');
            }
            
          });
        });
    </script>
@endsection
;
