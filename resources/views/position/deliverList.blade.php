@extends('layout.master')
@section('title', '收到的申请记录')

@section('custom-style')
    <style>
        .apply-panel {
            padding: 0;
        }

        .apply-ul {
            width: 100%;
            display: block !important;
        }

        .apply-item {
            display: block !important;
            padding: 8px 16px;
            margin: 0;
            cursor: pointer;
            border-bottom: 1px solid var(--divider);
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .apply-item:hover {
            background-color: var(--divider-light);
        }

        .applier-info {
            width: 510px;
            display: inline-block;
            vertical-align: middle;
        }

        .applier-info > p {
            margin-bottom: 0;
            font-weight: 300;
        }

        .applier-info > p > small {
            color: var(--text-color-light);
        }

        .applier-info > p > span {
            font-size: 10px;
            cursor: pointer;
        }

        .applier-info > p > span:hover {
            color: var(--tomato);
        }

        .mdl-card__title-text {
            margin-left: 16px;
            position: relative;
            top: -3px;
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
            <div class="info-panel--left info-panel">
                <div class="mdl-card mdl-shadow--2dp base-info--resume info-card">
                    <div class="mdl-card__title">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                to="/account/">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <h5 class="mdl-card__title-text">收到投递记录</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border apply-panel">
                        <ul class="apply-ul">
                            @foreach([1,1,1,1,1] as $item)
                                <li class="apply-item" to="/position/deliverDetail">
                                    <img class="img-circle info-head-img" src="{{asset('images/avatar.png')}}"
                                         width="45px"
                                         height="45px">

                                    <div class="applier-info">
                                        <p>Jobs</p>
                                        <p>
                                            <small>申请时间:2017-08-16</small>
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div style="clear:both;"></div>

                        <div class="apply-empty">
                            <img src="{{asset('images/apply-empty.png')}}" width="50px">
                            <span>&nbsp;&nbsp;没有申请记录</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')

@endsection
