<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="baidu-site-verification" content="2qvzcodiFx" />
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/icon-fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/style.css')}}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">

    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('favicon/android-icon-192x192.png')}}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <style> 
        .footer-link{
                float: right;
    margin-top: 21px;
        margin-right: -8px;
        }
        .footer-link li{
            border-right: 1px solid #f1f1f1;
            padding: 0px 8px;
            line-height: 14px;
            padding-right: 11px;
            margin-right: 0px;
        }
        .footer-link li:last-child{
            border-right:none;
        }
        .footer-link li a{
            font-size:13px;
        }
        .footer-link li a:hover{
            text-decoration: underline;
        }
        .resume_explain_body img{
            border: 1px solid #eee;
        }
        .resume_explain_body .modal-body .modal-img{
            text-align: center;
         }
        .resume_explain_body .modal-body-paper{
            color:#000;
        }
        .resume_explain_body .modal-body-detail{
            color:#222;
        }
        .resume_explain_body .modal-body-detail2{
            color:#333;
        }
        .resume_explain_body{
            width: 60%;
            min-width: 700px;
        }
    </style>
    @section('custom-style')
    @show
</head>
<body>

<header class="header-layout">

    @section('header-nav')
    @show

    @section('header-tab')
    @show
</header>

@section('content')

@show

@section('footer')
    <footer>
        <div class="container">
            <div class="left">
                <img src="{{asset("images/logo-white.png")}}" width="150px"/><br>
                <span style="position: relative; top: 4px;"><small><?=$site_desc ?></small></span>
                <br>
                <br>
                <small>联系：kefu@eshunter.com</small>
                <br>
                <small>联系：(86)021-63339866</small>
                <br>
                <small>地址：上海市黄浦区会稽路8号金天地国际大厦708室</small>
                <br>
                <small>邮编：200021</small>
                <br>

            </div>

            {{--<div class="middle">--}}
                {{--<p></p>--}}
            {{--</div>--}}

            <div class="right">
                <ul class="footer-link">
                    <li><a data-toggle="modal" data-target="#resume_explain" href="">简历指导</a></li>
                    <li><a href="/about">关于我们</a></li>
                    <li><a href="/about">联系我们</a></li>
                    <li><a href="/about">网站地图</a></li>
                    <li><a data-toggle="modal" data-target="#watch_details" href="">免责申明</a></li>
                </ul>
                <span class="copy-right">
                    上海汉竞信息科技有限公司<br>
                    电竞猎人 | E-sport Hunter版权所有 </br>
                    site design & develop &copy; 2017 Four2Nine Studio<br>
                </span>
            </div>
            {{--<div style="width:300px;">--}}
            {{--<div style="width: 100%">--}}
            {{--<span>沪ICP备17037845号-1</span>--}}
                {{--<a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31010102004612" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">--}}
                    {{--<img src="{{asset('images/police.png')}}" style="float:left;"/>--}}
                    {{--<span style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">沪公网安备 31010102004612号</span >--}}
                {{--</a>--}}
            {{--</div>--}}
            <div style="clear: both;"></div>
        </div>
        <div class="container" style="text-align: center;">
            <div style="width: 100%">
                <span style="color:#939393">沪ICP备17037845号-1</span>
                <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31010102004612" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                    <img src="{{asset('images/police.png')}}" style="float:left;"/>
                    <span style="height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">沪公网安备 31010102004612号</span >
                </a>
            </div>
        </div>
    </footer>
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="watch_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        电竞猎人免责申明
                    </h4>
                </div>
                <div class="modal-body look-detail-modal-body">
                    <div class="modal-body look-detail-modal-body">
                        电竞猎人平台文章多来源于网络，转载内容只为传播信息无任何商业目的，若涉及版权或侵权的问题请邮件联系我们，核实后我们将删除
                        <ul>
                            <li>联系我们：021-63339866</li>
                            <li>邮箱：kefu@eshunter.com</li>
                        </ul>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                            data-dismiss="modal">关闭
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    
    <div class="modal fade" id="resume_explain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog resume_explain_body">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">
                        简历说明
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="modal-body-paper">
                        <p>找工作都需要一个认真的态度，对待所有工作都是，对待电竞相关的工作也是如此。</p>
                        <p>草草敷衍的填写简历，多数企业是不会给予机会嗒。</p>
                        <p>不管你想打职业，想做赛事，想做幕后，等等...</p>
                        <p>都希望您认真并属实的填写简历哦！</p>

                        <p>以下为一些简单的范例，从工作经历开始，仅供参考。</p>
                    </div>
                    <div class="modal-body-detail">
                        <p>1. 工作经历：不管实习还是全职工作经历，请填写公司、职位、工作时间，以及详细的工作经历。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain1.png")}}" alt=""></div>
                    <div class="modal-body-detail">
                        <p>2. 每个人寻求的都是不同方向的岗位，想做选手的有一些比赛经历，想做赛事的可以填一些赛事策划或执行的经历，又或者是程序猿有编程项目的经历等等。</p>
                    </div>
                    <div class="modal-body-detail2">
                        <p>（1）有打比赛的经历，请填写赛事名称、游戏、位置、时间，以及比赛的描述。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain2.png")}}" alt=""></div>
                    <div class="modal-body-detail2">
                        <p>（2）有赛事的经历，可以填写赛事名称、负责的职责、时间，以及具体策划或执行的细节。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain3.png")}}" alt=""></div>
                    <div class="modal-body-detail2">
                        <p>（3）又或者您应聘的是电竞公司的程序猿，可以填写一些自己曾经负责或参与开发的APP或者网站项目。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain4.png")}}" alt=""></div>
                    <div class="modal-body-detail">
                        <p>3. 电竞经历：填写自己平时在玩的一些游戏，选择大概的段位，然后在再细致的备注一下游戏里的具体服务器、游戏ID、KDA等等，这也是招聘的加分项哦。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain5.png")}}" alt=""></div>
                    <div class="modal-body-detail">
                        <p>4. 技能特长：职场上还需要自己一些实用技能，比如会编程、熟悉办公软件、会PS，都是企业很看重的。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain6.png")}}" alt=""></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">关闭
                    </button>
                    <!-- <button type="button" class="btn btn-primary">
                        关闭
                    </button> -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

@show

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/material.js')}}"></script>
<script src="{{asset('js/master.js')}}"></script>
<script type="text/javascript">
    $("*[to]").click(function () {
        self.location = $(this).attr('to');
    });
</script>

@section('custom-script')
@show
</body>
</html>
