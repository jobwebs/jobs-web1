@extends('layout.master')
@section('title', '新闻详情')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">

    <style>
        .news-detail .mdl-card__title h5 {
            font-size: 24px !important;
            font-weight: 500 !important;
        }

        .base-info--panel {
            text-align: right;
            padding: 4px 0;
        }

        .base-info--panel label {
            margin-right: 20px;
        }

        .base-info--panel label i,
        .base-info--panel label span {
            vertical-align: middle;
            font-size: 14px;
            font-weight: 300;
            color: var(--text-color-secondary);
        }

        .news-detail .mdl-card__supporting-text {
            width: 100%;
            color: var(--text-color-secondary);
        }

        .news-detail .mdl-card__supporting-text img {
            width: 100%;
            margin-bottom: 8px;
        }

        .comment-card {
            padding: 12px;
            min-height: 0;
        }

        #btn-comment {
            margin-top: 12px;
            float: right;
        }

        .comment-list--panel {
            margin-top: 12px;
        }

        .comment-item .head-img {
            border-radius: 24px;
            padding: 3px;
            background-color: var(--divider-light);
            vertical-align: top;
        }

        .comment-content {
            display: inline-block;
            width: 300px;
            margin-left: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            margin-bottom: 12px;
        }

        .comment-content p {
            margin-bottom: 0;
        }

        .comment-content span {
            font-size: 12px;
            display: inline-block;
            color: var(--text-color-secondary);
            font-weight: 300;
            padding: 3px 0 6px 0;
        }

    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => true])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 4])
@endsection

@section('content')

    <div class="info-panel">
        <div class="container">
            <div class="info-panel--left info-panel">
                <div class="mdl-card mdl-shadow--2dp info-card news-detail">
                    <div class="mdl-card__title">
                        <h5 class="mdl-card__title-text">
                            {{$detail['news']->title}}
                        </h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border base-info--panel">
                        <label><span>作者: {{$detail['news']->uid}}</span></label>
                        <label><span>{{$detail['news']->created_at}}</span></label>
                        <label><i class="material-icons">visibility</i>
                            <span>{{$detail['news']->view_count}}</span></label>
                        <label><i class="material-icons">comment</i> <span>{{sizeof($detail['review'])}}</span></label>
                    </div>


                    <div class="mdl-card__supporting-text">
                        <p>
                            {{$detail['news']->content}}
                        </p>

                        <p>
                            不知大家对前段时间很火的“兰州拉面海报”是否还记忆犹新？以拉面、盖浇饭、泡馍等代表性主食为素材，与各种字体创意结合后，
                            一张张令人垂涎欲滴的美食海报立即横扫朋友圈，众人惊呼原来兰州拉面看起来也如此具有食欲！
                        </p>

                        <label class="image-title">兰州拉面 X 汉仪悠然体简</label>
                        <img src="{{asset('images/lamian-post.jpg')}}">


                        <label class="image-title">马子禄牛肉面</label>
                        <img src="{{asset('images/lamian-detail1.jpg')}}"/>

                        <p>
                            这么看来之前对于兰州拉面的了解实在是少之又少，印象里的兰州拉面便只有面上飘着几块牛肉片，再撒点带着特殊气息的香菜。
                            但人家能被誉为“中华第一面”必定有它的玄妙所在，所以在小编对兰州拉面历史深扒的过程中，又发现了另一张王牌——马子禄牛肉面。
                        </p>

                        <p>
                            “马子禄”创建于兰州，拥有一百年以上的历史，是唯一一家入选“中华老字号”的兰州拉面店。虽然没吃过，但是光听名头就觉得
                            味道应该差不了。
                        </p>

                        <p>
                            如今，马子禄竟然将“中华老字号”的兰州拉面开到了日本，继续发扬光大我们的中华饮食文化，此处点32个赞。
                        </p>

                        <label class="image-title">马子禄牛肉面</label>
                        <img src="{{asset('images/lamian-detail2.jpg')}}">
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">

                <div class="comment-panel">
                    <div class="mdl-card info-card comment-card">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="2" class="form-control" name="comment"
                                          id="additional-content"
                                          placeholder="写点什么..."></textarea>
                            </div>

                            <button id="btn-comment"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                评论
                            </button>
                        </div>
                    </div>

                    <h6>评论列表</h6>

                    <div class="mdl-card__actions mdl-card--border comment-list--panel">

                        @if(sizeof($detail['review']) === 0)
                            <p>暂无评论</p>
                        @else
                            @foreach($detail['review'] as $comment)
                                <div class="comment-item">
                                    <img src="{{asset('images/avatar.png')}}" class="head-img" width="48" height="48"/>

                                    <div class="comment-content">
                                        <p>
                                            Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas
                                            nec
                                            odio et
                                            ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
                                        </p>
                                        <span>2018-8-24 12:45:78</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript">

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });
    </script>
@endsection
