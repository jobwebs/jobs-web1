<div class="mdl-card mdl-shadow--2dp base-info--enterprise info-card">
    <div class="base-info__header">
        @if($info->elogo == null)
            <img class="img-circle info-head-img" src="{{asset('images/default-img.png')}}" width="70px"
                 height="70px">
        @else
            <img class="img-circle info-head-img" src="{{$info->elogo}}" width="70px"
                 height="70px">
        @endif

        <div class="base-info__title">
            <p><b>{{$info->ename or "公司名称未填写"}}</b></p>
            <p>{{$info->byname or "公司别名未填写"}}</p>
            <p>
                <span>
                    @if($info->industry == null)
                        行业未知
                    @else
                        @foreach($industry as $item)
                            @if($info->industry == $item->id)
                                {{$item->name}}
                            @endif
                        @endforeach
                    @endif
                </span> |
                <span>
                    @if($info->enature == null || $info->enature == 0)
                        企业类型未知
                    @elseif($info->enature == 1)
                        国有企业
                    @elseif($info->enature == 2)
                        民营企业
                    @elseif($info->enature == 3)
                        中外合资企业
                    @elseif($info->enature == 4)
                        外资企业
                    @endif
                </span> |
                <span>
                    @if($info->escale == null)
                        规模未知
                    @elseif($info->escale == 0)
                        10人以下
                    @elseif($info->escale == 1)
                        10～50人
                    @elseif($info->escale == 2)
                        50～100人
                    @elseif($info->escale == 3)
                        100～500人
                    @elseif($info->escale == 4)
                        500～1000人
                    @elseif($info->escale == 5)
                        1000人以上
                    @endif
                </span>
            </p>
        </div>
    </div>

    @if($isShowMenu === true)
        <div class="mdl-card__menu">
            <button class="mdl-button mdl-button--icon mdl-js-button" id="update-profile-enterprise" to="/account/edit">
                <i class="material-icons">mode_edit</i>
            </button>

            <div class="mdl-tooltip" data-mdl-for="update-profile-enterprise">
                修改资料
            </div>
        </div>
    @endif

    <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__title">
            <h6 class="mdl-card__title-text">公司简介</h6>
        </div>

        <div class="mdl-card__supporting-text">
            {{$info->ebrief or "公司简介暂无"}}
        </div>
        <button id="look_more" class="deliver-resume mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky" style="margin-left: 38%;">查看更多</button>
        
    </div>

    <ul class="mdl-list base-info__contact">
        <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon">open_in_new</i>
                @if($info->home_page == null || $info->home_page == "")
                    <a>公司主页未填写</a>
                @else
                    <a href="
                    @if(strpos($info->home_page, "http://") !== false ||strpos($info->home_page, "https://") !== false)
                        {{$info->home_page or '#'}}
                    @else
                            {!! "http://".$info->home_page !!}
                    @endif
                        " target="_blank" style="color: cornflowerblue;">{{$info->ename or "公司名称未填写"}}</a>
                @endif
            </span>
        </li>
        {{--<li class="mdl-list__item">--}}
        {{--<span class="mdl-list__item-primary-content">--}}
        {{--<i class="material-icons mdl-list__item-icon">phone</i>--}}
        {{--{{$info->etel or "手机号未填写"}}--}}
        {{--</span>--}}
        {{--</li>--}}
        {{--<li class="mdl-list__item">--}}
        {{--<span class="mdl-list__item-primary-content">--}}
        {{--<i class="material-icons mdl-list__item-icon">email</i>--}}
        {{--{{$info->email or "邮箱未填写"}}--}}
        {{--</span>--}}
        {{--</li>--}}
    </ul>

    @if($isShowFunctionPanel === true)
        <div style="clear: both;"></div>

        <div class="mdl-card__actions mdl-card--border base-info--user__functions">

            <span class="mdl-chip mdl-chip--contact" to="/message/">
                <span class="mdl-chip__contact mdl-color--green mdl-color-text--white">
                    @if($messageNum <= 9)
                        {{$messageNum}}
                    @else
                        9+
                    @endif
                </span>
                <span class="mdl-chip__text">未读消息</span>
            </span>

            <span class="verify-flag
                @if($info->is_verification == 1) verified @endif
                @if($info->is_verification == 0) unverified @endif
                    ">
                <i class="material-icons">verified_user</i>
                <span>@if($info->is_verification === 1) &nbsp;已认证 @elseif($info->is_verification === 0) 待审核 @else 点击进行认证 @endif</span>
            </span>

        </div>
    @elseif($is_tempuser != true)
        <div style="clear: both;"></div>

        <div class="mdl-card__actions mdl-card--border base-info--user__functions" style="height: 3.5rem;">
            <span class="verify-flag
                @if($info->is_verification == 1) verified @endif
            @if($info->is_verification == 0) unverified @endif
                    ">
                <i class="material-icons">verified_user</i>
                <span>@if($info->is_verification === 1) &nbsp;已认证 @elseif($info->is_verification === 0) 待审核 @else 点击进行认证 @endif</span>
            </span>
        </div>
    @endif
</div>
