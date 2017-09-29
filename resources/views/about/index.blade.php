@extends('layout.master')
@section('title', '关于我们')

@section('custom-style')
    <style>
        body {
            background-color: var(--snow);
        }

        .header-post {
            width: 100%;
            height: 600px;
            background: url({{asset('images/akali_vs_baron_3.jpg')}}) no-repeat center;
        }

        .header-post .header-container {
            background: rgba(0, 0, 0, .5);
            height: 300px;
            vertical-align: bottom;
        }

        .header-post .container h2 {
            padding-top: 16px;
            color: var(--snow);
            font-size: 56px;
        }

        .header-post .container p {
            font-size: 20px;
            font-weight: 300;
            color: var(--snow);
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
            border-bottom: 1px solid var(--divider);
            display: block;
            -webkit-margin-before: 1em;
            -webkit-margin-after: 1em;
            -webkit-margin-start: 0px;
            -webkit-margin-end: 0px;
            clear: both;
        }

        .address-panel .container dl:first-child dd{
            border-top: 1px solid var(--divider);
        }

        .address-panel .container dl:first-child dt {
            border-top: 2px solid var(--text-color-primary);
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
            color: var(--cucumber);
        }

        dl dd span a[href] {
            color: var(--cucumber);
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
                    <?=$site_name ?>
                </h2>

                {{--<p>{{$data['about']->class}}</p>--}}
                <p>{{$data['about']->content}}</p>
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
                        <span class="secondary">
                            邮编：200433
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
                    <dd><span><a href="{{$data['email']->tel or '#'}}">{{$data['about']->tel or '邮箱未填写'}}</a></span>
                    </dd>
                </dl>

            </div>

            <div class="address-map">
                <div id="map" style="width:100%; height: 600px;"></div>
            </div>
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
            center: [104.0824931553, 30.6311756943]
        });

        AMap.plugin(['AMap.ToolBar', 'AMap.Scale'],
            function () {
                map.addControl(new AMap.ToolBar());

                map.addControl(new AMap.Scale());

                map.setStatus({scrollWheel: false});
            });

        marker = new AMap.Marker({
            position: [104.0824931553, 30.6311756943],
            title: "company name",
            map: map
        });
    </script>
@endsection
