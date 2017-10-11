@extends('layout.master')
@section('title', '预览简历')

@section('custom-style')
    <style>
        .resume-card {
            width: 100%;
            margin: 50px 0 20px 0;
            min-height: 0;
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
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p {
            display: block !important;
        }

        .intention-panel p span {
            color: #737373;
            font-size: 14px;
        }

        .education-panel p span {
            margin-right: 10px;
        }

        .skill-panel span {
            display: inline-block;
            background: #03A9F4;
            padding: 8px 25px 8px 12px;
            margin: 6px;
            font-size: 13px;
            font-weight: 300;
            color: #ffffff;
            border-radius: 3px;
            position: relative;
        }

        .additional-panel p {
            padding: 0 8px;
        }

        .mdl-card__supporting-text a {
            cursor: pointer;
            color: #232323;
        }

        .mdl-card__supporting-text a:hover {
            text-decoration: underline;
        }

        .base-info__title {
            width: 800px !important;
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
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                            to="/resume/add?rid={{$data['rid']}}">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    <h5 class="mdl-card__title-text" style="margin-left: 16px;">预览简历</h5>
                </div>

                <div class="mdl-card__supporting-text" style="margin-left: 48px;">
                    以下简历为效果预览
                </div>
            </div>


            <div class="mdl-card resume-child-card base-info--user" style="padding-bottom: 20px;">

                @if(count($data['personInfo']) != 0)
                    <div class="base-info__header">
                        <img class="img-circle info-head-img"
                             src="{{$data['personInfo'][0]->photo or asset('images/avatar.png')}}" width="70px"
                             height="70px">

                        <div class="base-info__title">
                            <p>{{$data['personInfo'][0]->pname or "姓名未填写"}}</p>
                            <p><span>
                                    @if($data['personInfo'][0]->sex == null)
                                        性别未填写
                                    @elseif($data['personInfo'][0]->sex == 1)
                                        男
                                    @elseif($data['personInfo'][0]->sex == 0)
                                        女
                                    @endif
                                </span> |
                                <span>{{$data['personInfo'][0]->birthday or "生日未填写"}}</span> |
                                <span>
                                    @if($data['personInfo'][0]->residence == null)
                                        居住地未填写
                                    @else
                                        {{$data['personInfo'][0]->residence}}
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-card__title">
                            <h6 class="mdl-card__title-text">自我评价</h6>
                        </div>

                        <div class="mdl-card__supporting-text">
                            {{$data['personInfo'][0]->self_evalu or "自我评价未填写"}}
                        </div>
                    </div>

                    <ul class="mdl-list base-info__contact">
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">phone</i>
                                {{$data['personInfo'][0]->tel or "手机号未填写"}}
                            </span>
                        </li>
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">email</i>
                                {{$data['personInfo'][0]->mail or "邮箱未填写"}}
                            </span>
                        </li>
                    </ul>
                @else
                    <div class="mdl-card__supporting-text"
                         style="padding: 24px 0 8px 24px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                        <p>个人资料暂未填写，资料填写后这里将显示您的基本信息</p>
                    </div>
                @endif
            </div>

            <div class="mdl-card resume-child-card">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">求职意向</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border intention-panel">

                    @if($data['intention'] == null)
                        <div class="mdl-card__supporting-text">
                            您还没有填写过求职意向
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
            </div>

            <div class="mdl-card resume-child-card">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">教育经历</h5>
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
                        </p>
                    @empty
                        <div class="mdl-card__supporting-text">
                            您还没有填写过教育经历
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mdl-card resume-child-card">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">电竞经历</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border education-panel">
                    @forelse($data['game'] as $game)
                        <p>
                            <span>{{$game->ename}}</span>
                            <span>{{$game->level}}</span>
                            <span>{{$game->date}} 开始接触</span>
                        </p>
                    @empty
                        <div class="mdl-card__supporting-text">
                            您还没有填写过电竞经历
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mdl-card resume-child-card">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">技能特长</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border skill-panel">
                    {{--|@|王者荣耀|至尊星耀|@|LOL|最强王者--}}
                    @if($data['resume']['skill'] == null)
                        <div class="mdl-card__supporting-text">
                            您还没有填写过技能特长
                        </div>
                    @else
                        @foreach($data['resume']['skill'] as $skill)
                            <span>
                                    <small class="skill-item">{{$skill}}</small>
                                </span>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="mdl-card resume-child-card">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">附加信息</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border additional-panel">

                    @if($data['resume']->extra == null)
                        <div class="mdl-card__supporting-text">
                            您还没有填写过附加信息
                        </div>
                    @else
                        <p>{{$data['resume']->extra}}</p>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection

@section('custom-script')

@endsection
