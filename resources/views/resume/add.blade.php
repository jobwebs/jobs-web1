@extends('layout.master')
@section('title', '添加简历')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('style/font-awesome.min.css')}}"/>

    <style>
        .resume-card {
            width: 99.52%;
            margin: 50px 0 20px 0;
            min-height: 0;
            position: relative;
        }

        .mdl-card__title i{
            color: tomato;
            margin-right: 2px;
            /*padding-bottom: 3px;*/
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
            /*margin-bottom: 12px;*/
        }

        .intention-panel p,
        .education-panel p,
        .work-panel p {
            padding: 5px 10px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p,
        .work-panel p {
             display: block !important;
             border: 1px solid #f5f5f5;
             margin: 16px;
             vertical-align: middle;
         }
        .project-panel p {
            padding: 5px 10px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
            display: block !important;
            border: 1px solid #f5f5f5;
            margin: 16px;
            vertical-align: middle;
        }

        .education-panel p:hover,
        .work-panel p:hover {
            background-color: #f5f5f5;
        }
        .project-panel p:hover {
            background-color: #f5f5f5;
        }


        .intention-panel p span {
            color: #737373;
            font-size: 14px;

        }

        .education-panel p span,
        .work-panel p span {
             margin-right: 10px;
             overflow: hidden;
             white-space: nowrap;
             display: inline-block;
             text-overflow: ellipsis;
         }
        .project-panel p span {
            margin-right: 10px;
            overflow: hidden;
            white-space: nowrap;
            display: inline-block;
            text-overflow: ellipsis;
        }
        .education-panel p span:first-child{
            /*min-width: 103px;*/
            /*width: 105px;*/
        }
        .education-panel p span:nth-child(2){
            /*width: 80px;*/
            /*max-width: 100px;*/
        }
        .education-panel p span:last-child{
            min-width: 103px;
            max-width: 200px;
        }
        .education-panel p i,
        .work-panel p i {
             float: right;
             cursor: pointer;
             font-size: 16px;
             color: #D32F2F;
             position: relative;
             top: 5px;
             border-radius: 16px;
             background: #f5f5f5;
         }
        .project-panel p i {
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
        .education-panel p i:hover,
        .work-panel p i:hover {
             background: #ebebeb;
             color: #F44336;
         }
        .project-panel p i:hover {
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
        .education-panel-edit,
        .work-panel-update,
        .project-panel-update,
        .skill-panel-update,
        .additional-panel-update,
        .game-panel-update {
            padding: 20px;
            background-color: #f5f5f5;
            z-index: auto;
        }

        /*------------------*/

        .form-group {
            display: inline-block;
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
        #indicatorContainer{
            position: absolute;
            right: 2rem;
            top: 1rem;
        }
        .blue-btn{
            height: 36px;
            padding:0 16px;
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
                <input style="display: none" id="completionvalue" value="{{$data['completion']}}" />
                <div class="prg-cont rad-prg" id="indicatorContainer"></div>
                
            </div>
            <div class="info-panel--left">

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-pencil fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">求职意向</h5>
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
                                    @foreach($data['province'] as $province)
                                        @if($data['intention']->region == $province->id)
                                            {{$province->name}}
                                            @break
                                        @endif
                                    @endforeach
                                    @foreach($data['city'] as $city)
                                        @if($data['intention']->region == $city->id)
                                            {{$city->name}}
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

                        {{--<label for="position-place">工作地区意向</label>--}}
                        {{--<div class="form-group">--}}
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            {{--<select class="form-control show-tick selectpicker" data-live-search="true"--}}
                                    {{--id="position-place" name="place">--}}
                                {{--@if($data['intention'] == null)--}}
                                    {{--<option value="-1">任意</option>--}}
                                    {{--@foreach($data['region'] as $region)--}}
                                        {{--<option value="{{$region->id}}">{{$region->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--@else--}}
                                    {{--@if($data['intention']->region == -1)--}}
                                        {{--<option value="-1" selected>任意</option>--}}
                                    {{--@else--}}
                                        {{--<option value="-1">任意</option>--}}
                                    {{--@endif--}}
                                    {{--@foreach($data['region'] as $region)--}}
                                        {{--@if($data['intention']->region == $region->id)--}}
                                            {{--<option value="{{$region->id}}" selected>{{$region->name}}</option>--}}
                                        {{--@else--}}
                                            {{--<option value="{{$region->id}}">{{$region->name}}</option>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        <label for="position-place">意向省份</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="position-place"
                                    data-live-search="true" name="place">
                                @if($data['intention'] == null)
                                    <option value="-1">任意</option>
                                    @foreach($data['province'] as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                @else
                                    @if($data['intention']->region == -1)
                                        <option value="-1" selected>任意</option>
                                    @else
                                        <option value="-1">任意</option>
                                    @endif
                                    {{$default_province =$data['intention']->region }}
                                    @foreach($data['province'] as $province)
                                            @foreach($data['city'] as $city)
                                                @if($data['intention']->region == $city->id)
                                                    <?php $default_province = $city->parent_id ?>
                                                    @break
                                                @endif
                                            @endforeach
                                        @if($default_province == $province->id)
                                            <option value="{{$province->id}}" selected>{{$province->name}}</option>
                                        @else
                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <label class="error" for="position-place"></label>
                        </div>
                        <label for="position-city" id="citylabel" style="display: none">意向城市</label>
                        @foreach($data['province'] as $province)
                            <div class="form-group" id="city-display{{$province->id}}"
                                 name="city-display" style="display: none">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-city"
                                        data-live-search="true" name="city{{$province->id}}">
                                    <option value="-1" selected >任意</option>
                                    @foreach($data['city'] as $city)
                                        @if($city->parent_id == $province->id)
                                            @if($data['intention']->region == $city->id)
                                                <option value="{{$city->id}}" selected>{{$city->name}}</option>
                                            @else
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                                <label class="error" for="position-city"></label>
                            </div>
                        @endforeach

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

                        <label for="position-occupation" id="occulabel" style="display:none">游戏意向</label>
                        @foreach($data['industry'] as $industry)
                            <div class="form-group" id="occupation-display{{$industry->id}}" name="occupation-display"
                                 style="display:none;">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-occupation"
                                        name="occupation{{$industry->id}}">

                                    @if($data['intention'] == null)
                                        <option value="-1">任意</option>
                                        @foreach($data['occupation'] as $occupation)
                                            @if($occupation->industry_id == $industry->id)
                                                <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                            @endif
                                        @endforeach

                                    @else
                                        @if($data['intention']->occupation == -1)
                                            <option value="-1" selected>任意</option>
                                        @else
                                            <option value="-1">任意</option>
                                        @endif
                                        @foreach($data['occupation'] as $occupation)
                                            @if($occupation->industry_id == $industry->id)
                                                @if($data['intention']->occupation == $occupation->id)
                                                    <option value="{{$occupation->id}}"
                                                            selected>{{$occupation->name}}</option>
                                                @else
                                                    <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endforeach

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
                        <i class="fa fa-graduation-cap fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">教育经历</h5>
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
                            <p id="education_info" name="education_info" data-content="{{$education->eduid}}">
                                <span>{{$education->school}}</span>
                                @if($education->gradu_date !=NULL)
                                    <span>{{str_replace('-','/',$education->date)}}-{{str_replace('-','/',$education->gradu_date)}}</span>
                                @else
                                    <span>{{$education->date}}- -</span>
                                @endif
                                <span>
                                    @if($education->degree == 0)
                                        高中
                                    @elseif($education->degree == 1)
                                        本科
                                    @elseif($education->degree == 2)
                                        硕士及以上
                                    @elseif($education->degree == 3)
                                        专科
                                    @endif
                                </span>
                                <span>{{$education->major}}</span>
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
                                <input type="text" id="eduid" name="eduid" class="form-control" value="-1" style="display: none">
                            </div>
                            <label class="error" for="school"></label>
                        </div>

                        <label for="education-degree">学历</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="education-degree" name="degree">
                                <option value="0">高中</option>
                                <option value="3">专科</option>
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

                            <div class="form-line input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input class="form-control" size="16" type="text" name="education-begin" value="" readonly placeholder="不能为空">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>

                            <label class="error" for="education-begin"></label>
                        </div>
                        <label for="education-end">毕业时间</label>
                        <div class="form-group">
                            <div class="form-line input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input size="16" type="text"  value="" readonly id="education-end" name="education-end" class="form-control"
                                       placeholder="如在读状态请勿填写">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            
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
                        <i class="fa fa-list fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">工作经历</h5>
                    </div>

                    <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="update-work">
                            <i class="material-icons">add</i>
                        </button>

                        <div class="mdl-tooltip" data-mdl-for="update-work">
                            添加
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border work-panel">

                        @forelse($data['work'] as $work)
                            <p id="work_info" name="work_info" data-content="{{$work->id}}">
                                <?php
                                $index = 1;
                                ?>
                                <span>
                                @foreach(explode('@', $work->work_time) as $time)
                                        @if($index == 1)
                                            {{str_replace('-','/',$time)}} --
                                        @elseif($index == 2)
                                            {{str_replace('-','/',$time)}}
                                        @endif
                                        <?php $index++ ?>
                                @endforeach
                                </span>
                                <span>{{$work->ename}}</span>
                                <span>{{$work->position}}</span>
                                <span style="width: 90%">{!! $work->describe !!}</span>

                                <i class="material-icons work-delete"
                                   data-content="{{$work->id}}">close</i>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                您还没有填写过工作经历，点击右上角进行填写
                            </div>
                        @endforelse
                    </div>

                    <div class="mdl-card__actions mdl-card--border work-panel-update">

                        <label for="company-name">公司名称</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="company-name" name="company-name" class="form-control"
                                       placeholder="不能为空">
                                <input type="text" id="workex-id" name="workex-id" class="form-control" style="display: none;" value="-1">
                            </div>
                            <label class="error" for="company-name"></label>
                        </div>

                        <label for="position">职位</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="position" name="position" class="form-control"
                                       placeholder="不能为空">
                            </div>
                            <label class="error" for="position"></label>
                        </div>

                        <label for="work-begin">入职时间</label>
                        <div class="form-group">
                            <div class="form-line input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input size="16" type="text"  value="" readonly id="work-begin" name="work-begin" class="form-control" placeholder="不能为空">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            
                            <label class="error" for="work-begin"></label>
                        </div>

                        <label for="work-end">离职时间</label>
                        <div class="form-group">
                            <div class="form-line input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input size="16" type="text"  value="" readonly id="work-end" name="work-end" class="form-control" placeholder="不能为空">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            
                            <label class="error" for="work-end"></label>
                        </div>

                        <label for="work-type">工作类型</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="work-type" name="work-type">
                                <option value="0" selected>全职</option>
                                <option value="1">实习</option>
                            </select>
                        </div>

                        <label for="work-desc">工作描述</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="5" class="form-control" name="work-desc" id="work-desc"
                                          placeholder="介绍你的工作内容..."></textarea>
                            </div>
                            <label class="error" for="work-desc"></label>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                                取消
                            </button>
                            <button id="add-work--button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认添加
                            </button>
                        </div>

                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-list fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">项目/赛事经历</h5>
                    </div>

                    <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="update-project">
                            <i class="material-icons">add</i>
                        </button>

                        <div class="mdl-tooltip" data-mdl-for="update-project">
                            添加
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border project-panel">

                        @forelse($data['project'] as $project)
                            <p id="project_info" name="project_info" data-content="{{$project->id}}">
                                <?php
                                $index = 1;
                                ?>
                                <span>
                                @foreach(explode('@', $project->project_time) as $time)
                                        @if($index == 1)
                                            {{str_replace('-','/',$time)}} --
                                        @elseif($index == 2)
                                            {{str_replace('-','/',$time)}}
                                        @endif
                                        <?php $index++ ?>
                                    @endforeach
                                </span>
                                <span>{{$project->project_name}}</span>
                                <span>{{$project->position}}</span>
                                <span style="width: 90%">{!! $project->describe !!}</span>

                                <i class="material-icons project-delete"
                                   data-content="{{$project->id}}">close</i>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                您还没有填写过项目经历，点击右上角进行填写
                            </div>
                        @endforelse
                    </div>

                    <div class="mdl-card__actions mdl-card--border project-panel-update">

                        <label for="project-name">项目/赛事</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="project-name" name="project-name" class="form-control"
                                       placeholder="不能为空">
                                <input type="text" id="projectex-id" name="projectex-id" class="form-control" style="display: none;" value="-1">
                            </div>
                            <label class="error" for="project-name"></label>
                        </div>

                        <label for="project-position">项目职责</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="project-position" name="project-position" class="form-control"
                                       placeholder="不能为空">
                            </div>
                            <label class="error" for="project-position"></label>
                        </div>

                        <label for="project-begin">开始时间</label>
                        <div class="form-group">
                            <div class="form-line input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input size="16" type="text"  value="" readonly id="project-begin" name="project-begin" class="form-control" placeholder="不能为空">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                           
                            <label class="error" for="project-begin"></label>
                        </div>

                        <label for="project-end">截止时间</label>
                        <div class="form-group">
                            <div class="form-line input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input size="16" type="text"  value="" readonly id="project-end" name="project-end" class="form-control" placeholder="不能为空">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                           
                            <label class="error" for="project-end"></label>
                        </div>

                        <label for="project-desc">项目描述</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="5" class="form-control" name="project-desc" id="project-desc"
                                          placeholder="介绍你的项目情况..."></textarea>
                            </div>
                            <label class="error" for="project-desc"></label>
                        </div>

                        <div class="button-panel">
                            <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                                取消
                            </button>
                            <button id="add-project--button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认添加
                            </button>
                        </div>

                    </div>
                </div>

                <div class="mdl-card resume-child-card">

                    <div class="mdl-card__title">
                        <i class="fa fa-gamepad fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">电竞经历</h5>
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
                            <p id="egame_info" name="egame_info" data-content="{{$game->egid}}">
                                <span>{{$game->ename}}</span>
                                <span>{{$game->level}}</span>
                                <span>{{str_replace('-','/',$game->date)}} 开始接触</span>
                                @if($game->extra != null && $game->extra != "")
                                    <span style="width: 90%">{!! $game->extra !!}</span>
                                @endif

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
                            <input id="egame-id" name="egame-id" style="display: none;" value="-1">
                            <select class="form-control show-tick selectpicker" id="egame-name"
                                     name="egamename">
                                @if(emptyArray($data['egame']))
                                    <option value="-1">暂无游戏</option>
                                @endif
                                @foreach($data['egame'] as $egame)
                                <option value="{{$egame->id}}">{{$egame->name}}</option>
                                 @endforeach
                             </select>
                            <label class="error" for="game-name"></label>
                        </div>

                        <label for="game-level" id="egrade-label" style="display: none;">段位／排名</label>
                        @foreach($data['egame'] as $egame)
                            <div class="form-group" id="egrade-display{{$egame->id}}" name = "egrade-display" style="display: none;" >
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" name="egamelevel{{$egame->id}}">
                                    @foreach($data['egrade'] as $egrade)
                                       @if($egrade->egame_id == $egame->id)
                                            <option value="{{$egrade->id}}">{{$egrade->name}}</option>
                                       @endif
                                       @endforeach
                                </select>
                                <label class="error" for="game-level"></label>
                            </div>
                        @endforeach
                        <label for="game-begin">接触时间</label>
                        <div class="form-group">
                            <div class="form-line input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input size="16" type="text"  value="" readonly id="game-begin" name="game-begin" class="form-control"
                                       placeholder="从何时开始接触这款游戏">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                           
                            <label class="error" for="game-begin"></label>
                        </div>
                        <label for="game-desc">备注</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="5" class="form-control" name="game-desc" id="game-desc"
                                          placeholder="备注你的服务大区、游戏ID、KDA、组排分等信息"></textarea>
                            </div>
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
                        <i class="fa fa-tags fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">技能特长</h5>
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
                                    <small class="skill-item" style="font-size:120%">{{$skill}}</small>
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
                        <i class="fa fa-plus-square fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">附加信息</h5>
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
                    <button class="btn btn-primary blue-btn"
                            to="/resume/preview?rid={{$data['rid']}}">
                        预览简历
                    </button>
                    <button class="btn btn-primary blue-btn" data-toggle="modal" data-target="#resume_explain">
                        简历指导
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
    <script src="{{asset('plugins/bootstrap-datapicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datapicker/locales/bootstrap-datetimepicker.zh-CN.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('plugins/jquery/radialindicator.min.js')}}"></script>


    <script type="text/javascript">
        $(function(){
            var indexid = $("select[name='place']");
            var id = "#city-display" + indexid.val();
            var city_len = $("select[name='city"+ indexid.val() +"'] option").length;
            if(city_len >1){
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "block");
                $(id).css("display", "block");
            }else{
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "none");
            }
        });
        $('.form_date').datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $intentionPanelUpdate = $(".intention-panel-update");
        $educationPanelUpdate = $(".education-panel-update");
        $workPanelUpdate = $(".work-panel-update");
        $projectPanelUpdate = $(".project-panel-update");
        $gamePanelUpdate = $(".game-panel-update");
        $skillPanelUpdate = $(".skill-panel-update");
        $additionalPanelUpdate = $(".additional-panel-update");

        $intentionPanelUpdate.hide();
        $educationPanelUpdate.hide();
        $workPanelUpdate.hide();
        $projectPanelUpdate.hide();
        $gamePanelUpdate.hide();
        $skillPanelUpdate.hide();
        $additionalPanelUpdate.hide();

        $("#update-intention").click(function () {
            $intentionPanelUpdate.fadeIn();
        });

        $("#update-education").click(function () {
            $("input[id=school]").val("");//设置学校值
            $("input[id=eduid]").val(-1);//设置教育经历id
            $("input[id=subject-name]").val("");//设置专业信息
            $("input[id=education-begin]").val("");//设置入学时间
            $("input[id=education-end]").val("");//设置毕业时间
            $educationPanelUpdate.fadeIn();
        });

        $("#update-work").click(function () {
            $("input[id=company-name]").val("");//设置公司名称
            $("input[id=workex-id]").val(-1);//设置公司名称
            $("input[id=position]").val("");//设置职位
            $("input[id=work-begin]").val("");//设置入职时间
            $("input[id=work-end]").val("");//设置离职时间
            $("textarea[id=work-desc]").val("");//设置离职时间
            $workPanelUpdate.fadeIn();
        });
        $("#update-project").click(function () {
            $("input[id=project-name]").val("");//设置项目名称
            $("input[id=projectex-id]").val(-1);//设置项目id
            $("input[id=project-position]").val("");//设置职位
            $("input[id=project-begin]").val("");//设置入职时间
            $("input[id=project-end]").val("");//设置离职时间
            $("textarea[id=project-desc]").val("");//设置项目描述
            $projectPanelUpdate.fadeIn();
        });

        $("#update-game").click(function () {
            $("input[id=egame-id]").val(-1);//设置游戏经历id
            $("input[id=game-begin]").val("");
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

        $workPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $workPanelUpdate.hide();
        });
        $projectPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $projectPanelUpdate.hide();
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
        //修改已填写的教育经历
        $editEducation = $("p[name=education_info]");
        //修改工作经历
        $editWork = $("p[name=work_info]");
        //修改项目经历
        $editProject = $("p[name=project_info]");
        //修改电竞经历
        $editEgame = $("p[name=egame_info]");

        $editEducation .click(function (){
            $eduid = $(this).attr("data-content");
            var formData = new FormData();
            formData.append('eduid', $eduid);
            $.ajax({
                url: '/resume/geteduinfo',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //调用函数打开编辑框
                    showeditEdu(result);
//                    console.log(result);
                }
            })

        });
        $editWork .click(function (){
            $id = $(this).attr("data-content");
            var formData = new FormData();
            formData.append('id', $id);
            $.ajax({
                url: '/resume/getworkinfo',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //调用函数打开编辑框
                    showeditWork(result);
//                    console.log(result);
                }
            })

        });
        $editProject .click(function (){
            $id = $(this).attr("data-content");
            var formData = new FormData();
            formData.append('id', $id);
            $.ajax({
                url: '/resume/getprojectinfo',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //调用函数打开编辑框
                    showeditProject(result);
//                    console.log(result);
                }
            })

        });
        $editEgame .click(function (){
            $egid = $(this).attr("data-content");
            var formData = new FormData();
            formData.append('egid', $egid);
            $.ajax({
                url: '/resume/getegameinfo',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //调用函数打开编辑框
                    showeditEgame(result);
//                    console.log(result);
                }
            })

        });
        function showeditEdu(data) {
            $("input[id=school]").val(data.school);//设置学校值
            $("input[id=eduid]").val(data.eduid);//设置教育经历id
//            $("select[id=education-degree]").find("option:contains(3)").attr("selected",true);
//            $("select[id=education-degree]").val(data.degree);//设置学位信息
            $("input[id=subject-name]").val(data.major);//设置专业信息
            $("input[id=education-begin]").val(data.date);//设置入学时间
            $("input[id=education-end]").val(data.gradu_date);//设置毕业时间
            $educationPanelUpdate.fadeIn();

        }
        function showeditWork(data) {
            $("input[id=company-name]").val(data.ename);//设置公司名称
            $("input[id=workex-id]").val(data.id);//设置公司名称
            $("input[id=position]").val(data.position);//设置职位
            $("input[id=work-begin]").val(data.work_time.split('@')[0]);//设置入职时间
            $("input[id=work-end]").val(data.work_time.split('@')[1]);//设置离职时间
            if(data.describe){
                data.describe = data.describe.replace(/<\/br>/g, "\r\n");
            }
            $("textarea[id=work-desc]").val(data.describe);
            $workPanelUpdate.fadeIn();

        }
        function showeditProject(data) {
            $("input[id=project-name]").val(data.project_name);//设置项目名称
            $("input[id=projectex-id]").val(data.id);//设置项目id
            $("input[id=project-position]").val(data.position);//设置职位
            $("input[id=project-begin]").val(data.project_time.split('@')[0]);//设置开始时间
            $("input[id=project-end]").val(data.project_time.split('@')[1]);//设置结束时间
            if(data.describe){
                data.describe = data.describe.replace(/<\/br>/g, "\r\n");
            }
            $("textarea[id=project-desc]").val(data.describe);
            $projectPanelUpdate.fadeIn();

        }
        function showeditEgame(data) {
            $("input[id=egame-id]").val(data.egid);//设置游戏经历id
            $("input[id=game-begin]").val(data.date);
            if(data.extra){
                data.extra = data.extra.replace(/<\/br>/g, "\r\n");
            }
            $("textarea[id=game-desc]").val(data.extra);//设置备注信息
            $gamePanelUpdate.fadeIn();

        }
        //自动关联行业和职业信息
        $('#position-industry').change(function () {
//            document.getElementById("ddlResourceType").options.add(new Option(text,value));
            var indexid = $("select[name='industry']").val();
            var id = "#occupation-display" + indexid;
            $('div[name=occupation-display]').css("display", "none");
            $("#occulabel").css("display", "block");
            $(id).css("display", "block");
//            $(id).style.display = block;
        });
        //自动关联游戏名称及游戏段位
        $('#egame-name').change(function () {
            var indexid = $("select[name='egamename']").val();
            var id = "#egrade-display" + indexid;
            $('div[name=egrade-display]').css("display", "none");
            $("#egrade-label").css("display", "block");
            $(id).css("display", "block");
            //            $(id).style.display = block;
        });
        //自动关联省份和城市
        $('#position-place').change(function () {
            var indexid = $("select[name='place']");
            var id = "#city-display" + indexid.val();
            var city_len = $("select[name='city"+ indexid.val() +"'] option").length;
            if(city_len >1){
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "block");
                $(id).css("display", "block");
            }else{
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "none");
            }
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
//            var place = $("select[name='place']");
            var province = $("select[name='place']");
            var city = $("select[name='city"+ province.val() +"']");
            var city_len = $("select[name='city"+ province.val() +"'] option").length;
            var industry = $("select[name='industry']");
//            var occupation = $("select[name='occupation']");
            var occupation = $("select[name='occupation" + industry.val() + "']");
            var type = $("select[name='type']");
            var salary = $("input[name='salary']");

            if (province.val() != "-1" && city.val() === "-1" && city_len >1) {
                setError(city, "position-city", "请选择工作城市");
                return;
            } else {
                removeError(city, "position-city");
            }

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('work_nature', type.val());
            formData.append('industry', industry.val());
            if(industry.val() == -1){
                formData.append('occupation', -1);
            }else
                formData.append('occupation', occupation.val());

            if(city_len >1){//省份有城市--非直辖市
                formData.append("region", city.val());
            }else{
                formData.append("region", province.val());
            }
//            formData.append('region', place.val());


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

        $("#add-work--button").click(function () {
            var companyName = $("input[name='company-name']");
            var workex_id = $("input[name='workex-id']");
            var positionName = $("input[name='position']");
            var beginDate = $("input[name='work-begin']");
            var endDate = $("input[name='work-end']");
            var type = $("select[name='work-type']");
            var workDesc_raw = $("textarea[name='work-desc']");
            var workDesc = workDesc_raw.val().replace(/\r\n/g, '</br>');
            workDesc = workDesc.replace(/\n/g, '</br>');
//            workDesc = workDesc.replace(/\s/g, '</br>');

            if (companyName.val() === "") {
                setError(companyName, "company-name", "不能为空");
                return;
            } else {
                removeError(companyName, "company-name");
            }

            if (positionName.val() === "") {
                setError(positionName, "position", "不能为空");
                return;
            } else {
                removeError(positionName, "position");
            }

            if (beginDate.val() === "") {
                setError(beginDate, "work-begin", "不能为空");
                return;
            } else {
                removeError(beginDate, "work-begin");
            }

            if (endDate.val() === "") {
                setError(endDate, "work-end", "不能为空");
                return;
            } else {
                removeError(endDate, "work-end");
            }
            if (workDesc.length >500) {
                setError(workDesc_raw, "work-desc", "最大字数不能超过500字");
                return;
            } else {
                removeError(workDesc_raw, "work-desc");
            }

            var formData = new FormData();
            if(workex_id.val() != -1){
                formData.append('id',workex_id.val());
            }
            formData.append('ename', companyName.val());
            formData.append('position', positionName.val());
            formData.append('type', type.val());
            formData.append('describe', workDesc);
            formData.append('work_time', beginDate.val() + "@" + endDate.val());

            $.ajax({
                url: "/resume/addWorkexp",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "工作经历已添加", result.msg, null);
                }
            })
        });

        $("#add-project--button").click(function () {
            var projectName = $("input[name='project-name']");
            var projectex_id = $("input[name='projectex-id']");
            var positionName = $("input[name='project-position']");
            var beginDate = $("input[name='project-begin']");
            var endDate = $("input[name='project-end']");
            var projectDesc_raw = $("textarea[name='project-desc']");
            var projectDesc = projectDesc_raw.val().replace(/\r\n/g, '</br>');
            projectDesc = projectDesc.replace(/\n/g, '</br>');

            if (projectName.val() === "") {
                setError(projectName, "project-name", "不能为空");
                return;
            } else {
                removeError(projectName, "project-name");
            }

            if (positionName.val() === "") {
                setError(positionName, "project-position", "不能为空");
                return;
            } else {
                removeError(positionName, "project-position");
            }

            if (beginDate.val() === "") {
                setError(beginDate, "project-begin", "不能为空");
                return;
            } else {
                removeError(beginDate, "project-begin");
            }

            if (endDate.val() === "") {
                setError(endDate, "project-end", "不能为空");
                return;
            } else {
                removeError(endDate, "project-end");
            }
            if (projectDesc.length >500) {
                setError(projectDesc_raw, "project-desc", "最大字数不能超过500字");
                return;
            } else {
                removeError(projectDesc_raw, "project-desc");
            }

            var formData = new FormData();
            if(projectex_id.val() != -1){
                formData.append('id',projectex_id.val());
            }
            formData.append('project_name', projectName.val());
            formData.append('position', positionName.val());
            formData.append('describe', projectDesc);
            formData.append('project_time', beginDate.val() + "@" + endDate.val());

            $.ajax({
                url: "/resume/addProjectexp",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "项目经历已添加", result.msg, null);
                }
            })
        });

        $("#add-education--button").click(function () {

            var school = $("input[name='school']");
            var eduid = $("input[name='eduid']");
            var degree = $("select[name='degree']");
            var subject = $("input[name='subject']");
            var starDate = $("input[name='education-begin']");
            var endDate = $("input[name='education-end']");

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
            if(eduid.val()!=-1){
                formData.append('eduid', eduid.val());
            }
            formData.append('school', school.val());
            formData.append('date', starDate.val());
            formData.append('gradu_date', endDate.val());
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
                    checkResult(result.status, "教育经历已添加", result.msg, $educationPanelUpdate);
                }
            })
        });

        $("#add-game--button").click(function () {
            var gameBegin = $("input[name='game-begin']");
            var egame_id = $("input[name='egame-id']");
            var egameName = $("select[name='egamename']");
            var egrade  = $("select[name='egamelevel" + egameName.val() + "']");
            var gameDesc_raw = $("textarea[name='game-desc']");
            var gameDesc = gameDesc_raw.val().replace(/\r\n/g, '</br>');
            gameDesc = gameDesc.replace(/\n/g, '</br>');
//            gameDesc = gameDesc.replace(/\s/g, '</br>');


            if (egameName.val() === "" ||egameName.val() == "-1") {
                setError(egameName, "game-name", "不能为空");
                return;
            } else {
                removeError(egameName, "game-name");
            }

            if (egrade.val() === "") {
                setError(egrade, "game-level", "不能为空");
                return;
            } else {
                removeError(egrade, "game-level");
            }

            if (gameBegin.val() === "") {
                setError(gameBegin, "game-begin", "不能为空");
                return;
            } else {
                removeError(gameBegin, "game-begin");
            }

            var formData = new FormData();
            if(egame_id.val() != -1){
                formData.append('egid', egame_id.val());
            }
            formData.append('game', egameName.val());
            formData.append('level', egrade.val());
            formData.append('date', gameBegin.val());
            formData.append('extra', gameDesc);

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

        $(".work-delete").click(function () {
            var id = $(this).attr("data-content");
            swal({
                title: "确认",
                text: "确定删除该条工作经历吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/resume/deleteWorkexp?id=" + id,
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

        $(".project-delete").click(function () {
            var id = $(this).attr("data-content");
            swal({
                title: "确认",
                text: "确定删除该条项目经历吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/resume/deleteProjectexp?id=" + id,
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
                    $('#indicatorContainer').radialIndicator({
                        barColor: {
                            0: '#FF0000',
                            33: '#FFFF00',
                            66: '#0066FF',
                            100: '#33CC33'
                        },
                        percentage: true,
                        initValue: $('#completionvalue').val()
                    });
    </script>
@endsection
