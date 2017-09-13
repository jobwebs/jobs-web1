@extends('layout.master')
@section('title', '添加简历')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

    <style>
        .resume-card {
            width: 100%;
            margin: 50px 0 20px 0;
            min-height: 0;
            position: relative;
        }

        .mdl-card__title {
            padding-bottom: 3px;
        }

        .mdl-card__supporting-text {
            padding-top: 3px;
        }

        .resume-child-card {
            width: 100%;
            min-height: 0;
            padding-bottom: 40px;
            /*margin-bottom:20px;*/
        }

        .resume-child-card .mdl-card__title-text {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .intention-panel p,
        .education-panel p {
            padding: 5px 25px;
            display: inline-block;
            color: var(--primary-color);
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p {
            display: block !important;
            border: 1px solid var(--divider-light);
            margin-bottom: 16px;
            margin-right: 16px;
            vertical-align: middle;
        }

        .education-panel p:hover {
            background-color: var(--divider-light);
        }

        .intention-panel p span {
            color: var(--text-color-secondary);
            font-size: 14px;
        }

        .education-panel p span {
            margin-right: 10px;
        }

        .education-panel p i {
            float: right;
            cursor: pointer;
            font-size: 16px;
            color: var(--tomato-dark);
            position: relative;
            top: 5px;
            border-radius: 16px;
            background: var(--divider-light);
        }

        .skill-panel span i:hover,
        .education-panel p i:hover {
            background: var(--divider);
            color: var(--tomato);
        }

        .skill-panel span {
            display: inline-block;
            background: var(--blue-sky);
            padding: 8px 30px 8px 12px;
            margin: 6px;
            font-size: 13px;
            font-weight: 300;
            color: var(--snow);
            border-radius: 3px;
            position: relative;
        }

        .skill-panel span i {
            position: absolute;
            right: 8px;
            top: 27%;
            font-size: 16px;
            color: var(--tomato-dark);
            border-radius: 16px;
            background: var(--divider-light);
            cursor: pointer;
        }

        .additional-panel p {
            padding: 0 8px;
        }

        .intention-panel-update,
        .education-panel-update,
        .skill-panel-update,
        .additional-panel-update {
            padding: 20px;
            background-color: var(--divider-light);
            z-index: auto;
        }

        /*------------------*/

        .form-group {
            display: inline-block !important;
            margin-bottom: 25px;
        }

        .form-control {
            display: inline-block;
            padding: 6px 12px 6px 0;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: var(--divider-light);
        }

        .form-control button[type="button"] {
            background-color: var(--divider-light) !important;
        }

        .dropdown-menu {
            z-index: 999;
        }

        .dropdown-menu li {
            display: block;
            width: 100%;
            margin: 0;
        }

        .bs-searchbox > input {
            display: inline-block;
            width: 385px !important;
            padding: 6px 12px !important;
            background-color: var(--snow) !important;
        }

        .resume-name--form {
            width: 180px;
            padding-left: 16px;
        }

        .resume-name--form input {
            background-color: transparent;
        }

        #resume-name--change {
            width: 88px;
            position: absolute;
            left: 200px;
            top: 89px;
        }
    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => true])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">
            <div class="resume-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">添加简历</h5>
                </div>

                <div class="mdl-card__supporting-text">
                    添加并完善简历后即可投递给心仪的公司。So Easy！
                </div>

                <input type="hidden" name="rid" value="{{$data['rid']}}">

                <div class="form-group resume-name--form">
                    <div class="form-line">
                        <input type="text" id="resume-name" name="resume-name" class="form-control"
                               placeholder="不能为空" value="#{{$data['rid']}}">
                    </div>
                </div>

                <button id="resume-name--change"
                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                    修改
                </button>
            </div>
            <div class="info-panel--left">

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">求职意向</h5>
                    </div>

                    <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="update-intention">
                            <i class="material-icons">mode_edit</i>
                        </button>

                        <div class="mdl-tooltip" data-mdl-for="update-intention">
                            修改
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border intention-panel">

                        <div class="mdl-card__supporting-text">
                            您还没有填写过求职意向，点击右上角进行填写
                        </div>

                        {{--<p>地区：<span>成都</span></p>--}}
                        {{--<p>行业分类：<span>电竞直播</span></p>--}}
                        {{--<p>工作类型：<span>全职</span></p>--}}
                    </div>

                    <div class="mdl-card__actions mdl-card--border intention-panel-update">

                        <label for="position-place">工作地区</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" data-live-search="true"
                                    id="position-place" name="place">
                                <option value="">任意</option>
                                @foreach($data['region'] as $region)
                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="position-industry">行业分类</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="position-industry"
                                    name="industry">
                                <option value="0">任意</option>
                                @foreach($data['industry'] as $industry)
                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="position-type">工作类型</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="position-type" name="type">
                                <option value="0">任意</option>
                                <option value="1">全职</option>
                                <option value="2">兼职</option>
                            </select>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                取消
                            </button>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认修改
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">教育经历</h5>
                    </div>

                    <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="update-education">
                            <i class="material-icons">add</i>
                        </button>

                        <div class="mdl-tooltip" data-mdl-for="update-education">
                            添加
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border education-panel">

                        <div class="mdl-card__supporting-text">
                            您还没有填写过教育经历，点击右上角进行填写
                        </div>

                        <p>
                            {{--<input type="hidden" name="education[0][school]"/>--}}
                            {{--<input type="hidden" name="education[0][degree]"/>--}}
                            {{--<input type="hidden" name="education[0][subject]"/>--}}
                            {{--<input type="hidden" name="education[0][begin]"/>--}}
                            <span>四川大学</span><span>2016-9入学</span><span>计算机技术</span><span>硕士</span>
                            <i class="material-icons delete education-item">close</i>
                        </p>
                        <p>
                            {{--<input type="hidden" name="education[1][school]"/>--}}
                            {{--<input type="hidden" name="education[1][degree]"/>--}}
                            {{--<input type="hidden" name="education[1][subject]"/>--}}
                            {{--<input type="hidden" name="education[1][begin]"/>--}}
                            <span>家里蹲大学</span><span>2012-9入学</span><span>计算机科学与技术</span><span>本科</span>
                            <i class="material-icons delete education-item">close</i>
                        </p>
                    </div>

                    <div class="mdl-card__actions mdl-card--border education-panel-update">

                        <label for="school-name">学校</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="school-name" name="school-name" class="form-control"
                                       placeholder="不能为空">
                            </div>
                        </div>

                        <label for="education-degree">学历</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="education-degree" name="degree">
                                <option value="1">高中</option>
                                <option value="2">本科</option>
                                <option value="3">硕士及以上</option>
                            </select>
                        </div>

                        <label for="school-name">专业</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="subject-name" name="subject-name" class="form-control"
                                       placeholder="可以为空">
                            </div>
                        </div>

                        <label for="education-begin">入学时间</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" id="education-begin" name="education-begin" class="form-control"
                                       placeholder="不能为空">
                            </div>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                取消
                            </button>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认添加
                            </button>
                        </div>

                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">技能特长</h5>
                    </div>

                    <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="update-skill">
                            <i class="material-icons">add</i>
                        </button>

                        <div class="mdl-tooltip" data-mdl-for="update-skill">
                            添加
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border skill-panel">

                        <div class="mdl-card__supporting-text">
                            您还没有填写过技能特长，点击右上角进行填写
                        </div>

                        <span>
                            <small>王者荣耀|至尊星耀</small>
                            <i class="material-icons delete skill-item">close</i>
                        </span>
                        <span>
                            <small>LOL|超凡大师</small>
                            <i class="material-icons delete skill-item">close</i>
                        </span>
                    </div>

                    <div class="mdl-card__actions mdl-card--border skill-panel-update">

                        <label for="skill-name">技能特长名称</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="skill-name" name="skill-name" class="form-control"
                                       placeholder="不能为空">
                            </div>
                        </div>

                        <label for="skill-degree">级别</label>&nbsp;&nbsp;<small>例如：熟练度，分数，等级</small>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="skill-degree" name="skill-degree" class="form-control"
                                       placeholder="不能为空">
                            </div>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                取消
                            </button>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认添加
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">附加信息</h5>
                    </div>

                    <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="update-additional">
                            <i class="material-icons">add</i>
                        </button>

                        <div class="mdl-tooltip" data-mdl-for="update-additional">
                            添加
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border additional-panel">

                        <div class="mdl-card__supporting-text">
                            您还没有填写过附加信息，点击右上角进行填写
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sagittis pellentesque lacus
                            eleifend lacinia...</p>
                    </div>

                    <div class="mdl-card__actions mdl-card--border additional-panel-update">

                        <label for="additional-content">添加附加内容</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="5" class="form-control" name="additional-content"
                                          id="additional-content"
                                          placeholder="还有什么是我们没想到的？在这里填写你想填写的任意内容"></textarea>
                            </div>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect">
                                取消
                            </button>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right">
                @include('components.baseUserProfile', ['isShowFunctionPanel' => false])

                <div class="button-panel left">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky"
                            to="/resume/preview">
                        预览简历
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

    <script type="text/javascript">

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $intentionPanelUpdate = $(".intention-panel-update");
        $educationPanelUpdate = $(".education-panel-update");
        $skillPanelUpdate = $(".skill-panel-update");
        $additionalPanelUpdate = $(".additional-panel-update");

        $intentionPanelUpdate.hide();
        $educationPanelUpdate.hide();
        $skillPanelUpdate.hide();
        $additionalPanelUpdate.hide();

        $("#update-intention").click(function () {
            $intentionPanelUpdate.fadeIn();
        });

        $("#update-education").click(function () {
            $educationPanelUpdate.fadeIn();
        });

        $("#update-skill").click(function () {
            $skillPanelUpdate.fadeIn();
        });

        $("#update-additional").click(function () {
            $additionalPanelUpdate.fadeIn();
        });

        $intentionPanelUpdate.find(".button-panel>button").click(function () {
            $intentionPanelUpdate.hide();
        });

        $educationPanelUpdate.find(".button-panel>button").click(function () {
            $educationPanelUpdate.hide();
        });

        $skillPanelUpdate.find(".button-panel>button").click(function () {
            $skillPanelUpdate.hide();
        });

        $additionalPanelUpdate.find(".button-panel>button").click(function () {
            $additionalPanelUpdate.hide();
        });


        $(".delete").click(function () {
            $(this.parentNode).remove();
        });
    </script>
@endsection
