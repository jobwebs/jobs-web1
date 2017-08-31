@extends('layout.master')
@section('title', '发布职位')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">

    <style>
        .publish-card {
            width: 100%;
            margin: 50px 0;
            padding-bottom: 20px;
        }

        .publish-panel {
            padding: 8px 32px;
        }

        .publish-form {
            margin-top: 16px;
        }

        .publish-form .left-panel,
        .publish-form .right-panel {
            width: 470px;
            display: inline-block;
            vertical-align: top;
            padding: 20px 10px;
        }

        .publish-form .left-panel > h3,
        .publish-form .right-panel > h3 {
            font-size: 18px;
            font-weight: 300;
            margin: 0 0 30px 0;
            padding: 10px 0 10px 10px;
            background: var(--divider-light);
            border-left: 5px solid var(--blue-sky);
        }

        .publish-form .right-panel {
            margin-left: 15px;
        }

        .publish-form > button[type='submit'] {
            margin-top: 20px;
            float: right;
        }

        .publish-form label {
            display: inline-block;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            display: inline-block;
            padding: 6px 12px 6px 0;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
        }

        .dropdown-menu li {
            display: inline-block;
            width: 100%;
            margin: 0;
        }

        .bs-searchbox > input {
            display: inline-block;
            width: 385px !important;

            padding: 6px 12px !important;
        }

        label[for='position-salary'],
        label[for='position-person--number'],
        label[for='position-experience'],
        label[for='position-education']{
            padding-bottom: 12px;
        }

        label[for='salary-uncertain'],
        label[for='position-no--experience'],
        label[for='position-no--education']{
            height:25px;
            margin-bottom: 16px;
        }

        .label-info{
            background-color: var(--peach)!important;
        }

        [type="checkbox"].filled-in:checked.chk-col-peach + label:after {
            border: 2px solid var(--peach);
            background-color: var(--peach);
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

            <div class="publish-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">职位发布</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border publish-panel">

                    <form class="publish-form">

                        <div class="left-panel">

                            <h3>职位基本信息，必填项</h3>
                            {{--必填项--}}
                            <label for="position-name">职位名称</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="position-name" name="name" class="form-control"
                                           placeholder="不能为空">
                                </div>
                                <label class="error" for="position-name"></label>
                            </div>

                            <label for="position-description">职位描述／介绍</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="3" class="form-control" name="description" id="position-description"
                                          placeholder="简单介绍一下职位，吸引求职者..."></textarea>
                                </div>
                                <label class="error" for="position-description"></label>
                            </div>

                            <label for="position-place">工作地点</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-place"
                                        data-live-search="true" name="place">
                                    <option>请选择工作地点</option>
                                    <option>北京</option>
                                    <option>上海</option>
                                    <option>深圳</option>
                                    <option>成都</option>
                                    <option>武汉</option>
                                </select>
                            </div>

                            <label for="position-salary">薪资K/月</label>
                            <div class="form-group">
                                <input type="checkbox" id="salary-uncertain" class="filled-in chk-col-peach">
                                <label for="salary-uncertain">薪资面议</label>

                                <input type="text" id="position-salary" name="salary" value=""/>
                            </div>

                            <label for="position-person--number">招聘人数</label>
                            <div class="form-group">
                                <input type="number" id="position-person--number" name="person--number" value=""/>
                            </div>

                            <label for="position-experience">工作经验要求</label>
                            <div class="form-group">
                                <input type="checkbox" id="position-no--experience" name="no--experience"
                                       class="filled-in chk-col-peach" checked>
                                <label for="position-no--experience">不要求工作经验</label>

                                <input type="text" id="position-experience" name="experience" value=""/>
                            </div>

                            <label for="position-education">学历要求</label>
                            <div class="form-group">
                                <input type="checkbox" id="position-no--education" name="no--experience"
                                       class="filled-in chk-col-peach" checked>
                                <label for="position-no--education">不要求学历</label>

                                <input type="text" id="position-education" name="education" value=""/>
                            </div>
                        </div>


                        <div class="right-panel">
                            {{--选填项--}}
                            <h3>附加信息，选填项&nbsp;&nbsp;<small>(提供真实完整的信息可吸引更多的求职者)</small>
                            </h3>

                            <label for="position-tag">标签</label>
                            <div class="form-group demo-tagsinput-area">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="position-tag" data-role="tagsinput" value="Tag1,Tag2">
                                </div>
                                <div class="help-info">最多5个标签</div>
                            </div>

                            <label for="position-type">职位类型</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-type" name="type">
                                    <option value="0">请选择职位类型</option>
                                    <option value="1">全职</option>
                                    <option value="2">兼职</option>
                                </select>
                            </div>

                            <label for="position-industry">职位所属行业</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-industry" name="industry">
                                    <option value="0">请选择职位所属行业</option>
                                    <option value="1">行业1</option>
                                    <option value="2">行业2</option>
                                    <option value="3">行业3</option>
                                </select>
                            </div>

                            <label for="position-requirement">职位要求</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="5" class="form-control" name="requirement" id="position-requirement"
                                          placeholder="希望求职者具备哪些技能或品质..."></textarea>
                                </div>
                                <label class="error" for="position-requirement"></label>
                            </div>
                        </div>

                        <div style="clear: both;"></div>

                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            立即发布
                        </button>
                    </form>
                </div>

                <div class="mdl-card__actions mdl-card--border publish-panel">
                    <h3>职位已经成功发布</h3>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky"
                            to="/position/detail">
                        前往查看
                    </button>

                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect button-link"
                            to="/position/publish">
                        继续发布职位
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/ion-rangeslider/js/ion.rangeSlider.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    <script type="text/javascript">

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $("#position-salary").ionRangeSlider({
            grid: true,
            from: 2,
            values:["0k", "3k", "5k", "10k", "15k", "20k", "25k", "50k+"],
        });

        $("#position-person--number").ionRangeSlider({
            min:1,
            max:50,
            from:10
        });

        $("#position-experience").ionRangeSlider({
            grid:true,
            from:1,
            values:["1年", "2年", "3年", "5年", "5年以上"],
        });

        $("#position-education").ionRangeSlider({
            grid:true,
            from:1,
            values:["高中", "大专", "本科", "硕士研究生及以上"],
        });


        $("#salary-uncertain").click(function () {
            if ($("#salary-uncertain").is(":checked")) {
                $("span.js-irs-0").fadeOut(500);
            } else {
                $("span.js-irs-0").fadeIn(500);
            }
        });

        $("span.js-irs-2").hide();
        $("#position-no--experience").prop("checked", true).click(function () {
            if ($("#position-no--experience").is(":checked")) {
                $("span.js-irs-2").fadeOut(500);
            } else {
                $("span.js-irs-2").fadeIn(500);
            }
        });

        $("span.js-irs-3").hide();
        $("#position-no--education").prop("checked", true).click(function () {
            if ($("#position-no--education").is(":checked")) {
                $("span.js-irs-3").fadeOut(500);
            } else {
                $("span.js-irs-3").fadeIn(500);
            }
        });
    </script>
@endsection
