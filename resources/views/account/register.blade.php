@extends('layout.master')
@section('title', '注册')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>

        .register-card-holder {
            width: 100%;
            min-height: 450px;
            background: url({{asset('images/akali_vs_baron_3.jpg')}}) no-repeat center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding: 80px 0
        }

        .register-card-holder > h3,
        .register-card-holder > p {
            min-width: 800px;
            font-weight: 300;
            text-align: center;
            /*color: #333333;*/
            color: white;
        }

        .register-card-holder > p {
            padding-bottom: 32px;
        }

        .register-card {
            width: 800px;
            height: 430px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, .95);
            padding: 0 30px;
            border: 1px solid lightgray;
        }

        .register-card > h5 {
            font-weight: 300;
            text-align: center;
            color: rgb(0, 0, 0);
        }

        .register-form {
            width: 370px;
            border-right: 1px solid #4d4d4d;
        }

        #phone-verify-code .form-line {
            position: relative;
        }

        #phone-verify-code .form-line input[type='button'] {
            width: 150px;
            position: absolute;
            right: 0;
            bottom: 1px;
            color: #232323;
        }

        #phone-verify-code .form-line input[type="button"]:hover {
            color: #232323;
        }

        #register-verify-code {
            width: 206px;
            display: inline-block;
        }

        #right-panel {
            width: 365px;
            padding-left: 30px;
        }

        .form-group {
            width: 340px;
        }

        .form-group .form-line input {
            background-color: transparent;
        }

        #right-panel a {
            color: #03A9F4;
            text-decoration: underline;
        }

        a {
            cursor: pointer;
        }
        .look_user_agreement{
            color:blue;
            text-decoration: underline;
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

@section('content')

    <div class="register-card-holder">
        <h3> <?=$site_desc ?></h3>
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.--}}
        {{--Aenan convallis.</p>--}}

        <div class="register-card mdl-card mdl-shadow--2dp">
            <h5>立即加入 <?=$site_name?></h5>

            <table border="0">
                <tr>
                    <td>
                        <form method="post" class="register-form" id="register-form">

                            <div class="form-group" id="phone-form">
                                <div class="form-line">
                                    <input type="text" id="phone" name="tel" class="phone form-control"
                                           placeholder="手机号...">
                                </div>
                                <label class="error" for="phone"></label>
                            </div>

                            <div class="form-group" id="email-form">
                                <div class="form-line">
                                    <input type="text" id="email" name="mail" class="email form-control"
                                           placeholder="邮箱...">
                                </div>
                                <label class="error" for="email"></label>
                            </div>

                            <div class="form-group" id="phone-verify-code">
                                <div class="form-line">
                                    <input type="text" id="register-verify-code" name="verify-code" class="form-control"
                                           placeholder="验证码...">
                                    <input type="button" id="send-SMS" value="发送验证码"
                                           class="mdl-button mdl-js-button mdl-button-default button-border"/>
                                </div>
                                <label class="error" for="register-verify-code"></label>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" name="password" class="password form-control"
                                           placeholder="密码...">
                                </div>
                                <label class="error" for="password"></label>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="conform-password" name="passwordConfirm"
                                           class="form-control"
                                           placeholder="确认密码...">
                                </div>
                                <label class="error" for="conform-password"></label>
                            </div>

                            <div class="form-group">
                                <input name="type" type="radio" id="personal" class="radio-col-light-blue" value="1"
                                       checked/>
                                <label for="personal">个人用户注册</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="type" type="radio" id="enterprise" class="radio-col-light-blue" value="2"/>
                                <label for="enterprise">企业用户注册</label>
                            </div>
                            {{--<div class="form-group">--}}
                                &nbsp;&nbsp;&nbsp;&nbsp;

                            {{--</div>--}}
                            <button type="submit" id="register-btn"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                立即注册
                            </button>
                            <input name="user_agreement" type="checkbox" id="user_agreeent" class="radio-col-light-blue" value="2"/>
                            <label for="user_agreeent"><a class="look_user_agreement" data-toggle="modal" data-target="#user_agreement_modal">查看用户协议</a></label>
                        </form>
                    </td>
                    <td>
                        <div id="right-panel">
                            <p>你还可以使用邮箱来注册 esport hunter
                                <a for="phone-form" onclick="switchRegisterType(0)">使用手机号注册</a>
                                <a for="email-form" onclick="switchRegisterType(1)">使用邮箱注册</a>
                            </p>
                            <p>已经有账号了？
                                <button to="/account/login"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    立即登录
                                </button>
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- 模态框（Modal） -->
        <div class="modal fade" id="user_agreement_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            用户协议
                        </h4>
                    </div>
                    <div class="modal-body look-detail-modal-body">
                        （一）版权
                        此网站的内容、图表、版式设计等所呈现出的全部或部分可单独作为作品保护之内容等及维系本网站运营的各种源代码、执行程序、系统均受到中国版权法律、法规及相关国际条约的保护。eshunter.com拥有一切权利，未经eshunter.com同意，不允许全部或部分复制、转载或以其他任何方式使用。禁止以任何目的重新使用eshunter.com网上的内容和图表等作品或作品元素。在内容和图表等作品、元素不作任何修改、保留内容未做修改以及事先得到eshunter.com的许可的情况下，eshunter.com的网上材料可作为网外信息方面和非商业方面的用途。经eshunter.com同意后复制、转载或者以其他形式使用本网站相关资料的，应当标明资料来源于“eshunter.com”，以及eshunter.com或相关第三方拥有该等资料的著作权的字样。
                        申请使用eshunter.com内容的许可是按逐个批准的原则进行的。eshunter.com欢迎使用者提出申请。请把请求直接提交给kefu@eshunter.com。请勿复制或采用eshunter.com所创造的用以制成网页的HTML。HTML的版权同样属于eshunter.com。
                        eshunter.com对其网址上的所有图标、图饰、图表、色彩、文字表述及其组合、版面设计、数据库均享有完全的著作权及其衍生的其他全部权利，对发布的信息均享有专有的发布和使用权。
                        （二）商标
                        eshunter.com的商标属于eshunter.com所有。eshunter.com上的eshunter.com合作者的商标属于合作者所有。未经eshunter.com及/或eshunter.com合作者事先书面许可，不得复制或以任何其他方式使用上述商标。
                        （三）注册
                        1、eshunter.com不对除完全民事行为能力人以外的主体开放，任何不具备完全民事行为能力的主体都不是本网站的合格使用者；eshunter.com有权采取包括但不限于注销账户的处理措施，并向使用者的监护人或负责人索偿。
                        2、使用者应自行负责用户名、登录密码、支付密码（如有）、验证码的安全。使用者应对通过使用者账户和密码实施的行为负责，不得将上述信息提供给任何第三方使用或从事任何可能使用户名、密码存在泄露危险的行为（包括但不限于授权代理或第三方网站登录）。因此所衍生的任何损失或损害，eshunter.com不承担任何责任，并保留向使用者追偿的权利。
                        3、当使用者发现任何账户的不当使用或有任何其他可能危及账户安全的情形时，应立即告知eshunter.com。使用者理解并知悉eshunter.com采取行动需要合理时间，eshunter.com对在采取行动前已经产生的后果（包括但不限于使用者的任何损失）不承担任何责任。
                        4、使用者了解并知悉一经注册，即视为您同意eshunter.com及/或其关联公司通过短信或者电子邮件的方式向使用者的手机号码或者电子邮箱发送相应的产品服务信息、促销优惠等营销信息。
                        (四)网站使用
                        1、明确的禁止使用eshunter.com 只能用于合法目的，即个人寻找职业和雇主寻找雇员。eshunter.com 明确禁止任何其他用途，并要求所有使用者同意不用于下列任何一种用途：
                        （1）在简历中心公布不完整、虚假或不准确的简历资料，或不是使用者的准确简历(而为他人寻找全职或兼职工作)。
                        （2）公布不是简历的资料，如意见、通知、商业广告或其他非简历内容。
                        （3）为eshunter.com的竞争同行回应职位，并用此方法寻求与雇主联络业务。
                        （4）除发布者外，删除或修改其他个人或公司公布的资料。
                        （5）擅自打印、复制或以其他方式使用有关雇员的任何个人资料或有关雇主的商业信息。
                        （6）未经同意，给公布信息的个人或公司发电子邮件、打电话、寄信或以其他方式进行接触。

                        2、网址安全法规禁止使用者破坏或企图破坏 eshunter.com 的安全法规，包括但不限于：
                        （1）接触未经许可的数据或进入未经许可的服务器、帐户、邮箱或许可第三方接入未经本网站同意的由本网站发布、输送、传播的数据、简历或其他信息等；
                        （2）没有得到许可，企图探查、扫描或测试系统或网络的弱点或者破坏安全措施；
                        （3）企图干涉对用户及网络的服务，包括但不限于通过超载、“邮件炸弹”或“摧毁”等手段；
                        （4）发送促销、产品广告及服务的email；
                        （5）伪造TCP/IP数据包名称或部分名称。破坏系统或网络可能导致犯罪。eshunter.com 将调查此类破坏行为的发生，并可能干预、和执法当局合作起诉犯此类破坏行为的使用者。
                        3、总则严禁从事以下行为：
                        （1）违反任何现行法律法规及其不时的修订；
                        （2）侵犯他人的版权、商业机密、或其他知识产权，或侵犯了他人的隐私权、出版权或其他个人合法权利；
                        （3）利用本网站传送、分发、储存属于诽谤、淫秽、威胁、辱骂性、毁损他人或其他非法或者违反社会公序良俗的材料；
                        （4）利用本网站提供的服务系统进行任何可能对互联网或移动网正常运转造成不利影响的行为；
                        （5）以任何形式使用本网站提供的服务进行任何不利于本网站的行为。
                        (五)暂停使用、终止使用
                        任何一位使用者经 eshunter.com 确定已违反了网站使用规则某一项规定，将有可能收到一份书面警告。如果该使用者同意以书面形式表示自己再也不会有违犯行为，eshunter.com 有权决定是否给予暂停使用或终止使用的处理。然而，如果我们认为必要时，也可不提出警告而马上暂停或终止对该使用者的服务。如果我们确定某一使用者再次违犯了网络使用规则的任何一项规定，无需再发通知，该使用者立即受到暂停使用或终止使用的处理。
                        （六）免责条款
                        1、使用者理解并同意eshunter.com对以下情况免责：（1）应聘信息发布方对存入简历中心的个人简历及材料的格式、内容的真实性、准确性和合法性负有全部责任，招聘信息发布方对于其在职位数据库公布的材料的真实性、准确性和合法性负有全部责任。eshunter.com仅是提供职位发布等信息的平台，eshunter.com不对应聘及招聘信息的真实性、有效性、准确性负责。
                        （2）eshunter.com并不能时时监视此网址，但保留进行随时监视的权利。对于非eshunter.com公布的材料，eshunter.com一概不负任何责任。
                        （3）eshunter.com虽然对用户进行资质审查，但eshunter.com并非司法机关，仅能要求用户提交真实、有效的资质证明文件，并对该提交的资质证明文件进行审核。如用户提交虚假、伪造、变造文件的，eshunter.com对此概不承担法律责任。
                        （4）eshunter.com不对用户的线下行为负责。企业用户及个人用户均应审慎的对待他方之行为，因为他方之行为给用户造成任何不利影响的，eshunter.com不承担任何法律责任。
                        （5）eshunter.com不能保证某一种职位描述会有一定数目的使用者来浏览，也不能保证会有一位特定的使用者来浏览。
                        （6）eshunter.com对由于政府禁令、现行生效的适用法律或法规的变更、火灾、地震、动乱、战争、停电、通讯线路中断、黑客攻击、计算机病毒侵入或发作、电信部门技术调整、因政府管制而造成网站的暂时性关闭等任何影响网络正常运营的不可预见、不可避免、不可克服和不可控制的事件（“不可抗力事件”），以及他人蓄意破坏、eshunter.com工作人员的疏忽或不当使用，正常的系统维护、系统升级，或者因网络拥塞而导致本网站不能访问而造成的本网站所提供的信息及数据的延误、停滞或错误，以及使用者由此受到的一切损失不承担任何责任。
                        （7）由于与本网站链接的其他网站或用户所使用的网络运营商所造成之个人资料泄露及由此而导致的任何法律争议和后果均由网站或用户所使用的网络运营商负责；
                        （8）对于eshunter.com为使用者提供便利而设置的外部链接网址，eshunter.com并不保证其准确性、安全性和完整性，亦并不代表本网站对其链接内容的认可，请使用者谨慎确认后使用，eshunter.com对由此导致的任何损失或伤害不承担任何责任。
                        2、除了本网址在隐私政策中提出的条款外，使用者理解并同意eshunter.com在不公开姓名的情况下，可以向第三方提供综合性的非个人化信息资料。除非：（1）依照法律、法规、法院命令、监管机构命令的要求；
                        （2）根据政府行为、监管要求或请求；
                        （3）因eshunter.com其认为系为遵守监管义务或公共目的所需；
                        （4）为免除访问者在生命、身体或财产方面之急迫危险，
                        否则在没有本人事先同意的情况下，eshunter.com 不会向第三方公开你的姓名、地址、电子邮件和电话等个人信息。
                        (七)风险声明
                        你使用本网址将自行承担风险。本网址的材料是按“正如……的情况”所提供的，对材料不作明显的或暗含的保证。除非适用的法律法规有明确规定，eshunter.com 及其所属网络对销售性的和适合于某一特定目的的一切保证不予承认。 eshunter.com 不能保证材料的特殊目的不受阻挠不出错误，也不能保证错误会得到纠正，也不能保证本网址或制成本网址的材料不含有病毒或其他有害成分。在有关材料的使用或使用结果方面对材料的正确性、准确性、可靠性或其他方面，eshunter.com 不作出保证或任何说明。你（而不是 eshunter.com ）承担一切必要的服务、修理或改正费用。在适用法规不允许暗含保证可免除承担一切费用的范围里，免除上述承担费用不适用于你。
                        警告
                        在使用 eshunter.com 网络时违背了这些法规将构成对eshunter.com权利的侵犯或违反，并可导致对你采取法律行动。
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">关闭
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>


@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script type="text/javascript">
        var registerType = 0; //0:phone; 1:email;

        $registerForm = $("#register-form");
        $registerVerifyCode = $("#register-verify-code");

        $("#email-form").hide();
        $("a[for='phone-form']").hide();
        $registerVerifyCode.prop("disabled", true);

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        function switchRegisterType(type) {
            if (type === 0) {
                $("a[for='phone-form']").hide();
                $("a[for='email-form']").fadeIn(500);
                $("#email-form").hide();
                $("#phone-form").fadeIn(500);
                $("#phone-verify-code").fadeIn(500);
                $("#phone").val("");
                registerType = 0;
            } else if (type === 1) {
                $("a[for='phone-form']").fadeIn(500);
                $("a[for='email-form']").hide();
                $("#email-form").fadeIn(500);
                $("#phone-form").hide();
                $("#phone-verify-code").hide();
                $("#email").val("");
                registerType = 1;
            }
        }

        $registerForm.find(".email").inputmask({alias: "email"});
        $registerForm.find(".phone").inputmask('99999999999', {placeholder: '___________'});

        $("#send-SMS").click(function () {
            var phone = $('#phone');

            if (phone.is(":visible") && phone.val() === '') {
                setError(phone, 'phone', '不能为空');
                return;
            }

            if (phone.is(":visible") && !/^1[34578]\d{9}$/.test(phone.val())) {
                setError(phone, 'phone', '手机号格式不正确');
                return;
            }

            removeError(phone, 'phone');

            var form_data = new FormData();
            form_data.append('telnum', phone.val());

            countDown(this, 30);

            swal({
                title: phone.val(),
                text: "将发送短信验证码到此手机号",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {

                $.ajax({
                    url: "/account/sms",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: "post",
                    data: form_data,
                    success: function (data) {
                        console.log(data);
                        var result = JSON.parse(data);
                        if (result.status === 200) {
                            swal("短信验证码已发送");

                            $registerVerifyCode.prop("disabled", false);
                            $registerVerifyCode.focus();
                        } else if (result.status === 400) {
                            swal(result.msg);
                        }
                    }
                });
            });
        });


        $("button[type='submit']").click(function (event) {
            event.preventDefault();

            var phone = $('#phone');
            var email = $('#email');
            var code = $('#register-verify-code');
            var pwd = $('#password');
            var conformPwd = $('#conform-password');
            var type = $("input[name='type']:checked");

            if (phone.is(':visible') && phone.val() === '') {
                setError(phone, 'phone', '不能为空');
                return;
            } else {
                removeError(phone, 'phone');
            }

            if (code.is(':visible') && code.val() === '') {
                setError(code, 'register-verify-code', '不能为空');
                return;
            } else {
                removeError(code, 'register-verify-code');
            }

            if (email.is(':visible') && email.val() === '') {
                setError(email, 'email', '不能为空');
                return;
            } else {
                removeError(email, 'email')
            }

            if (pwd.val() === '') {
                setError(pwd, 'password', '不能为空');
                return;
            } else if (pwd.val().length < 6 || pwd.val().length > 60) {
                setError(pwd, 'password', '密码至少6位，至多60位');
                return;
            } else {
                removeError(pwd, 'password');
            }

            if (conformPwd.val() === '') {
                setError(conformPwd, 'conform-password', '不能为空');
                return;
            } else if (pwd.val() !== conformPwd.val()) {
                setError(conformPwd, 'conform-password', '两次密码输入不一致');
                return;
            } else {
                removeError(conformPwd, 'conform-password');
            }

            var formData = new FormData();
            if (registerType === 0) {
                formData.append("phone", phone.val());
                formData.append("code", code.val());
            }

            if (registerType === 1)
                formData.append("email", email.val());

            formData.append("password", pwd.val());
            formData.append("type", type.val());

            console.log("type: " + type.val());

            if (registerType === 1) {
                swal({
                    title: email.val(),
                    text: "确定使用该邮箱注册吗",
                    type: "info",
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {

                    $.ajax({
                        url: "/account/register",
                        type: "post",
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            var result = JSON.parse(data);
                            if (result.status === 200) {
                                swal({
                                    title: "注册成功",
                                    text: "激活邮件已发送到邮箱：" + email.val() + "\n一周之内有效，请尽快激活!",
                                    confirmButtonText: "返回登录页面"
                                }, function () {
                                    self.location = "/account/login";
                                });

                            } else if (result.status === 400) {
                                swal(result.msg);
                            }
                        }
                    })
                });
            } else if (registerType === 0) {
                $.ajax({
                    url: "/account/register",
                    type: "post",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        var result = JSON.parse(data);
                        if (result.status === 200) {
                            swal({
                                title: "注册成功",
                                text: "点击确定立即登录",
                                type: "info",
                                confirmButtonText: "确定",
                                closeOnConfirm: false
                            }, function () {
                                self.location = "/account/login";
                            });
                        } else if (result.status === 400) {
                            swal(result.msg);
                        }
                    }
                })
            }

        });

        function countDown(obj, second) {

            // 如果秒数还是大于0，则表示倒计时还没结束
            if (second >= 0) {
                // 获取默认按钮上的文字
                if (typeof buttonDefaultValue === 'undefined') {
                    buttonDefaultValue = obj.defaultValue;
                }
                // 按钮置为不可点击状态
                obj.disabled = true;
                // 按钮里的内容呈现倒计时状态
                obj.value = buttonDefaultValue + ' (' + second + ')';
                // 时间减一
                second--;
                // 一秒后重复执行
                setTimeout(function () {
                    countDown(obj, second);
                }, 1000);
                // 否则，按钮重置为初始状态
            } else {
                // 按钮置未可点击状态
                obj.disabled = false;
                // 按钮里的内容恢复初始状态
                obj.value = buttonDefaultValue;
            }
        }
    </script>
@endsection
