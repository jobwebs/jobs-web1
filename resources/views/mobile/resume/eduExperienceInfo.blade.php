<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/mdl/material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/mdl-picker/css/mdDateTimePicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/default/styles.css')}}"/>
    <title>修改教育经历</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
    <header class="mdl-layout__header mdl-layout__header--seamed esh-layout__header" id="esh-header">
        <div class="mdl-layout-icon esh-layout-icon--left">
            <i class="material-icons esh-icon">navigate_before</i>
        </div>
        <div class="mdl-layout__header-row esh-layout__header-row esh-layout__header-row--has-button">
            <span class="mdl-layout__title esh-layout__title">{{isset($data["eduid"])?"修改教育经历":"新增教育经历"}}</span>
        </div>
    </header>
    <main class="mdl-layout__content" id="esh-content">
        <form id="esh-edu-form">
            <input type="hidden" id="eduid" name="eduid" class="form-control"

                   value="{{$data["eduid"] or '-1'}}" >
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>学校
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" name="school"
                           placeholder="请输入学校名称"
                           value="{{$data["school"]  or ''}}">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>学历
                </label>
                <div class="esh-select">
                    <span class="esh-sval">高中</span>
                    <select name="degree" class="esh-select-option">
                        @if(isset($data["degree"]))
                            <option value="0" @if($data["degree"] == "0") selected @endif>高中</option>
                            <option value="1" @if($data["degree"] == "1") selected @endif>专科</option>
                            <option value="2" @if($data["degree"] == "2") selected @endif>本科</option>
                            <option value="3" @if($data["degree"] == "3") selected @endif>研究生及以上</option>
                        @else
                            <option value="0" >高中</option>
                            <option value="1" >专科</option>
                            <option value="2" >本科</option>
                            <option value="3" >研究生及以上</option>
                        @endif


                    </select>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    专业
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text"
                           placeholder="请输入所属专业"
                           value="{{$data["major"] or ''}}" name="subject">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>入学时间
                </label>
                {{--esh-birth-input--}}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" name="education-begin"
                           value="{{$data['date'] or ''}}"
                           data-date-format="yyyy-mm-dd" id="esh-education-begin" placeholder="请选择入学时间"/>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>毕业时间
                </label>
                {{--esh-birth-input--}}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" name="education-end"
                           value="{{$data['gradu_date'] or ''}}"
                           data-date-format="yyyy-mm-dd" id="esh-education-end" placeholder="请选择毕业时间"/>
                </div>
            </div>

            <div class="esh-edit-fb esh-form-sure">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
                        type="button" id="esh-edu-save">
                    保存
                </button>
            </div>
        </form>

    </main>
</div>
<script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>

<script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.method.js')}}"></script>
<script src="{{asset('mobile/plugins/mdl-picker/js/moment.min.js')}}"></script>
<script src="{{asset('mobile/plugins/mdl-picker/js/lang/zh-cn.js')}}"></script>

<script src="{{asset('mobile/plugins/mdl-picker/js/scroll-into-view-if-needed.min.js')}}"></script>
<script src="{{asset('mobile/plugins/mdl-picker/js/draggabilly.pkgd.min.js')}}"></script>
<script src="{{asset('mobile/plugins/mdl-picker/js/mdDateTimePicker.js')}}"></script>
<script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
<script src="{{asset('mobile/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('mobile/js/utils/utils.js')}}"></script>
<script>
    (function () {
        var ESHUtils = this.ESHUtils;
        $(function () {
            ESHUtils.fillSpan();//填充span内容
            var beginDate = new mdDateTimePicker.default({
                type: 'date',
                init: moment(moment().subtract(0,"years").format("l"),"YYYY-MM-DD"),
                //init: moment(moment().format("l"),"YYYY-MM-DD"),
                past:moment().subtract(50,"years"),
                ok:"确定",
                cancel:"取消"
            });
            //入学时间
            $("#esh-education-begin").on('click',function(){
                beginDate.toggle();
            });
            /**/
            beginDate.trigger = $("#esh-education-begin")[0];
            $("#esh-education-begin").on("onOk",function(){
                //this.value = birthDate.time.toString();
                this.value = beginDate.time.format("YYYY-MM-DD");
            });

            //毕业时间
            var endDate = new mdDateTimePicker.default({
                type: 'date',
                init: moment(moment().subtract(0,"years").format("l"),"YYYY-MM-DD"),
                //init: moment(moment().format("l"),"YYYY-MM-DD"),
                past:moment().subtract(50,"years"),
                ok:"确定",
                cancel:"取消"
            });
            $("#esh-education-end").on('click',function(){
                endDate.toggle();
            });
            /**/
            endDate.trigger = $("#esh-education-end")[0];
            $("#esh-education-end").on("onOk",function(){
                //this.value = birthDate.time.toString();
                this.value = endDate.time.format("YYYY-MM-DD");
            });

            //
            $("#esh-edu-save").click(function () {
                if(!$("#esh-edu-form").valid()){
                    return;
                }
                var school = $("input[name='school']");
                var eduid = $("input[name='eduid']");
                var degree = $("select[name='degree']");
                var subject = $("input[name='subject']");
                var starDate = $("input[name='education-begin']");
                var endDate = $("input[name='education-end']");

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
                    url: "/m/resume/addEducation",
                    type: 'post',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        var result = JSON.parse(data);
                        if(result.status===200){
                            history.back();
//                    self.location=document.referrer;
                        }else{
                            swal(result.msg);
                        }
//                checkResult(result.status, "教育经历已添加", result.msg, $educationPanelUpdate);
                    }
                })
            });
        });
    })();

</script>
</body>
</html>