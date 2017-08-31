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
            color: var(--primary-color);
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p {
            display: block!important;
        }

        .intention-panel p span {
            color: var(--text-color-secondary);
            font-size: 14px;
        }

        .education-panel p span {
            margin-right: 10px;
        }

        .skill-panel span {
            display: inline-block;
            background: var(--blue-sky);
            padding: 8px 25px 8px 12px;
            margin: 6px;
            font-size: 13px;
            font-weight: 300;
            color: var(--snow);
            border-radius: 3px;
            position: relative;
        }

        .additional-panel p {
            padding: 0 8px;
        }

        .mdl-card__supporting-text a {
            cursor: pointer;
            color: var(--text-color-primary);
        }

        .mdl-card__supporting-text a:hover{
            text-decoration: underline;
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
                    <h5 class="mdl-card__title-text">预览简历</h5>
                </div>

                <div class="mdl-card__supporting-text">
                    以下简历为效果预览，不满意？<a to="/resume/add">返回修改</a>
                </div>
            </div>



                <div class="mdl-card resume-child-card base-info--user">

                    <div class="base-info__header">
                        <img class="img-circle info-head-img" src="{{asset('images/avatar.png')}}" width="70px"
                             height="70px">

                        <div class="base-info__title">
                            <p>Jobs</p>
                            <p><span>男</span> | <span>23岁</span> | <span>现居吉尔吉斯斯坦</span></p>
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-card__title">
                            <h6 class="mdl-card__title-text">自我评价</h6>
                        </div>

                        <div class="mdl-card__supporting-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Mauris sagittis pellentesque lacus eleifend lacinia...
                        </div>
                    </div>

                    <ul class="mdl-list base-info__contact">
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">phone</i>
                                13267452667
                            </span>
                        </li>
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">email</i>
                                example@example.com
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">求职意向</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border intention-panel">
                        <p>地区：<span>成都</span></p>
                        <p>行业分类：<span>电竞直播</span></p>
                        <p>工作类型：<span>全职</span></p>
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">教育经历</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border education-panel">
                        <p><span>四川大学</span><span>2016-9入学</span><span>计算机技术</span><span>硕士</span></p>
                        <p><span>家里蹲大学</span><span>2012-9入学</span><span>计算机科学与技术</span><span>本科</span></p>
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">技能特长</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border skill-panel">
                        <span>王者荣耀|至尊星耀</span>
                        <span>LOL|超凡大师</span>
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">附加信息</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border additional-panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sagittis pellentesque lacus
                            eleifend lacinia...</p>
                    </div>
                </div>


        </div>
    </div>
@endsection

@section('custom-script')

@endsection
