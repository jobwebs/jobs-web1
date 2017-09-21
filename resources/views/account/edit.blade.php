@extends('layout.master')
@section('title', '修改资料')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

    <style>
        .edit-card {
            width: 100%;
            margin: 50px 0;
            padding-bottom: 20px;
        }

        .edit-panel {
            padding: 20px 32px;

        }

        .head-img--holder {
            display: inline-block;
            border: 2px dashed var(--divider);
            margin-right: 32px;
        }

        .base-info-holder {
            width: 500px;
            display: inline-block;
            vertical-align: top;
        }

        .head-img--holder .head-img {
            width: 100px;
            height: 100px;
            display: inline-block;
        }

        .head-img--holder span {
            display: inline-block;
            cursor: pointer;
            width: 100px;
            padding: 3px 10px;
            font-size: 14px;
            text-align: center;
        }

        .head-img--holder span:hover {
            background: var(--divider);
        }

        label[for="male"] {
            margin-right: 48px;
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

            <div class="edit-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                            to="/account/">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    <h5 class="mdl-card__title-text" style="margin-left: 16px;">个人资料修改</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border edit-panel">
                    <form class="edit-form" method="post" id="personal-info-change--form">
                        <div class="head-img--holder">
                            <img class="head-img" src="{{asset('images/default-img.png')}}"><br>
                            <input type="file" hidden name="head-img">
                            <span id="upload-head--img">上传头像</span>
                        </div>

                        <div class="base-info-holder">

                            <label for="name">名字</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="真实姓名">
                                </div>
                                <div class="help-info">将显示在简历中，建议填写真实姓名</div>
                                <label class="error" for="name"></label>
                            </div>

                            <label for="name">居住地</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="现居住城市">
                                </div>
                                <div class="help-info">将显示在简历中，建议填写：城市-区县</div>
                                <label class="error" for="name"></label>
                            </div>

                            <label for="name">户口所在地</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="户口所在地">
                                </div>
                                <div class="help-info">将显示在简历中，建议填写：省份-城市-区县</div>
                                <label class="error" for="name"></label>
                            </div>

                            <label for="name">性别</label>
                            <div class="form-group" style="margin-top: 8px;">
                                <div class="form-line">
                                    <input name="gender" type="radio" id="male" class="radio-col-light-blue" value="1"
                                           checked/>
                                    <label for="male">男</label>
                                    <input name="gender" type="radio" id="female" class="radio-col-light-blue"
                                           value="2"/>
                                    <label for="female">女</label>
                                </div>
                                <div class="help-info">将显示在简历中</div>
                            </div>

                            <label for="phone">联系电话</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="phone" name="phone" class="form-control phone"
                                           placeholder="可选，Ex: 999-9999-9999">
                                </div>
                                <div class="help-info">将显示在简历中</div>
                                <label class="error" for="phone"></label>
                            </div>

                            <label for="email">联系邮箱</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="email" name="email" class="form-control email"
                                           placeholder="可选，Ex: example@example.com">
                                </div>
                                <div class="help-info">将显示在简历中</div>
                                <label class="error" for="email"></label>
                            </div>

                            <label for="self-evaluation">自我评价</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="3" class="form-control" name="address" id="self-evaluation"
                                          placeholder="可选"></textarea>
                                </div>
                                <div class="help-info">将显示在简历中</div>
                                <label class="error" for="enterprise-address"></label>
                            </div>

                            <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认修改
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="edit-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                            to="/account/">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    <h5 class="mdl-card__title-text" style="margin-left: 16px;">公司资料修改</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border edit-panel">
                    <form class="edit-form" method="post" id="enterprise-info-change--form">
                        <div class="head-img--holder">
                            <img class="head-img" src="{{asset('images/default-img.png')}}"><br>
                            <input type="file" hidden name="head-img">
                            <span id="upload-head--img">上传Logo</span>
                        </div>

                        <div class="base-info-holder">

                            <label for="name">公司名称</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="name" name="name" class="form-control" value="公司名称"
                                           disabled="disabled">
                                </div>
                                <div class="help-info">公司名称只有在企业审核时修改</div>
                                <label class="error" for="name"></label>
                            </div>

                            <label for="name">所在城市</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="公司所在城市">
                                </div>
                                <div class="help-info">如果有多个办公城市，使用空格隔开</div>
                                <label class="error" for="name"></label>
                            </div>

                            <label for="enterprise-type">企业类型</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="enterprise-type" name="type">
                                    <option value="0">请选择企业类型</option>
                                    <option value="1">国有企业</option>
                                    <option value="2">民营企业</option>
                                    <option value="3">中外合资企业</option>
                                    <option value="4">外资企业</option>
                                </select>
                                <div class="help-info">将显示在已发布的职位详情中</div>
                                <label class="error" for="enterprise-type"></label>
                            </div>

                            <label for="enterprise-scale">企业规模</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="enterprise-scale" name="scale">
                                    <option value="0">请选择企业规模</option>
                                    <option value="1">少于50人</option>
                                    <option value="2">50人至200人</option>
                                    <option value="3">200至500人</option>
                                    <option value="4">500人至1000人</option>
                                    <option value="5">1000人以上</option>
                                </select>
                                <div class="help-info">将显示在已发布的职位详情中</div>
                                <label class="error" for="enterprise-scale"></label>
                            </div>

                            <label for="enterprise-url">公司官网</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="url" id="enterprise-url" name="url" class="url form-control"
                                           placeholder="可选，Ex：https://www.example.com">
                                </div>
                                <div class="help-info">将显示在已发布的职位详情中，请以 http://, https://开头</div>
                                <label class="error" for="enterprise-url"></label>
                            </div>

                            <label for="phone">公司联系电话</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="phone" name="phone" class="form-control phone"
                                           placeholder="可选，Ex: 999-9999-9999">
                                </div>
                                <div class="help-info">将显示在已发布的职位详情中</div>
                                <label class="error" for="phone"></label>
                            </div>

                            <label for="email">公司联系邮箱</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="email" name="email" class="form-control email"
                                           placeholder="可选，Ex: example@example.com">
                                </div>
                                <div class="help-info">将显示在已发布的职位详情中</div>
                                <label class="error" for="email"></label>
                            </div>

                            <label for="self-evaluation">公司简介</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="3" class="form-control" name="address" id="self-evaluation"
                                          placeholder="可选"></textarea>
                                </div>
                                <div class="help-info">将显示在已发布的职位详情中</div>
                                <label class="error" for="enterprise-address"></label>
                            </div>

                            <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                确认修改
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

    <script type="text/javascript">

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $editForm = $(".edit-form");
        $editForm.find(".email").inputmask({alias: "email"});
        $editForm.find(".phone").inputmask('999-9999-9999', {placeholder: '___-____-____'});

        $("#upload-head--img").click(function () {
            $("input[name='head-img']").click();
        })
    </script>
@endsection
