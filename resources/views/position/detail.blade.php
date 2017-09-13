@extends('layout.master')

@section('title', "职位详情")

@section('custom-style')
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
            padding-right: 12px;
        }

        .mdl-card__title {
            padding-bottom: 3px;
        }

        .mdl-card__supporting-text {
            font-size: 13px;
            width: 100%;
        }

        .mdl-card__supporting-text label {
            font-weight: 300;
            color: var(--text-color-light);
            margin-right: 6px;
        }

        .mdl-card__supporting-text label span {
            margin-right: 6px;
        }

        .mdl-card__supporting-text p {
            margin: 12px 8px;
            color: var(--text-color-primary);
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
            background-color: var(--divider-light);
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
            color: var(--text-color-secondary);
        }

        a.view-all:hover {
            color: var(--text-color-secondary);
            background-color: var(--text-color-light);
        }

        .resume-list {
            width: 100%;
            display: block;
        }

        .resume-item {
            border: 1px solid var(--divider);
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
            background-color: var(--blue-sky);
            color: var(--snow);
        }

        .resume-item p {
            margin: 0;
        }

    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => true])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 0])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">
            <div class="info-panel--left info-panel">
                <div class="mdl-card mdl-shadow--2dp info-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">
                            @if(empty($position->title))
                                没有填写职位名称
                            @else
                                {{$position->title}}
                            @endif
                        </h5>
                    </div>

                    <div class="mdl-card__menu">
                        <label id="apply-count-icon"><i class="material-icons">assignment</i></label>
                        <label class="count">
                            {{--todo 2017-09-06 该职位被投递简历的次数--}}
                            ??
                        </label>

                        <label id="view-count-icon"><i class="material-icons">visibility</i></label>
                        <label class="count">
                            {{$position['detail']->view_count}}
                        </label>

                        <div class="mdl-tooltip" data-mdl-for="apply-count-icon">
                            申请人数
                        </div>

                        <div class="mdl-tooltip" data-mdl-for="view-count-icon">
                            浏览次数
                        </div>
                    </div>

                    <div class="mdl-card__supporting-text">
                        <label>发布时间: <span>{{$position['detail']->created_at}}</span></label>
                        <label>标签:
                            <span>{{$position['detail']->tag}}</span>
                            {{--@foreach(preg_split($position['detail']->tag, ",") as $tag)--}}
                            {{--<span>{{$tag}}</span>--}}
                            {{--@endforeach--}}
                        </label>
                    </div>

                    <div class="mdl-card__actions mdl-card--border base-info--panel">
                        <label><i class="material-icons">attach_money</i>
                            <span>月薪 {{$position['detail']->salary}}元/月</span>
                        </label>
                        <label><i class="material-icons">location_on</i>
                            {{--todo 2017-09-06 工作地点需要返回具体的值，现在是id--}}
                            <span>工作地点 {{$position['detail']->region}}</span>
                        </label>
                        <label><i class="material-icons">person_add</i>
                            <span>招聘 {{$position['detail']->total_num}} 人</span>
                        </label>
                        <label>
                            <button id="deliver-resume" data-toggle="modal" data-target="#chooseResumeModal"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                投简历
                            </button>
                        </label>
                    </div>

                    <div class="mdl-card__supporting-text">
                        <p>
                            <b>介绍: </b>
                            {{$position['detail']->describe}}
                        </p>

                        <br>
                        <p><b>要求: </b></p>
                        <ul>
                            <li>工作经验：{{$position['detail']->experience}}</li>
                            <li>学历：{{$position['detail']->education}}</li>
                            <li>年龄：{{$position['detail']->max_age}}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">
                @include('components.baseEnterpriseProfile', ['isShowMenu'=>false, 'isShowFunctionPanel' => false])


                <?php
                $index = 0;
                $count = count($position['position']);
                ?>
                <h6>公司其他职位&nbsp;&nbsp;&nbsp;<small>共{{$count}}个</small>
                </h6>

                @forelse($position['position'] as $position)
                    @if(++$index < 5)
                        <div class="mdl-card mdl-shadow--2dp info-card position-card">
                            <div class="mdl-card__title">
                                <h5 class="mdl-card__title-text">
                                    @if(empty($position->title))
                                        没有填写职位名称
                                    @else
                                        {{substr($position->title, 0, 10)}}
                                    @endif
                                </h5>
                            </div>
                            <div class="mdl-card__supporting-text">
                                <b>介绍: </b>
                                <span>
                                @if(empty($position->describe))
                                        没有填写职位描述
                                    @else
                                        {{substr($position->describe, 0, 80)}}
                                    @endif
                            </span>
                            </div>

                            <div class="mdl-card__actions mdl-card--border">
                                <div class="button-panel">
                                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect button-link">
                                        查看详情
                                    </button>
                                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                        投简历
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="mdl-card__supporting-text">
                        该公司没有其他职位
                    </div>
                @endforelse

                @if($count > 5)
                    <a class="view-all" href="#">查看全部</a>
                @endif

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
    <script type="text/javascript">
        $("#deliver-resume").click(function () {
            $.ajax({
                url: "/resume/getResumeList",
                type: "get",
                success: function (data) {
                    var html = "<ul class='resume-list'>";

                    for (var item in data) {

                        var resumeName = data[item]['resume_name'] === null ? "未命名的简历" : data[item]['resume_name'];
                        html += "<li class='resume-item' data-content='" + data[item]['rid'] + "' onclick='resumeChosen(this)'>" +
                            "<p>" + resumeName + "</p>" +
                            "</li>";
                    }

                    html += "</ul>";

                    $(".modal-body").html(html);
                }
            })
        });

        function resumeChosen(element) {
            $("#chooseResumeModal").modal('hide');
            alert($(element).attr("data-content"));
        }
    </script>
@endsection
