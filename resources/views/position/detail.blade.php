@extends('layout.master')

@section('title', "职位详情")

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>

        .mdl-card__menu label {
            vertical-align: middle;
            font-weight: 300;
            font-size: 12px;
        }

        .mdl-card__menu label i {
            font-size: 20px;
        }

        .mdl-card__menu label.count {
            position: relative;
            top: -2px;
            padding-right: 5px;
        }

        .mdl-card__title {
            padding-bottom: 3px;
        }
        .relative{
            position: relative;
        }
        #look_more{
            font-size: 12px;
            color: cornflowerblue;
            cursor: pointer;
            float: right;
            /* margin-bottom: 19px; */
            position: absolute;
            bottom: 7px;
            right: 19px;
        }
        .mdl-card__supporting-text {
            font-size: 13px;
            width: 100%;
        }

        .mdl-card__supporting-text label {
            font-weight: 300;
            color: #aaaaaa;
            margin-right: 6px;
        }

        .mdl-card__supporting-text label span {
            margin-right: 6px;
        }

        .mdl-card__supporting-text p {
            margin: 12px 8px;
            color: #232323;
        }

        .mdl-card__supporting-text p b {
            font-size: 16px;
        }

        .mdl-card__supporting-text ul {

        }

        .mdl-card__supporting-text ul li {
            display: block;
            margin-left: 6px;
        }

        .position-card .mdl-card__actions {
            background-color: #f5f5f5;
        }

        .base-info--panel label {
            margin-right: 60px;
        }

        .base-info--panel label:last-child {
            margin-right: 0;
        }

        .base-info--panel label i,
        .base-info--panel label span {
            vertical-align: middle;
            font-size: 16px;
        }

        .position-card {
            margin-top: 8px;
            min-height: 0;
        }

        .position-card > .mdl-card__supporting-text {
            padding: 4px 16px 8px 16px;
        }

        .view-all {
            display: block;
            text-align: center;
            font-weight: 300;
            padding: 15px 0;
            color: #737373;
        }

        a.view-all:hover {
            color: #737373;
            background-color: #aaaaaa;
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

        .base-info--panel label {
            margin-right: 24px !important;
        }

        .base-info--panel label:last-child {
            float: right;
            position: relative;
            top: -4px;
            left: 10px;
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
    @include('components.headerTab', ['activeIndex' => 0, 'type'=>$data['type']])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">
            <div class="info-panel--left info-panel">

                <div class="mdl-card mdl-shadow--2dp info-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">
                            @if(empty($data['detail']->title))
                                没有填写职位名称
                            @else
                                {{$data['detail']->title}}
                            @endif
                        </h5>
                    </div>

                    <div class="mdl-card__menu">
                        {{--<label id="apply-count-icon"><i class="material-icons">assignment</i></label>--}}
                        {{--<label class="count">--}}
                            {{--{{$data['dcount']}}--}}
                        {{--</label>--}}

                        {{--<label id="view-count-icon"><i class="material-icons">visibility</i></label>--}}
                        {{--<label class="count">--}}
                            {{--{{$data['detail']->view_count}}--}}
                        {{--</label>--}}

                        {{--<div class="mdl-tooltip" data-mdl-for="apply-count-icon">--}}
                            {{--申请人数--}}
                        {{--</div>--}}

                        {{--<div class="mdl-tooltip" data-mdl-for="view-count-icon">--}}
                            {{--浏览次数--}}
                        {{--</div>--}}
                    </div>

                    <div class="mdl-card__supporting-text">
                        <label>发布时间: <span>{!!mb_substr($data['detail']->created_at,0,10,'utf-8') !!}</span></label>
                        <label>福利标签:
                            <span>{{$data['detail']->tag or "无标签"}}</span>
                            {{--@foreach(preg_split($data['detail']->tag, ",") as $tag)--}}
                            {{--<span>{{$tag}}</span>--}}
                            {{--@endforeach--}}
                        </label>
                    </div>

                    <div class="mdl-card__actions mdl-card--border base-info--panel">
                        <label><i class="material-icons">attach_money</i>
                            <span>
                                @if($data['detail']->salary <= 0)
                                    月薪面议
                                @else
                                    月薪 {{$data['detail']->salary}}元/月
                                @endif
                            </span>
                        </label>
                        <label><i class="material-icons">location_on</i>
                            <span>工作地点 {{$data['region']->name or "未知"}}</span>
                        </label>
                        <label><i class="material-icons">person_add</i>
                            <span>
                                @if($data['detail']->total_num == null)
                                    招聘人数未知
                                @else
                                    招聘 {{$data['detail']->total_num}} 人
                                @endif
                            </span>
                        </label>
                        <label>
                            @if($data['type']==0)
                                <button class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky" to="/account/login">
                                    投简历
                                </button>
                            @elseif($data['detail']->position_status==1)
                                <button data-toggle="modal" data-target="#chooseResumeModal"
                                        data-content="{{$data['detail']->pid}}"
                                        class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    投简历
                                </button>
                            @else
                                <button class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    无法投简
                                </button>
                            @endif
                        </label>
                    </div>

                    <div class="mdl-card__supporting-text">
                        <p><b>所属游戏:</b>{{$data['detail']->name}}<p>
                        <p>
                            <b>介绍: </b></br>
                            @if($data['detail']->pdescribe == null || $data['detail']->pdescribe == "")
                                暂无职位介绍
                            @else
                                {!! $data['detail']->pdescribe !!}
                            @endif
                        </p>
                        <p><b>要求: </b></p>
                        <ul>
                            <li>
                                @if(empty($data['detail']->experience))
                                    无经验要求
                                @else
                                    {!! $data['detail']->experience !!}
                                @endif
                            </li>
                            <li><b>学历:</b>
                                @if($data['detail']->education < 0)
                                    无学历要求
                                @elseif($data['detail']->education == 0)
                                    高中及以上
                                @elseif($data['detail']->education == 3)
                                    专科及以上
                                @elseif($data['detail']->education == 1)
                                    本科及以上
                                @elseif($data['detail']->education == 2)
                                    研究生及以上
                                @else
                                    无学历要求
                                @endif
                            </li>
                            <li><b>年龄:</b>
                                @if($data['detail']->max_age == 0)
                                    无年龄要求
                                @else
                                    {{$data['detail']->max_age}}以内
                                @endif
                            </li>
                            <li><b>上班地址:</b>
                                @if($data['detail']->workplace =="-1" ||strlen($data['detail']->workplace)==0)
                                    上班地址待定
                                @else
                                    {{$data['detail']->workplace}}
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">
                @if($data['is_tempuser']['username'] == "tempUser")
                    @include('components.baseEnterpriseProfile', ['isShowMenu'=>false, 'isShowFunctionPanel' => false, "info"=>$data["enprinfo"][0],"industry"=>$data["industry"],"is_tempuser" => true])
                @else
                    @include('components.baseEnterpriseProfile', ['isShowMenu'=>false, 'isShowFunctionPanel' => false, "info"=>$data["enprinfo"][0],"industry"=>$data["industry"],"is_tempuser" => false])
                @endif
                <?php
                $index = 0;
                $count = count($data['position']);
                ?>
                <h6>公司其他职位&nbsp;&nbsp;&nbsp;<small>共{{$count}}个</small>
                    {{--<a to="/company?eid={{$data['position'][0]->eid}}">查看全部</a>--}}
                    @if($count!=0)
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect button-link" to="/company?eid={{$data['position'][0]->eid}}">
                            查看全部
                        </button>
                    @endif
                </h6>

                @forelse($data['position'] as $position)
                    @if(++$index < 4)
                        <div class="mdl-card mdl-shadow--2dp info-card position-card">
                            <div class="mdl-card__title">
                                <h5 class="mdl-card__title-text" style="margin-top: 0rem;">
                                    @if(empty($position->title))
                                        没有填写职位名称
                                    @else
                                        {{mb_substr($position->title, 0, 15, 'utf-8')}}
                                    @endif
                                </h5>
                            </div>
                            <div class="mdl-card__supporting-text">
                                {{--<b>介绍: </b>--}}
                                {{--<span>--}}
                                {{--@if(empty($data->pdescribe))--}}
                                        {{--没有填写职位描述--}}
                                    {{--@else--}}
                                        {{--{{str_replace("</br>","",mb_substr($data->pdescribe, 0, 30, 'utf-8'))}}    --}}
				                {{--@endif--}}
                            {{--</span>--}}
                                <b>工作地区：</b><span>{{$position->name}}</span>&nbsp&nbsp
                                <b>薪资：</b><span>
                                @if($position->salary <= 0)
                                        月薪面议
                                    @else
                                        {{$position->salary}}元/月
                                    @endif
                            </span>
                            </div>

                            <div class="mdl-card__actions mdl-card--border">
                                <div class="button-panel">
                                    <button data-content="{{$position->pid}}"
                                            class="position-view mdl-button mdl-js-button mdl-js-ripple-effect button-link">
                                        查看详情
                                    </button>
                                    {{--@if($data->position_status==1)--}}
                                        {{--<button data-toggle="modal" data-target="#chooseResumeModal"--}}
                                                {{--data-content="{{$data->pid}}"--}}
                                                {{--class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">--}}
                                            {{--投简历--}}
                                        {{--</button>--}}
                                    {{--@else--}}
                                        {{--<button class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">--}}
                                            {{--无法投简--}}
                                        {{--</button>--}}
                                    {{--@endif--}}
                                    @if($data['type']==0)
                                        <button class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky" to="/account/login">
                                            投简历
                                        </button>
                                    @elseif($position->position_status==1)
                                        <button data-toggle="modal" data-target="#chooseResumeModal"
                                                data-content="{{$position->pid}}"
                                                class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                            投简历
                                        </button>
                                    @else
                                        <button class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                            无法投简
                                        </button>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="mdl-card__supporting-text">
                        该公司没有其他职位
                    </div>
                @endforelse

                {{--@if($count > 5)--}}
                {{--<a class="view-all" href="#">查看全部</a>--}}
                {{--@endif--}}

            </div>
        </div>
    </div>

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
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
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

        $(".position-view").click(function () {
            self.location = '/position/detail?pid=' + $(this).attr("data-content");
        });
            var look_more = $('#look_more')
            var company_text = look_more.prev().text()
            if (company_text.length<100) {
                look_more.hide()
            }else{
                look_more.prev().text(company_text.substr(0,99)+"...") 
                look_more.on('click', function() {
                    if (look_more.prev().text().length!=102) {
                        look_more.prev().text(company_text.substr(0,99)+"...") 
                        look_more.text("查看更多>>")
                    }else{
                     look_more.prev().text(company_text)
                     look_more.text("点击收起")
                    }
                });
            }
    </script>
@endsection
