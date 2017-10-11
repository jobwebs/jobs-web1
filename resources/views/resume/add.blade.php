@extends('layout.master')
@section('title', '添加简历')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>

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
            padding: 5px 10px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p {
            display: block !important;
            border: 1px solid #f5f5f5;
            margin: 16px;
            vertical-align: middle;
        }

        .education-panel p:hover {
            background-color: #f5f5f5;
        }

        .intention-panel p span {
            color: #737373;
            font-size: 14px;
        }

        .education-panel p span {
            margin-right: 10px;
        }

        .education-panel p i {
            float: right;
            cursor: pointer;
            font-size: 16px;
            color: #D32F2F;
            position: relative;
            top: 5px;
            border-radius: 16px;
            background: #f5f5f5;
        }

        .skill-panel span i:hover,
        .education-panel p i:hover {
            background: #ebebeb;
            color: #F44336;
        }

        .skill-panel span {
            display: inline-block;
            background: #03A9F4;
            padding: 8px 30px 8px 12px;
            margin: 6px;
            font-size: 13px;
            font-weight: 300;
            color: #ffffff;
            border-radius: 3px;
            position: relative;
        }

        .skill-panel span i {
            position: absolute;
            right: 8px;
            top: 27%;
            font-size: 16px;
            color: #D32F2F;
            border-radius: 16px;
            background: #f5f5f5;
            cursor: pointer;
        }

        .additional-panel p {
            padding: 0 8px;
        }

        .intention-panel-update,
        .education-panel-update,
        .skill-panel-update,
        .additional-panel-update,
        .game-panel-update {
            padding: 20px;
            background-color: #f5f5f5;
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
            background-color: #f5f5f5;
        }

        .form-control button[type="button"] {
            background-color: #f5f5f5 !important;
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
            background-color: #ffffff !important;
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
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2, 'type'=>$data['type']])
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
                               placeholder="不能为空" value="{{$data['resume']->resume_name}}">
                    </div>
                    <label class="error" for="resume-name"></label>
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

                        @if($data['intention'] == null)
                            <div class="mdl-card__supporting-text">
                                您还没有填写过求职意向，点击右上角进行填写
                            </div>
                        @else
                            <p>地区：
                                <span>
                                    @foreach($data['region'] as $region)
                                        @if($data['intention']->region == $region->id)
                                            {{$region->name}}
                                            @break
                                        @elseif($data['intention']->region == -1)
                                            任意
                                            @break
                                        @endif
                                    @endforeach
                                </span>
                            </p>
                            <p>行业分类：
                                <span>
                                    @foreach($data['industry'] as $industry)
                                        @if($data['intention']->industry == $industry->id)
                                            {{$industry->name}}
                                            @break
                                        @elseif($data['intention']->industry == -1)
                                            任意
                                            @break
                                        @endif
                                    @endforeach
                                </span>
                            </p>
                            <p>职业分类：
                                <span>
                                    @foreach($data['occupation'] as $occupation)
                                        @if($data['intention']->occupation == $occupation->id)
                                            {{$occupation->name}}
                                            @break
                                        @elseif($data['intention']->occupation == -1)
                                            任意
                                            @break
                                        @endif
                                    @endforeach
                                </span>
                            </p>
                            <p>工作类型：
                                <span>
                                    @if($data['intention']->work_nature == -1)
                                        任意
                                    @elseif($data['intention']->work_nature == 0)
                                        兼职
                                    @elseif($data['intention']->work_nature == 1)
                                        实习
                                    @elseif($data['intention']->work_nature == 2)
                                        全职
                                    @endif
                                </span>
                            </p>

                            <p>期望薪资（月）:
                                <span>
                                    @if($data['intention']->salary < 0)
                                        未指定
                                    @else
                                        {{$data['intention']->salary}} 元
                                    @endif
                                </span>
                            </p>
                        @endif
                    </div>

                    <div class="mdl-card__actions mdl-card--border intention-panel-update">

                        <label for="position-place">工作地区意向</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" data-live-search="true"
                                    id="position-place" name="place">
                                @if($data['intention'] == null)
                                    <option value="-1">任意</option>
                                    @foreach($data['region'] as $region)
                                        <option value="{{$region->id}}">{{$region->name}}</option>
                                    @endforeach
                                @else
                                    @if($data['intention']->region == -1)
                                        <option value="-1" selected>任意</option>
                                    @else
                                        <option value="-1">任意</option>
                                    @endif
                                    @foreach($data['region'] as $region)
                                        @if($data['intention']->region == $region->id)
                                            <option value="{{$region->id}}" selected>{{$region->name}}</option>
                                        @else
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <label for="position-industry">行业意向</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="position-industry"
                                    name="industry">

                                @if($data['intention'] == null)
                                    <option value="-1">任意</option>
                                    @foreach($data['industry'] as $industry)
                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                    @endforeach
                                @else
                                    @if($data['intention']->industry == -1)
                                        <option value="-1" selected>任意</option>
                                    @else
                                        <option value="-1">任意</option>
                                    @endif
                                    @foreach($data['industry'] as $industry)
                                        @if($data['intention']->industry == $industry->id)
                                            <option value="{{$industry->id}}" selected>{{$industry->name}}</option>
                                        @else
                                            <option value="{{$industry->id}}">{{$industry->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <label for="position-occupation">职业意向</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="position-occupation"
                                    name="occupation">

                                @if($data['intention'] == null)
                                    <option value="-1">任意</option>
                                    @foreach($data['occupation'] as $occupation)
                                        <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                    @endforeach
                                @else
                                    @if($data['intention']->occupation == -1)
                                        <option value="-1" selected>任意</option>
                                    @else
                                        <option value="-1">任意</option>
                                    @endif
                                    @foreach($data['occupation'] as $occupation)
                                        @if($data['intention']->occupation == $occupation->id)
                                            <option value="{{$occupation->id}}" selected>{{$occupation->name}}</option>
                                        @else
                                            <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <label for="position-type">工作类型意向</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="position-type" name="type">
                                @if($data['intention'] == null)
                                    <option value="-1">任意</option>
                                    <option value="0">兼职</option>
                                    <option value="1">实习</option>
                                    <option value="2">全职</option>
                                @else
                                    <option value="-1" {{$data['intention']->work_nature==-1?"selected":""}}>任意</option>
                                    <option value="0" {{$data['intention']->work_nature==0?"selected":""}}>兼职</option>
                                    <option value="1" {{$data['intention']->work_nature==1?"selected":""}}>实习</option>
                                    <option value="2" {{$data['intention']->work_nature==2?"selected":""}}>全职</option>
                                @endif
                            </select>
                        </div>

                        <label for="position-salary">薪资意向（月）</label>
                        <div class="form-group">
                            <div class="form-line">
                                @if($data['intention'] == null || $data['intention']->salary < 0)
                                    <input type="number" id="position-salary" name="salary" class="form-control"
                                           step="1" placeholder="薪资意向(单位：元)，选填">
                                @else
                                    <input type="number" id="position-salary" name="salary" class="form-control"
                                           step="1" placeholder="薪资意向(单位：元)，选填"
                                           value="{{$data['intention']->salary}}">
                                @endif
                            </div>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                                取消
                            </button>
                            <button id="add-intention--button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认修改／新增
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

                        @forelse($data['education'] as $education)
                            <p>
                                <span>{{$education->school}}</span>
                                <span>{{$education->date}}入学</span>
                                <span>{{$education->major}}</span>
                                <span>
                                    @if($education->degree == 0)
                                        高中
                                    @elseif($education->degree == 1)
                                        本科
                                    @elseif($education->degree == 2)
                                        硕士及以上
                                    @endif
                                </span>
                                <i class="material-icons edu-delete education-item"
                                   data-content="{{$education->eduid}}">close</i>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                您还没有填写过教育经历，点击右上角进行填写
                            </div>
                        @endforelse
                    </div>

                    <div class="mdl-card__actions mdl-card--border education-panel-update">

                        <label for="school-name">学校</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="school" name="school" class="form-control"
                                       placeholder="不能为空">
                            </div>
                            <label class="error" for="school"></label>
                        </div>

                        <label for="education-degree">学历</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="education-degree" name="degree">
                                <option value="0">高中</option>
                                <option value="1" selected>本科</option>
                                <option value="2">硕士及以上</option>
                            </select>
                        </div>

                        <label for="subject-name">专业</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="subject-name" name="subject" class="form-control"
                                       placeholder="可以为空">
                            </div>
                        </div>

                        <label for="education-begin">入学时间</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" id="education-begin" name="education-begin" class="form-control"
                                       placeholder="不能为空">
                            </div>
                            <label class="error" for="education-begin"></label>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                                取消
                            </button>
                            <button id="add-education--button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认添加
                            </button>
                        </div>

                    </div>
                </div>

                <div class="mdl-card resume-child-card">

                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">电竞经历</h5>
                    </div>

                    <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="update-game">
                            <i class="material-icons">add</i>
                        </button>

                        <div class="mdl-tooltip" data-mdl-for="update-game">
                            添加
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border education-panel">
                        @forelse($data['game'] as $game)
                            <p>
                                <span>{{$game->ename}}</span>
                                <span>{{$game->level}}</span>
                                <span>{{$game->date}} 开始接触</span>

                                <i class="material-icons education-item game-delete"
                                   data-content="{{$game->egid}}">close</i>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                您还没有填写过电竞经历
                            </div>
                        @endforelse
                    </div>

                    <div class="mdl-card__actions mdl-card--border game-panel-update">

                        <label for="game-name">游戏名称</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="game-name" name="game-name" class="form-control"
                                       placeholder="不能为空">
                            </div>
                            <label class="error" for="game-name"></label>
                        </div>

                        <label for="game-level">段位／排名</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="game-level" name="game-level" class="form-control"
                                       placeholder="不能为空">
                            </div>
                            <label class="error" for="game-level"></label>
                        </div>

                        <label for="game-begin">接触时间</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" id="game-begin" name="game-begin" class="form-control"
                                       placeholder="不能为空">
                            </div>
                            <label class="error" for="game-begin"></label>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                                取消
                            </button>
                            <button id="add-game--button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认添加
                            </button>
                        </div>

                    </div>

                    {{--<div class="mdl-card__actions mdl-card--border egamexper-panel">--}}

                    {{--@forelse($data['egamexper'] as $egamexper)--}}
                    {{--<p>--}}
                    {{--<span>英雄联盟</span>--}}
                    {{--<span>2012</span>--}}
                    {{--<span>黄金</span>--}}
                    {{--<i class="material-icons egame-delete egamexper-item"--}}
                    {{--data-content="1">close</i>--}}
                    {{--</p>--}}
                    {{--@empty--}}
                    {{--<div class="mdl-card__supporting-text">--}}
                    {{--您还没有填写过电竞经历，点击右上角进行填写--}}
                    {{--</div>--}}
                    {{--@endforelse--}}
                    {{--</div>--}}
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
                        {{--|@|王者荣耀|至尊星耀|@|LOL|最强王者--}}
                        @if($data['resume']['skill'] == null)
                            <div class="mdl-card__supporting-text">
                                您还没有填写过技能特长，点击右上角进行填写
                            </div>
                        @else
                            @foreach($data['resume']['skill'] as $skill)
                                <span>
                                    <small class="skill-item">{{$skill}}</small>
                                    <i class="material-icons skill-item skill-delete">close</i>
                                </span>
                            @endforeach
                        @endif
                    </div>

                    <div class="mdl-card__actions mdl-card--border skill-panel-update">

                        <label for="skill-name">技能特长名称</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="skill-name" name="skill-name" class="form-control"
                                       placeholder="不能为空">
                            </div>
                            <label class="error" for="skill-name"></label>
                        </div>

                        <label for="skill-degree">级别</label>&nbsp;&nbsp;<small>例如：熟练度，分数，等级</small>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="skill-degree" name="skill-degree" class="form-control"
                                       placeholder="不能为空">
                            </div>
                            <label class="error" for="skill-degree"></label>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                                取消
                            </button>
                            <button id="add-skill--button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
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
                            <i class="material-icons">mode_edit</i>
                        </button>

                        <div class="mdl-tooltip" data-mdl-for="update-additional">
                            添加/修改
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border additional-panel">

                        @if($data['resume']->extra == null)
                            <div class="mdl-card__supporting-text">
                                您还没有填写过附加信息，点击右上角进行填写
                            </div>
                        @else
                            <p>{{$data['resume']->extra}}</p>
                        @endif
                    </div>

                    <div class="mdl-card__actions mdl-card--border additional-panel-update">

                        <label for="additional-content">添加附加内容</label>
                        <div class="form-group">
                            <div class="form-line">
                                @if($data['resume']->extra == null)
                                    <textarea rows="5" class="form-control" name="additional-content"
                                              id="additional-content"
                                              placeholder="还有什么是我们没想到的？在这里填写你想填写的任意内容"></textarea>
                                @else
                                    <textarea rows="5" class="form-control" name="additional-content"
                                              id="additional-content"
                                              placeholder="还有什么是我们没想到的？在这里填写你想填写的任意内容">{{$data['resume']->extra}}</textarea>
                                @endif
                            </div>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                                取消
                            </button>
                            <button id="additional-content--button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right">
                @include('components.baseUserProfile', ['isShowEditBtn'=>true, 'isShowFunctionPanel' => false, 'info' => $data["personInfo"][0]])

                <div class="button-panel left">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky"
                            to="/resume/preview?rid={{$data['rid']}}">
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
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script type="text/javascript">

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $intentionPanelUpdate = $(".intention-panel-update");
        $educationPanelUpdate = $(".education-panel-update");
        $gamePanelUpdate = $(".game-panel-update");
        $skillPanelUpdate = $(".skill-panel-update");
        $additionalPanelUpdate = $(".additional-panel-update");

        $intentionPanelUpdate.hide();
        $educationPanelUpdate.hide();
        $gamePanelUpdate.hide();
        $skillPanelUpdate.hide();
        $additionalPanelUpdate.hide();

        $("#update-intention").click(function () {
            $intentionPanelUpdate.fadeIn();
        });

        $("#update-education").click(function () {
            $educationPanelUpdate.fadeIn();
        });

        $("#update-game").click(function () {
            $gamePanelUpdate.fadeIn();
        });

        $("#update-skill").click(function () {
            $skillPanelUpdate.fadeIn();
        });

        $("#update-additional").click(function () {
            $additionalPanelUpdate.fadeIn();
        });

        $intentionPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $intentionPanelUpdate.hide();
        });

        $educationPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $educationPanelUpdate.hide();
        });

        $gamePanelUpdate.find(".button-panel>button.cancel").click(function () {
            $gamePanelUpdate.hide();
        });

        $skillPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $skillPanelUpdate.hide();
        });

        $additionalPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $additionalPanelUpdate.hide();
        });

        $("#resume-name--change").click(function () {

            var rid = $("input[name='rid']");
            var resumeName = $("input[name='resume-name']");

            if (resumeName.val() === "") {
                setError(resumeName, "resume-name", "不能为空");
                return;
            } else {
                removeError(resumeName, "resume-name");
            }

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('name', resumeName.val());

            $.ajax({
                url: '/resume/rename',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "简历名称已修改", result.msg, null);
                }
            })
        });

        $("#add-intention--button").click(function () {
            var rid = $("input[name='rid']");
            var place = $("select[name='place']");
            var industry = $("select[name='industry']");
            var occupation = $("select[name='occupation']");
            var type = $("select[name='type']");
            var salary = $("input[name='salary']");

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('work_nature', type.val());
            formData.append('occupation', occupation.val());
            formData.append('industry', industry.val());
            formData.append('region', place.val());


            if (salary.val() === '') {
                formData.append('salary', -1);
            } else {
                formData.append('salary', salary.val());
            }

            $.ajax({
                url: "/resume/addIntention",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);

                    checkResult(result.status, "求职意向已更新", result.msg, $intentionPanelUpdate);
                }
            })
        });

        $("#add-education--button").click(function () {

            var school = $("input[name='school']");
            var degree = $("select[name='degree']");
            var subject = $("input[name='subject']");
            var starDate = $("input[name='education-begin']");

            if (school.val() === "") {
                setError(school, "school", "不能为空");
                return;
            } else {
                removeError(school, "school");
            }

            if (starDate.val() === "") {
                setError(starDate, "education-begin", "不能为空");
                return;
            } else {
                removeError(starDate, "education-begin");
            }

            var formData = new FormData();
            formData.append('school', school.val());
            formData.append('date', starDate.val());
            formData.append('major', subject.val());
            formData.append('degree', degree.val());

            $.ajax({
                url: "/resume/addEducation",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "教育经历已添加", result.msg, $intentionPanelUpdate);
                }
            })
        });

        $("#add-game--button").click(function () {
            var gameName = $("input[name='game-name']");
            var gameLevel = $("input[name='game-level']");
            var gameBegin = $("input[name='game-begin']");

            if (gameName.val() === "") {
                setError(gameName, "game-name", "不能为空");
                return;
            } else {
                removeError(gameName, "game-name");
            }

            if (gameLevel.val() === "") {
                setError(gameLevel, "game-level", "不能为空");
                return;
            } else {
                removeError(gameLevel, "game-level");
            }

            if (gameBegin.val() === "") {
                setError(gameBegin, "game-begin", "不能为空");
                return;
            } else {
                removeError(gameBegin, "game-begin");
            }

            var formData = new FormData();
            formData.append('game', gameName.val());
            formData.append('level', gameLevel.val());
            formData.append('date', gameBegin.val());

            $.ajax({
                url: "/resume/addGame",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "电竞经历已添加", result.msg, $intentionPanelUpdate);
                }
            })
        });

        $("#add-skill--button").click(function () {
            var rid = $("input[name='rid']");
            var skillName = $("input[name='skill-name']");
            var skillDegree = $("input[name='skill-degree']");

            if (skillName.val() === "") {
                setError(skillName, "skill-name", "不能为空");
                return;
            } else {
                removeError(skillName, "skill-name");
            }

            if (skillDegree.val() === "") {
                setError(skillDegree, "skill-degree", "不能为空");
                return;
            } else {
                removeError(skillDegree, "skill-degree");
            }


            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('skill', skillName.val());
            formData.append('level', skillDegree.val());

            $.ajax({
                url: "/resume/addSkill",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "技能特长已添加", result.msg, $skillPanelUpdate);
                }
            })
        });

        $("#additional-content--button").click(function () {
            var rid = $("input[name='rid']");
            var extra = $("textarea[name='additional-content']");

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('extra', extra.val());

            $.ajax({
                url: '/resume/addExtra',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "附加内容已修改", result.msg, $additionalPanelUpdate);
                }
            })
        });

        $(".edu-delete").click(function () {
            var id = $(this).attr("data-content");
            swal({
                title: "确认",
                text: "确定删除该条教育经历吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/resume/deleteEducation?eduid=" + id,
                    type: "get",
                    success: function (data) {
                        swal(data['status'] === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });

        $(".game-delete").click(function () {
            var id = $(this).attr("data-content");
            swal({
                title: "确认",
                text: "确定删除该条电竞经历吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/resume/deleteGame?id=" + id,
                    type: "get",
                    success: function (data) {
                        swal(data['status'] === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });

        $(".skill-delete").click(function () {
            var $deleteBtn = $(this);

            swal({
                title: "确认",
                text: "确定删除该条技能特长吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                var formData = new FormData();
                formData.append('rid', $("input[name='rid']").val());
                formData.append('tag', $deleteBtn.siblings().html());

                $.ajax({
                    url: "/resume/deleteSkill",
                    type: "post",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        var result = JSON.parse(data);
                        swal(result.status === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });
    </script>
@endsection
