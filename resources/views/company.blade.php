@extends('layout.master')
@section('title', '企业主页')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <style>

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

        .resume-list {
            width: 100%;
            display: block;
        }

        .resume-item {
            border: 1px solid #ebebeb;
            display: block;
            padding: 8px 16px;
            margin-bottom: 16px;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .resume-item:hover {
            background-color: #03A9F4;
            color: #ffffff;
        }

        .resume-item p {
            margin: 0;
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
    @include('components.headerTab', ['activeIndex' => 1,'type' => $data['type']])
@endsection

@section('content')

    <section class="main">

        <div class="container">

            <div class="content">

                @if(!isset($data['enprinfo']))
                    <div class="position-empty">
                        <h5>该企业未入驻平台</h5>
                    </div>
                @endif

                <div class="info-panel--left info-panel">

                    @if(isset($data['position']))
                        @forelse($data['position'] as $position)
                            <div class="mdl-card mdl-shadow--2dp info-card position-card">
                                <div class="mdl-card__title">
                                    <h5 class="mdl-card__title-text">
                                        {{$position['title'] or "没有填写职位名称"}}
                                    </h5>
                                </div>
                                <div class="mdl-card__supporting-text">
                                    <b>介绍: </b>
                                    <span>
                                	 @if(empty($position->pdescribe))
 	                                   没有填写职位描述
        	                         @else
        	                            {{str_replace("</br>","",mb_substr($position->pdescribe, 0, 60, 'utf-8'))}}
                                         @endif 
                                    </span>
                                </div>

                                <div class="mdl-card__actions mdl-card--border">
                                    <div class="button-panel">
                                        <button to="/position/detail?pid={{$position['pid']}}"
                                                class="position-view mdl-button mdl-js-button mdl-js-ripple-effect button-link">
                                            查看详情
                                        </button>
                                        <button data-toggle="modal" data-target="#chooseResumeModal"
                                                data-content="{{$position['pid']}}"
                                                class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                            投简历
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="position-empty">
                                <img src="{{asset('images/desk.png')}}" width="40px">
                                <span>&nbsp;&nbsp;没有发布职位</span>
                            </div>
                        @endforelse
                    @endif
                </div>

                <div class="gap"></div>
                <div class="info-panel--right  info-panel">

                    @if(isset($data['enprinfo']))

                        @include('components.baseEnterpriseProfile', ['isShowMenu'=>false, 'isShowFunctionPanel' => false, "info"=>$data["enprinfo"], "industry" => $data["industry"],"is_tempuser"=>false])

                        <div class="button-panel left" hidden>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                广告超链接
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Dialogs ====================================================================================================================== -->
    <!-- Default Size -->
    <div class="modal fade" id="chooseResumeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">选择简历</h4>
                </div>

                <div class="modal-body"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom-script')
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script type="text/javascript">

        $(".deliver-resume").click(function () {

            var $pid = $(this).attr("data-content");

            $.ajax({
                url: "/resume/getResumeList",
                type: "get",
                success: function (data) {

                    var html = "<ul class='resume-list'>";
                    if (data.length === 0) {
                        html = "<button onclick='addResume()' " +
                            "class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky'>" +
                            "没有简历，点击添加 </button>"
                    } else {
                        for (var item in data) {

                            var resumeName = data[item]['resume_name'] === null ? "未命名的简历" : data[item]['resume_name'];
                            html += "<li class='resume-item' data-content='" + data[item]['rid'] + "' onclick='resumeChosen(this, " + $pid + ")'>" +
                                "<p>" + resumeName + "</p>" +
                                "</li>";
                        }

                        html += "</ul>";
                    }

                    $(".modal-body").html(html);
                }
            })
        });

        function resumeChosen(element, pid) {
            $("#chooseResumeModal").modal('hide');

            var rid = $(element).attr("data-content");

            var formData = new FormData();
            formData.append('rid', rid);
            formData.append('pid', pid);

            $.ajax({
                url: "/delivered/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    console.log(result);

                    checkResult(result.status, "简历投递成功", result.msg, null);
                }
            })

        }

        function addResume() {
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
        }
    </script>
@endsection
