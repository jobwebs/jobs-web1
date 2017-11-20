@extends('layout.master')
@section('title', '关于我们')

@section('custom-style')
    <style>
        body {
            background-color: #ffffff;
        }

        .header-post {
            width: 100%;
            height: 600px;
            background: url({{asset('images/about.jpg')}}) no-repeat center;
        }

        .header-post .header-container {
            background: rgba(0, 0, 0, .5);
            height: 300px;
            vertical-align: bottom;
        }

        .header-post .container h2 {
            padding-top: 16px;
            color: #ffffff;
            font-size: 56px;
        }

        .header-post .container p {
            font-size: 20px;
            font-weight: 300;
            color: #ffffff;
            line-height: 24px;
        }

        .address-panel {
            position: relative;
            width: 100%;
        }

        .address-panel {
            min-height: 600px;
        }

        .address-map {
            position: absolute;
            top: 0;
            right: 0;
            width: 35%;
            min-height: 600px;
        }


        .address-panel .container {
            padding:60px 0 60px 0;
        }

        .address-panel .container dl {
            width:600px;
            border-bottom: 1px solid #ebebeb;
            display: block;
            -webkit-margin-before: 1em;
            -webkit-margin-after: 1em;
            -webkit-margin-start: 0px;
            -webkit-margin-end: 0px;
            clear: both;
        }

        .address-panel .container dl:first-child dd{
            border-top: 1px solid #ebebeb;
        }

        .address-panel .container dl:first-child dt {
            border-top: 2px solid #232323;
        }

        dl dt,
        dl dd {
            display:block;
            font-size: 18px;
        }

        dl dd {
            padding-left: 25%;
        }

        dl dt {
            float: left;
            width:25%;
            margin:0;
            display: block;
            font-weight: 400;
        }

        dl dt span,
        dl dd span{
            padding: 20px 25px;
            display: block;
        }

        dl dd span.secondary{
            padding: 0 25px 20px 25px;
            color: #4CAF50;
        }

        dl dd span a[href] {
            color: #4CAF50;
            font-weight: 400;
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

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 5,'type' =>$data['type']])
@endsection

@section('content')

    <div class="header-post">
        <div style="height: 300px;"></div>
        <div class="header-container">
            <div class="container">
                <h2>
                    关于我们
                </h2>

                {{--<p>{{$data['about']->class}}</p>--}}
                <p>
                    {{--{{$data['about']->content}}--}}
                    我们是全国第一家专注电子竞技行业的垂直招聘网站。<br>
                    电竞及相关企业可以通过我方平台寻找人才，企业之间也能在线上互相寻求合作。<br>
                    中国电竞行业今非昔比，人才的需求以白热化速度在增长，行业规范化以及专业化任重而道远。<br>
                    我们目标为电竞行业稳定发展走出坚实的一步。
                </p>
            </div>
        </div>
    </div>

    <div class="address-panel">

        <div class="address-panel">
            <div class="container">

                <dl>
                    <dt><span>地址</span></dt>
                    <dd>
                        <span>{{$data['about']->address or '地址未填写'}}</span>
                        {{--<span class="secondary">--}}
                            {{--邮编：200021--}}
                        {{--</span>--}}
                        <span class="secondary" style="color: #333333">
                        邮编：200021
                        </span>
                    </dd>
                </dl>

                {{--<dl>--}}
                {{--<dt><span>工作时间</span></dt>--}}
                {{--<dd>--}}
                {{--<span>工作日 <br>--}}
                {{--{{$data['about']->wordk_time or '工作时间未填写'}}--}}
                {{--</span>--}}
                {{--<span class="secondary">周末休息--}}
                {{--</span>--}}
                {{--</dd>--}}
                {{--</dl>--}}

                <dl>
                    <dt><span>电话</span></dt>
                    <dd><span>{{$data['about']->tel or '联系电话未填写'}}</span></dd>
                </dl>

                <dl>
                    <dt><span>邮箱</span></dt>
                    <dd><span>{{$data['about']->email or '邮箱未填写'}}</span>
                    </dd>
                </dl>
                <div class="address-map">
                    <div id="map" style="width:100%; height: 600px;"></div>
                </div>
            </div>

            {{--<div class="address-map">--}}
                {{--<div id="map" style="width:100%; height: 600px;"></div>--}}
            {{--</div>--}}
        </div>

        <div style="clear: both;"></div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript"
            src="http://webapi.amap.com/maps?v=1.3&key=e143b33668668e4b9be611be3584b0e7"></script>
    <script>

        map = new AMap.Map('map', {
            resizeEnable: true,
            zoom: 13,
            center: [121.48944, 31.228947]
        });

        AMap.plugin(['AMap.ToolBar', 'AMap.Scale'],
            function () {
                map.addControl(new AMap.ToolBar());

                map.addControl(new AMap.Scale());

                map.setStatus({scrollWheel: false});
            });

        marker = new AMap.Marker({
            position: [121.48944, 31.228947],
            title: "company name",
            map: map
        });
    </script>
@endsection
