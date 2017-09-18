<div class="mdl-card mdl-shadow--2dp base-info--enterprise info-card">
    <div class="base-info__header">
        <img class="img-circle info-head-img" src="{{asset('images/avatar.png')}}" width="70px"
             height="70px">

        <div class="base-info__title">
            <p>{{$info->ename or "公司名称未填写"}}</p>
            <p><span>{{$info->industry or "行业未知"}}</span> | <span>{{$info->enature or "企业类型未知"}}</span> |
                <span>{{$info->escale or "规模未知"}}人</span></p>
        </div>
    </div>

    @if($isShowMenu === true)
        <div class="mdl-card__menu">
            <button class="mdl-button mdl-button--icon mdl-js-button" id="update-profile-enterprise">
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
    </div>

    <ul class="mdl-list base-info__contact">
        <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon">open_in_new</i>
                <a href="{{$info->home_page or '#'}}" target="_blank">{{$info->ename or "公司名称未填写"}}</a>
            </span>
        </li>
        <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon">phone</i>
                {{$info->etel or "手机号未填写"}}
            </span>
        </li>
        <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon">email</i>
                {{$info->email or "邮箱未填写"}}
            </span>
        </li>
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
        </div>
    @endif
</div>
