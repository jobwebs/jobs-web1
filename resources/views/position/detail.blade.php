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
                        <h5 class="mdl-card__title-text">职位名称</h5>
                    </div>

                    <div class="mdl-card__menu">
                        <label id="apply-count-icon"><i class="material-icons">assignment</i></label>
                        <label class="count">12</label>

                        <label id="view-count-icon"><i class="material-icons">visibility</i></label>
                        <label class="count">99+</label>

                        <div class="mdl-tooltip" data-mdl-for="apply-count-icon">
                            申请人数
                        </div>

                        <div class="mdl-tooltip" data-mdl-for="view-count-icon">
                            浏览次数
                        </div>
                    </div>

                    <div class="mdl-card__supporting-text">
                        <label>发布时间: <span>2017-8-20</span></label>
                        <label>标签: <span>Tag 1</span><span>Tag 2</span><span>Tag 3</span></label>
                    </div>

                    <div class="mdl-card__actions mdl-card--border base-info--panel">
                        <label><i class="material-icons">attach_money</i> <span>月薪 9000元/月</span></label>
                        <label><i class="material-icons">location_on</i> <span>工作地点 成都</span></label>
                        <label><i class="material-icons">person_add</i> <span>招聘 5 人</span></label>
                        <label>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                投简历
                            </button>
                        </label>
                    </div>

                    <div class="mdl-card__supporting-text">
                        <p>
                            <b>介绍: </b>
                            Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                            tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam
                            sit
                            amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec
                            sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.
                        </p>

                        <p><b>要求: </b></p>
                        <ul>
                            @foreach([1, 2, 3, 4, 5] as $requirement)
                                <li>该职位的要求，#<?=$requirement ?></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">
                @include('components.baseEnterpriseProfile', ['isShowMenu'=>false, 'isShowFunctionPanel' => false])


                <h6>公司其他职位</h6>

                @foreach([1,2] as $position)
                    <div class="mdl-card mdl-shadow--2dp info-card position-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">职位名称</h5>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <b>介绍: </b>
                            <span>
                                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                            tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam
                            sit
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
                @endforeach

                <div class="mdl-card__supporting-text">
                    该公司没有其他职位
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')

@endsection
