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
    <title>技能特长</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
    <header class="mdl-layout__header mdl-layout__header--seamed esh-layout__header" id="esh-header">
        <div class="mdl-layout-icon esh-layout-icon--left">
            <i class="material-icons esh-icon">navigate_before</i>
        </div>
        <div class="mdl-layout__header-row esh-layout__header-row esh-layout__header-row--has-button">
            <span class="mdl-layout__title esh-layout__title">新增技能特长</span>
        </div>
    </header>
    <main class="mdl-layout__content" id="esh-content">
        <form id="esh-skill-form">
            <input type="hidden" id="rid" name='rid' class="form-control"
                   value="{{$data["rid"]}}" />
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>技能特长名称
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" id="skill-name" name="skill-name"
                           placeholder="请输入技能特长名称">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>级别
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text"
                           name="skill-degree" placeholder="例如：熟练度，分数，等级">
                </div>
            </div>

            <div class="esh-edit-fb esh-form-sure">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
                    type="button" id="esh-save-skill">
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

    $("#esh-save-skill").click(function () {//保存
        if(!$("#esh-skill-form").valid()){
            return;
        }
        var rid = $("input[name='rid']");
        var skillName = $("input[name='skill-name']");
        var skillDegree = $("input[name='skill-degree']");

        var formData = new FormData();
        formData.append('rid', rid.val());
        formData.append('skill', skillName.val());
        formData.append('level', skillDegree.val());

        $.ajax({
            url: "/m/resume/addSkill",
            type: "post",
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
//                checkResult(result.status, "技能特长已添加", result.msg, $skillPanelUpdate);
            }
        })
    });
</script>
</body>
</html>