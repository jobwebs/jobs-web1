@extends('layout.master')
@section('title', '发布职位')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>

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
        label[for='position-education'] {
            padding-bottom: 12px;
        }

        label[for='salary-uncertain'],
        label[for='position-no--experience'],
        label[for='position-no--education'] {
            height: 25px;
            margin-bottom: 16px;
        }

        .label-info {
            background-color: var(--peach) !important;
        }

        [type="checkbox"].filled-in:checked.chk-col-peach + label:after {
            border: 2px solid var(--peach);
            background-color: var(--peach);
        }

        h3 > i.material-icons {
            font-size: 40px;
            margin-right: 12px;
            color: var(--cucumber);
            position: relative;
            top: 5px;
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

                    <form class="publish-form" method="post" id="publish-form">

                        <div class="left-panel">

                            <h3>职位基本信息，必填项</h3>
                            {{--必填项--}}
                            <label for="position-name">职位名称</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="position-name" name="name" class="form-control"
                                           placeholder="职位名称">
                                </div>
                                <label class="error" for="position-name"></label>
                            </div>

                            <label for="position-description">职位描述／介绍</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="5" class="form-control" name="description" id="position-description"
                                          placeholder="简单介绍一下职位，吸引求职者..."></textarea>
                                </div>
                                <label class="error" for="position-description"></label>
                            </div>

                            <label for="position-place">工作地点</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-place"
                                        data-live-search="true" name="place">
                                    <option value="0">请选择工作地点</option>
                                    @foreach($data['region'] as $region)
                                        <option value="{{$region->id}}">{{$region->name}}</option>
                                    @endforeach
                                </select>
                                <label class="error" for="position-place"></label>
                            </div>

                            <label for="position-industry">所属行业</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-industry"
                                        name="industry">
                                    <option value="0">请选择所属行业</option>
                                    @foreach($data['industry'] as $industry)
                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                    @endforeach
                                </select>
                                <label class="error" for="position-industry"></label>
                            </div>

                            <label for="position-occupation">所属职业</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-occupation"
                                        name="occupation">
                                    <option value="0">请选择所属职业</option>
                                    @foreach($data['occupation'] as $occupation)
                                        <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                    @endforeach
                                </select>
                                <label class="error" for="position-occupation"></label>
                            </div>

                            <label for="position-type">职位类型</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-type" name="type">
                                    <option value="-1">请选择职位类型</option>
                                    <option value="0">兼职</option>
                                    <option value="1">实习</option>
                                    <option value="2">全职</option>
                                </select>
                                <label class="error" for="position-type"></label>
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

                            <label for="effective-date" style="margin-top: 16px;">职位有效截至日期</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="effective-date" name="effective-date" class="form-control"
                                           placeholder="职位有效期：格式xxxx-xx-xx">
                                </div>
                                <label class="error" for="effective-date"></label>
                            </div>

                            {{--<label for="position-experience">工作经验要求</label>--}}
                            {{--<div class="form-group">--}}
                            {{--<input type="checkbox" id="position-no--experience" name="no--experience"--}}
                            {{--class="filled-in chk-col-peach" checked>--}}
                            {{--<label for="position-no--experience">不要求工作经验</label>--}}

                            {{--<input type="text" id="position-experience" name="experience" value=""/>--}}
                            {{--</div>--}}

                            {{--<label for="position-education">学历要求</label>--}}
                            {{--<div class="form-group">--}}
                            {{--<input type="checkbox" id="position-no--education" name="no--experience"--}}
                            {{--class="filled-in chk-col-peach" checked>--}}
                            {{--<label for="position-no--education">不要求学历</label>--}}

                            {{--<input type="text" id="position-education" name="education" value=""/>--}}
                            {{--</div>--}}
                        </div>


                        <div class="right-panel">
                            {{--选填项--}}
                            <h3>附加信息，选填项&nbsp;&nbsp;<small>(提供真实完整的信息可吸引更多的求职者)</small>
                            </h3>

                            <label for="position-tag">标签</label>
                            <div class="form-group demo-tagsinput-area">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tag" id="position-tag"
                                           data-role="tagsinput">
                                </div>
                                <div class="help-info">如有多个标签，请用英文逗号分割</div>
                                <label class="error" for="position-tag"></label>
                            </div>

                            <label for="position-education">学历要求</label>
                            <div class="form-group">
                                <select class="form-control show-tick selectpicker" id="position-education"
                                        name="education">
                                    <option value="-1">无学历要求</option>
                                    <option value="0">高中</option>
                                    <option value="2">本科</option>
                                    <option value="3">硕士及以上</option>
                                </select>
                                <label class="error" for="position-education"></label>
                            </div>

                            <label for="position-age">年龄要求(16~99)</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" id="position-age"
                                           name="person-age" value="" min="16" max="99" placeholder="最高年龄限制"/>
                                </div>
                                <label class="error" for="position-age"></label>
                            </div>

                            <label for="position-experience">工作经验要求</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="5" class="form-control" name="experience" id="position-experience"
                                          placeholder="希望求职者具备哪些工作经验..."></textarea>
                                </div>
                                <label class="error" for="position-experience"></label>
                            </div>
                        </div>

                        <div style="clear: both;"></div>

                        <button id="publish-button"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            立即发布
                        </button>
                    </form>
                </div>

                {{--<div class="mdl-card__actions mdl-card--border publish-panel">--}}
                {{--<h3><i class="material-icons">check</i>职位已经成功发布</h3>--}}

                {{--<div style="margin-left: 52px;">--}}
                {{--<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky"--}}
                {{--to="/position/detail">--}}
                {{--前往查看--}}
                {{--</button>--}}

                {{--<button class="mdl-button mdl-js-button mdl-js-ripple-effect button-link"--}}
                {{--to="/position/publish">--}}
                {{--继续发布职位--}}
                {{--</button>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/ion-rangeslider/js/ion.rangeSlider.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script type="text/javascript">

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $("#position-salary").ionRangeSlider({
            grid: true,
            from: 2,
            values: ["0k", "3k", "5k", "10k", "15k", "20k", "25k", "50k+"],
        });

        $("#position-person--number").ionRangeSlider({
            min: 1,
            max: 50,
            from: 10
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

        $("#publish-button").click(function (event) {
            event.preventDefault();
            //var publishForm = $("#publish-form");

            var name = $("input[name='name']");
            var description = $("textarea[name='description']");
            var place = $("select[name='place']");
            var industry = $("select[name='industry']");
            var occupation = $("select[name='occupation']");
            var type = $("select[name='type']");

            var salaryCB = $("#salary-uncertain");
            var salary = $("input[name='salary']");

            var personNumber = $("input[name='person--number']");

            var effectiveDate = $("input[name='effective-date']");

            var tag = $("input[name='tag']");
            var experience = $("textarea[name='experience']");
            var education = $("select[name='education']");
            var ageLimit = $("input[name='person-age']");


            if (name.val() === "") {
                setError(name, "position-name", "不能为空");
                return;
            } else {
                removeError(name, "position-name");
            }

            if (description.val() === "") {
                setError(description, "position-description", "不能为空");
                return;
            } else {
                removeError(description, "position-description");
            }

            if (place.val() === "0") {
                setError(place, "position-place", "请选择工作地点");
                return;
            } else {
                removeError(place, "position-place");
            }

            if (industry.val() === "0") {
                setError(industry, "position-industry", "请选择所属行业");
                return;
            } else {
                removeError(industry, "position-industry");
            }

            if (occupation.val() === "0") {
                setError(occupation, "position-occupation", "请选择所属职业");
                return;
            } else {
                removeError(occupation, "position-occupation");
            }

            if (type.val() === "-1") {
                setError(type, "position-type", "请选择职位类型");
                return;
            } else {
                removeError(type, "position-type");
            }

            if (effectiveDate.val() === "") {
                setError(effectiveDate, "effective-date", "不能为空");
                return;
            } else {
                removeError(effectiveDate, "effective-date");
            }

            if (ageLimit.val() !== "") {
                if (ageLimit.val() > 99 || ageLimit.val() < 16) {
                    setError(ageLimit, "position-age", "输入值无效");
                    return;
                } else {
                    removeError(ageLimit, "position-age");
                }
            }


            var formData = new FormData();
            formData.append("title", name.val());
            formData.append("tag", tag.val());
            formData.append("pdescribbe", description.val());

            if (salaryCB.is(":checked")) {
                formData.append("salary", -1);
            } else {
                formData.append("salary", salary.val());
            }

            formData.append("region", place.val());
            formData.append("work_nature", type.val());
            formData.append("occupation", occupation.val());
            formData.append("industry", industry.val());
            formData.append("experience", experience.val());
            formData.append("education", education.val());
            formData.append("total_num", personNumber.val());

            formData.append("max_age", ageLimit.val());
            formData.append("vaildity", effectiveDate.val());

            $.ajax({
                url: "/position/publish/add",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);

                    if (result.status === 400) {
                        swal({
                            title: "错误",
                            type: "error",
                            text: result.msg,
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            type: "success",
                            text: "职位发布成功，稍后就可以在 个人中心->已发布职位 中查看",
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            self.location = "/account/";
                        }, 1000);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal({
                        type: "error",
                        title: xhr.status,
                        text: thrownError
                    });
                }
            })
        })
    </script>
@endsection
