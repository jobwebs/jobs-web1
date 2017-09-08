@extends('layout.master')
@section('title', '职位搜索')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

    <style>
        .position-search--card {
            width: 100%;
            min-height: 0;
        }

        ul {
            margin-bottom: 0;
        }

        .position-search--card ul li {
            display: block;
            padding: 10px 16px;
            margin: 0;
            vertical-align: middle;
            border-bottom: 1px solid var(--divider-light);
        }

        ul.filter-panel li label {
            padding-right: 16px;
            vertical-align: top;
        }

        ul.filter-panel .span-holder {
            display: inline-block;
            width: 924px;
        }

        ul.filter-panel li span.selected {
            background-color: var(--blue-sky);
            color: var(--snow);
        }

        ul.filter-panel li span {
            padding: 4px 6px;
            cursor: pointer;
            word-break: keep-all;
            margin: 0 4px;
        }

        .search-position {
            background-color: var(--divider-light);
        }

        .search-position .form-line {
            width: 250px;
            display: inline-block;
            border-bottom: 1px solid var(--divider);
            margin-right: 24px;
        }

        .search-position .form-line input {
            display: inline-block;
            width: 200px;
            background-color: var(--divider-light);
        }

        .search-position .sort-position {
            width: 400px;
            margin-bottom: 0;
            display: inline-block;
            vertical-align: middle;
        }

        .sort-position span.sort-item {
            margin: 0 8px;
            cursor: pointer;
        }

        .sort-position span.sort-item:hover {
            text-decoration: underline;
        }

        .sort-position span:first-child {
            margin-right: 16px;
        }

        .sort-item.active {
            color: var(--blue-sky-dark);
        }

        .sort-item i {
            vertical-align: middle;
        }

        .search-result {
            text-align: center;
        }

        .position-card {
            width: 330px;
            min-height: 0;
            margin: 0 4px 24px 4px;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
            text-align: left;
            vertical-align: top;
        }

        .position-card:hover {
            cursor: pointer;
            box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => true])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 3])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">

            <div class="position-search--card mdl-card">
                <ul class="filter-panel">
                    <li>
                        <label>行业:</label>
                        <div class="span-holder">
                            <span class="selected">全部</span>
                            <span>行业2</span>
                            <span>行业3</span>
                            <span>行业4</span>
                        </div>
                    </li>

                    <li>
                        <label>地区:</label>
                        <div class="span-holder">
                            <span class="selected">全部</span>
                            @foreach([1,2,3] as $item)
                                <span>北京</span>
                                <span>上海</span>
                                <span>广州</span>
                                <span>杭州</span>
                                <span>深圳</span>
                                <span>成都</span>
                                <span>重庆</span>
                                <span>厦门</span>
                            @endforeach
                        </div>
                    </li>

                    <li>
                        <label>薪酬:</label>
                        <span class="selected">不限</span>
                        <span>3K以下</span>
                        <span>3K-5K</span>
                        <span>5K-10K</span>
                        <span>10K-15K</span>
                        <span>15K-20K</span>
                        <span>20K-25K</span>
                        <span>25K-50K</span>
                        <span>50K以上</span>
                    </li>

                    <li>
                        <label>类型:</label>
                        <span class="selected">不限</span>
                        <span>全职</span>
                        <span>兼职</span>
                    </li>
                </ul>

            </div>

            <div class="form-group search-position">
                <div class="form-line">
                    <input type="text" id="name" name="name" class="form-control"
                           placeholder="输入职位名称／描述进行搜索">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="publish-position">
                        <i class="material-icons">search</i>
                    </button>
                </div>

                <p class="sort-position">
                    <span><b>排序</b>:</span>
                    <span class="sort-item" data-content="0" id="sort-hotness">热度<i class="material-icons"></i></span>
                    <span class="sort-item" data-content="0" id="sort-salary">薪水<i class="material-icons"></i></span>
                    <span class="sort-item" data-content="0" id="sort-publish--time">发布时间<i class="material-icons"></i></span>
                </p>
            </div>

            <p>共搜索到{{count($data['position'])}}个结果</p>

            <div class="search-result">

                @foreach($data['position'] as $position)
                    <div class="mdl-card mdl-shadow--2dp info-card position-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">
                                @if(empty($position->title))
                                    没有填写职位名称
                                @else
                                    {{$position->title}}
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
                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect button-link position-view"
                                        data-content="{{$position->pid}}">
                                    查看详情
                                </button>
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    投简历
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                <p>没有更多了</p>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>

    <script type="text/javascript">
        $(".sort-item").click(function () {
            if ($(this).attr('data-content') === '0') {
                $(this).attr('data-content', 1);
                $(this).find('i').html("keyboard_arrow_down");

                if (!$(this).hasClass('active'))
                    $(this).addClass('active');
            } else if ($(this).attr('data-content') === '1') {
                $(this).attr('data-content', 2);
                $(this).find('i').html("keyboard_arrow_up");
                if (!$(this).hasClass('active'))
                    $(this).addClass('active');
            } else {
                $(this).attr('data-content', 0);
                $(this).find('i').html("");
                if ($(this).hasClass('active'))
                    $(this).removeClass('active');
            }

            switch ($(this).prop('id')) {
                case "sort-hotness":
                    sortByHotness($(this).attr('data-content'));
                    break;
                case "sort-salary":
                    sortBySalary($(this).attr('data-content'));
                    break;
                case "sort-publish--time":
                    sortByPublishTime($(this).attr('data-content'));
                    break;
            }
        });

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        /**
         * 排序方法3个，分别对结果按热度，薪水，发布日期排序（升序，降序）
         *
         * todo 2017-09-06
         */

        function sortByHotness($upOrDown) {
            alert($upOrDown);
        }

        function sortBySalary($upOrDown) {
            alert($upOrDown);
        }

        function sortByPublishTime($upOrDown) {
            alert($upOrDown);
        }

        //....

        $(".position-view").click(function () {
            self.location = '/position/detail?pid=' + $(this).attr("data-content");
        })
    </script>
@endsection
