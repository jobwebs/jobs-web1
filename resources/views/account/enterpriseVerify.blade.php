@extends('layout.master')
@section('title', '企业号验证')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

    <style>
        .verify-card {
            width: 100%;
            margin: 50px 0;
            padding-bottom: 20px;
        }

        .verify-card > .mdl-card__title {
            padding-bottom: 3px;
        }

        .verify-card > .mdl-card__supporting-text {
            padding-top: 3px;
        }

        .verify-panel {
            padding: 8px 32px;
        }

        .verify-form {
            margin-top: 16px;
        }

        .verify-form .left-panel,
        .verify-form .right-panel{
            width:470px;
            display: inline-block;
            vertical-align: top;
            padding:20px 10px;
        }

        .verify-form .left-panel >h3,
        .verify-form .right-panel >h3 {
            font-size: 18px;
            font-weight: 300;
            margin: 0 0 30px 0;
            padding:10px 0 10px 10px;
            background: var(--divider-light);
            border-left: 5px solid var(--blue-sky);
        }

        .verify-form .right-panel{
            margin-left: 15px;
        }

        .verify-form > button[type='submit'] {
            margin-top: 20px;
            float: right;
        }

        .verify-form label {
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

        .license-img{
            min-width:100px;
            max-width:400px;
            min-height:100px;
            border:6px dashed var(--divider);
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

            <div class="verify-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">企业号验证</h5>
                </div>

                <div class="mdl-card__supporting-text">
                    通过企业号验证后即可发布职位，您提交的企业信息仅作为合法性审核使用。
                </div>

                <div class="mdl-card__actions mdl-card--border verify-panel">

                    <form class="verify-form">

                        <div class="left-panel">

                            <h3>企业审核所需内容，必填项</h3>
                            {{--必填项--}}
                            <label for="enterprise-name">企业名称</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="enterprise-name" name="name" class="form-control" placeholder="不能为空">
                                </div>
                                <label class="error" for="enterprise-name"></label>
                            </div>

                            <label for="enterprise-industry">所属行业</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="enterprise-industry" name="industry">
                                    <option value="0">请选择行业</option>
                                    <option value="1">行业一</option>
                                    <option value="2">行业二</option>
                                    <option value="3">行业三</option>
                                </select>
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
                            </div>

                            <label for="enterprise-url">企业官方网站</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="url" id="enterprise-url" name="url" class="form-control" placeholder="不能为空">
                                </div>
                                <div class="help-info">Starts with http://, https://, ftp:// etc</div>
                                <label class="error" for="enterprise-url"></label>
                            </div>

                            <label for="enterprise-id__card">法人身份证号</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="enterprise-id__card" name="id-card" class="form-control id-card"
                                           placeholder="不能为空">
                                </div>
                                <label class="error" for="enterprise-id__card"></label>
                            </div>

                            <label for="enterprise-license">企业营业执照</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" id="enterprise-license" name="license" class="form-control">
                                </div>
                            </div>

                            <img class="license-img" src="{{asset('images/default-img.png')}}" width="128px">
                        </div>


                        <div class="right-panel">
                            {{--选填项--}}
                            <h3>企业审核所需内容，选填项&nbsp;&nbsp;<small>(提供完整信息可加速审核进度)</small></h3>
                            <label for="enterprise-scale">企业规模</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="enterprise-scale" name="scale">
                                    <option value="0">请选择企业规模</option>
                                    <option value="1">少于50人</option>
                                    <option value="2">50人至200人</option>
                                    <option value="3">200人以上</option>
                                </select>
                            </div>

                            <label for="enterprise-email">企业邮箱</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="enterprise-email" name="email" class="form-control email"
                                           placeholder="可选，Ex: example@example.com">
                                </div>
                                <label class="error" for="enterprise-email"></label>
                            </div>

                            <label for="enterprise-phone">企业电话</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="enterprise-phone" name="phone" class="form-control"
                                           placeholder="可选，Ex: (999)999999">
                                </div>
                                <label class="error" for="enterprise-phone"></label>
                            </div>

                            <label for="enterprise-address">企业地址</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="3" class="form-control" name="address" id="enterprise-address"
                                          placeholder="可选，Ex: xx省 xx市 xx区/县  xxx街道xxx号"></textarea>
                                </div>
                                <label class="error" for="enterprise-address"></label>
                            </div>
                        </div>

                        <div style="clear: both;"></div>

                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            提交审核
                        </button>
                    </form>
                </div>

                <div class="mdl-card__actions mdl-card--border verify-panel">
                    <h3>您的企业号审核已经成功提交，请耐心等待。</h3>
                    <p>企业号审核通过后即可发布职位</p>
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

        $verifyForm = $(".verify-form");
        $verifyForm.find(".email").inputmask({alias: "email"});
        $verifyForm.find(".id-card").inputmask('999999 99999999 999*', {placeholder: '______ ________ ____'});
    </script>
@endsection
