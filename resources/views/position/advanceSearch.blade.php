@extends('layout.master')
@section('title', '职位搜索')

@section('custom-style')
    <style>
        .position-search--card {
            width: 100%;
            min-height: 0;
        }

        .position-search--card ul li {
            display: block;
            padding: 10px 16px;
            margin: 0;
            vertical-align: middle;
            border-bottom: 1px solid var(--divider-light);
        }

        ul.search-panel li label {
            padding-right: 16px;
            vertical-align: top;
        }

        ul.search-panel .span-holder {
            display: inline-block;
            width:924px;
        }

        ul.search-panel li span.selected {
            background-color: var(--blue-sky);
            color: var(--snow);
        }

        ul.search-panel li span {
            padding: 4px 6px;
            cursor: pointer;
            word-break: keep-all;
            margin-bottom: 3px;
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

            <div class="position-search--card mdl-card mdl-shadow--2dp">
                <ul class="search-panel">
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
                            @foreach([1,2,3,4,5] as $item)
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

        </div>
    </div>
@endsection

@section('custom-script')

@endsection
