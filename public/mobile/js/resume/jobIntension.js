/**
 * Created by asusps on 2018/1/2.
 */
(function(){
    var ESHUtils = this.ESHUtils;
    $(function(){
        ESHUtils.fillSpan();//select下拉框选项相关事件
        $(".esh-select2").select2();
        $(".esh-select .select2-container").css("width","100%");

        //自动关联行业和职业信息
        $('#esh-industry-intention').change(function () {
            var indexid = $("select[name='industry']").val();
            var id = "#occupation-display" + indexid;
            // $('div[name=occupation-display]').css("display", "none");
            $(".esh-occup-display").css("display", "none");
            $(id).css("display", "block");
//            $(id).style.display = block;
        });
        $("#esh-save-jobintention").click(function () {
            if(!$("#esh-job-intention").valid()){
                return;
            }
            var rid = $("input[name='rid']");
            var place = $("select[name='place']");
            var industry = $("select[name='industry']");
//            var occupation = $("select[name='occupation']");
            var occupation = $("select[name='occupation" + industry.val() + "']");
            var type = $("select[name='type']");
            var salary = $("input[name='salary']");

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('work_nature', type.val());
            formData.append('occupation', occupation.val());
            formData.append('industry', industry.val());
            formData.append('region', place.val());


            if (salary.val() === '') {
                formData.append('salary', -1);
            } else {
                formData.append('salary', salary.val());
            }

            $.ajax({
                url: "/m/resume/addIntention",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.status===200){
                        self.location=document.referrer;
                    }else{
                        swal({
                            title:"错误",
                            text:result.msg
                        })
                    }
                    // checkResult(result.status, "求职意向已更新", result.msg, $intentionPanelUpdate);
                }
            })
        });
    });

}).call(this);