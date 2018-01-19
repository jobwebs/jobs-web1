<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/mdl/material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/mdl-picker/css/mdDateTimePicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/default/styles.css')}}"/>
    <title>简历信息</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
    <header class="mdl-layout__header mdl-layout__header--seamed esh-layout__header" id="esh-header">
        <div class="mdl-layout-icon esh-layout-icon--left">
            <i class="material-icons esh-icon">navigate_before</i>
        </div>
        <div class="mdl-layout__header-row esh-layout__header-row esh-layout__header-row--has-button">
            <span class="mdl-layout__title esh-layout__title">{{isset($data["id"])?"修改工作经历":"新增工作经历"}}</span>
        </div>
    </header>
    <main class="mdl-layout__content" id="esh-content">
        <form id="esh-work-form">
            <input type="hidden" id="workex-id" name="workex-id" class="form-control"
                   value="{{$data["id"] or '-1'}}" >
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>公司名称
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" name="company-name"
                           placeholder="请输入公司名称"
                           value="{{$data["ename"] or ''}}">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>职位
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text"
                           name="position" placeholder="请输入职位"
                           value="{{$data["position"] or ''}}">
                    <span class="mdl-textfield__error">error msg</span>
                </div>
            </div>
            <?php
            $beginDate = "";
            $endDate = "";
            if(isset($data['work_time'])){
                $index = strpos($data['work_time'],"@");
                $beginDate = substr($data['work_time'],0,$index);
                $endDate = substr($data['work_time'],$index+1,strlen($data['work_time'])-1);
            }
            ?>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>入职时间
                </label>
                {{--esh-birth-input--}}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" name="work-begin"
                           value="{{$beginDate}}"
                           data-date-format="yyyy-mm-dd" id="esh-work-begin" placeholder="请选择入职时间"/>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>离职时间
                </label>
                {{--esh-birth-input--}}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                    <input class="mdl-textfield__input required" type="text" name="work-end"
                           value="{{$endDate}}"
                           data-date-format="yyyy-mm-dd" id="esh-work-end" placeholder="请选择离职时间"/>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>工作类型
                </label>
                <div class="esh-select">
                    <span class="esh-sval"></span>
                    <select class="esh-select-option" name="work-type">
                        @if(isset($data["type"]))
                            <option value="0" @if($data["type"] == "0") selected @endif>全职</option>
                            <option value="1" @if($data["type"] == "1") selected @endif>实习</option>
                        @else
                            <option value="0">全职</option>
                            <option value="1">实习</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="esh-edit esh-textarea">
                <label class="esh-label">
                    工作描述
                </label>
                <div class="esh-textarea--p">
                    <textarea name="work-desc" maxlength="150"
                        placeholder="介绍你的工作内容……"></textarea>
                </div>
            </div>


            <div class="esh-edit-fb esh-form-sure">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
                    type="button" id="esh-save-work">
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
    var ESHUtils = window.ESHUtils;
    ESHUtils.fillSpan();//填充span内容
    var beginDate = new mdDateTimePicker.default({
        type: 'date',
        init: moment(moment().subtract(0,"years").format("l"),"YYYY-MM-DD"),
        //init: moment(moment().format("l"),"YYYY-MM-DD"),
        past:moment().subtract(50,"years"),
        ok:"确定",
        cancel:"取消"
    });
    //入职时间
    $("#esh-work-begin").on('click',function(){
        beginDate.toggle();
    });
    /**/
    beginDate.trigger = $("#esh-work-begin")[0];
    $("#esh-work-begin").on("onOk",function(){
        //this.value = birthDate.time.toString();
        this.value = beginDate.time.format("YYYY-MM-DD");
    });

    //离职时间
    var endDate = new mdDateTimePicker.default({
        type: 'date',
        init: moment(moment().subtract(0,"years").format("l"),"YYYY-MM-DD"),
        //init: moment(moment().format("l"),"YYYY-MM-DD"),
        past:moment().subtract(50,"years"),
        ok:"确定",
        cancel:"取消"
    });
    $("#esh-work-end").on('click',function(){
        endDate.toggle();
    });
    /**/
    endDate.trigger = $("#esh-work-end")[0];
    $("#esh-work-end").on("onOk",function(){
        //this.value = birthDate.time.toString();
        this.value = endDate.time.format("YYYY-MM-DD");
    });

    $("#esh-save-work").click(function () {//保存
        if(!$("#esh-work-form").valid()){
            return;
        }
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


//        if (workDesc.length >150) {
//            setError(workDesc_raw, "work-desc", "最大字数不能超过150字");
//            return;
//        } else {
//            removeError(workDesc_raw, "work-desc");
//        }

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
            url: "/m/resume/addWorkexp",
            type: 'post',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
//                var result = JSON.parse(data);
                var result = JSON.parse(data);
                if(result.status===200){
                    history.back();
//                    self.location=document.referrer;
                }else{
                    swal(result.msg);
                }
//                checkResult(result.status, "工作经历已添加", result.msg, null);
            }
        })
    });
</script>
</body>
</html>