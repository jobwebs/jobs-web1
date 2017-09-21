@extends('layout.master')
@section('title', '申请记录')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .info-card .mdl-card__title small{
            font-size: 10px;
            font-weight: 300;
            margin-left: 24px;
            color: var(--text-color-secondary);
        }

        .apply-panel {
            min-height:500px;
            padding:0;
        }

        .apply-item {
            padding:16px;
            border-bottom: 1px solid var(--divider);
            cursor: pointer;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .apply-item > h5,
        .apply-item > p {
            margin:0;
            display: inline-block;
            width:450px;
            font-weight: 300;
        }

        .apply-item>span{
            float: right;
            vertical-align: middle;
            text-align: right;
            font-weight: 400;
            font-size: 13px;
        }

        .apply-item:hover {
            background-color: var(--divider);
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
            {{--info-panel--left --}}
            <div class="info-panel">
                <div class="mdl-card mdl-shadow--2dp base-info--resume info-card">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">我的申请记录</h5>
                        <small>仅保留近30天的申请记录</small>
                    </div>

                    <div class="mdl-card__actions mdl-card--border apply-panel">

                        <div class="apply-item">
                            <h5>市场专员</h5><br>
                            <p><span>广州市花都万穗小额贷款股份有限公司</span> | <span>申请时间：08-12</span></p>

                            <span class="normal-info">状态：已查阅</span>
                        </div>

                        <div class="apply-item">
                            <h5>市场专员</h5><br>
                            <p><span>广州市花都万穗小额贷款股份有限公司</span> | <span>申请时间：08-12</span></p>

                            <span class="danger-info">状态：已拒绝</span>
                        </div>

                        <div class="apply-item">
                            <h5>市场专员</h5><br>
                            <p><span>广州市花都万穗小额贷款股份有限公司</span> | <span>申请时间：08-12</span></p>

                            <span class="success-info">状态：已回复</span>
                        </div>

                        <div class="apply-item">
                            <h5>市场专员</h5><br>
                            <p><span>广州市花都万穗小额贷款股份有限公司</span> | <span>申请时间：08-12</span></p>

                            <span class="normal-info">状态：已查阅</span>
                        </div>

                        <div class="apply-item">
                            <h5>市场专员</h5><br>
                            <p><span>广州市花都万穗小额贷款股份有限公司</span> | <span>申请时间：08-12</span></p>

                            <span class="">状态：待查阅</span>
                        </div>

                        <div class="apply-item">
                            <h5>市场专员</h5><br>
                            <p><span>广州市花都万穗小额贷款股份有限公司</span> | <span>申请时间：08-12</span></p>

                            <span class="success-info">状态：已回复</span>
                        </div>

                        <div class="apply-item">
                            <h5>市场专员</h5><br>
                            <p><span>广州市花都万穗小额贷款股份有限公司</span> | <span>申请时间：08-12</span></p>

                            <span class="normal-info">状态：已查阅</span>
                        </div>

                        <div class="apply-empty">
                            <img src="{{asset('images/apply-empty.png')}}" width="50px">
                            <span>没有申请记录</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        $(".apply-item").click(function () {
            swal({
                title: "简历回复",
                text: "简历回复的内容显示在这里：9月21日 据台湾媒体报道今天上午10点，宏达电(HTC)举办重大讯息说明会上，HTC与谷歌共同宣布HTC以11亿美元出售手机业务给谷歌。这一消息已经得到HTC财务长沈道邦的确认。",
                cancelButtonText: "关闭",
                showCancelButton: true,
                showConfirmButton: false
            });

        });
    </script>
@endsection
