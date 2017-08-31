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
                    <h5 class="mdl-card__title-text">个人资料修改</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border edit-panel">
                    <form class="edit-form">
                        <div class="head-img--holder">
                            <img class="head-img" src="{{asset('images/avatar.png')}}"><br>
                            <input type="file" hidden name="head-img">
                            <span id="upload-head--img">上传</span>
                        </div>

                        <div class="base-info-holder">

                            <label for="name">名字</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="不能为空">
                                </div>
                                <label class="error" for="name"></label>
                            </div>

                            <div class="form-group">
                                <input name="gender" type="radio" id="male" class="radio-col-light-blue" value="1" checked />
                                <label for="male">男</label>
                                <input name="gender" type="radio" id="female" class="radio-col-light-blue" value="2" />
                                <label for="female">女</label>
                            </div>

                            <label for="phone">电话</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="phone" name="phone" class="form-control phone"
                                           placeholder="可选，Ex: +86 999-9999-9999">
                                </div>
                                <label class="error" for="phone"></label>
                            </div>

                            <label for="email">邮箱</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="email" name="email" class="form-control email"
                                           placeholder="可选，Ex: example@example.com">
                                </div>
                                <label class="error" for="email"></label>
                            </div>

                            <label for="self-evaluation">自我评价</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="3" class="form-control" name="address" id="self-evaluation"
                                          placeholder="可选"></textarea>
                                </div>
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
        $editForm.find(".phone").inputmask('+86 999-9999-9999', { placeholder: '+86 ___-____-____' });


        $("#upload-head--img").click(function () {
            $("input[name='head-img']").click();
        })
    </script>
@endsection
