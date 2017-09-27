@extends('layout.master')
@section('title', '申请记录')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .info-card .mdl-card__title small {
            font-size: 10px;
            font-weight: 300;
            margin-left: 24px;
            color: var(--text-color-secondary);
        }

        .apply-panel {
            min-height: 500px;
            padding: 0;
        }

        .apply-item {
            padding: 16px;
            border-bottom: 1px solid var(--divider);
            cursor: pointer;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .apply-item > h5,
        .apply-item > p {
            margin: 0;
            display: inline-block;
            width: 450px;
            font-weight: 300;
        }

        .apply-item > span {
            float: right;
            vertical-align: middle;
            text-align: right;
            font-weight: 400;
            font-size: 13px;
        }

        .apply-item:hover {
            background-color: var(--divider);
        }

        .mdl-card__title-text {
            position: relative;
            top: -3px;
            margin-left: 16px;
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
    @include('components.headerTab', ['activeIndex' => 2, 'type'=>$data['type']])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">
            {{--info-panel--left --}}
            <div class="info-panel">
                <div class="mdl-card mdl-shadow--2dp base-info--resume info-card">
                    <div class="mdl-card__title">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                to="/account/">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <h5 class="mdl-card__title-text">我的申请记录</h5>
                        <small>仅保留近30天的申请记录</small>
                    </div>

                    <div class="mdl-card__actions mdl-card--border apply-panel">
                        @forelse($data["applylist"]["list"] as $position)
                            <div class="apply-item" data-content="{{$position->fbinfo}}">
                                <h5>职位名称：{{$position->title}}</h5><br>
                                <p style="margin-top: 8px;">
                                    <span>公司名称：{{$data['applylist']['ename'][$position->eid]->ename}}</span>
                                    <span style="margin-left: 32px;">申请时间：{{$position->created_at}}</span></p>
                                @if($position->status == 0)
                                    <span class="normal-info">状态：投递成功</span>
                                @elseif($position->status == 1)
                                    <span class="normal-info">状态：企业已查看</span>
                                @elseif($position->status == 2)
                                    <span class="success-info">状态：已录用</span>
                                @elseif($position->status == 3)
                                    <span class="danger-info">状态：未录用</span>
                                @elseif($position->status == 4)
                                    <span class="danger-info">状态：职位已失效</span>
                                @endif
                            </div>
                        @empty
                            <div class="apply-empty">
                                <img src="{{asset('images/apply-empty.png')}}" width="50px">
                                <span>没有申请记录</span>
                            </div>
                        @endforelse

                        <nav>
                            {!! $data["applylist"]["list"]->render() !!}
                        </nav>
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

            var feedback;
            if ($(this).attr("data-content") === "") {
                feedback = "暂无回复，当企业回复您的简历时，我们会通过站内信通知您"
            } else {
                feedback = $(this).attr("data-content");
            }

            swal({
                title: "企业回复",
                text: feedback,
                cancelButtonText: "关闭",
                showCancelButton: true,
                showConfirmButton: false
            });

        });
    </script>
@endsection
