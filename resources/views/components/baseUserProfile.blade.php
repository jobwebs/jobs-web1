<div class="mdl-card mdl-shadow--2dp base-info--user info-card">

    <div class="base-info__header">
        <img class="img-circle info-head-img" src="{{asset('images/avatar.png')}}" width="70px"
             height="70px">

        <div class="base-info__title">
            <p>{{$info->pname or "姓名未填写"}}</p>
            <p><span>{{$info->sex or "性别未填写"}}</span> |
                <span>{{$info->birthday or "生日未填写"}}</span> |
                <span>
                    @if($info->residence == null)
                        居住地未填写
                    @else
                        {{$info->residence}}
                    @endif
                </span>
            </p>
        </div>
    </div>

    @if($isShowFunctionPanel === true)
        <div class="mdl-card__menu">
            <button class="mdl-button mdl-button--icon mdl-js-button" id="update-profile-user" to="/account/edit">
                <i class="material-icons">mode_edit</i>
            </button>

            <div class="mdl-tooltip" data-mdl-for="update-profile-user">
                修改资料
            </div>
        </div>
    @endif

    <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__title">
            <h6 class="mdl-card__title-text">自我评价</h6>
        </div>

        <div class="mdl-card__supporting-text">
            {{$info->self_evalu or "自我评价未填写"}}
        </div>
    </div>

    <ul class="mdl-list base-info__contact">
        <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon">phone</i>
                {{$info->tel or "手机号未填写"}}
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
            <span class="mdl-chip mdl-chip--contact" @if($deliveredNum != 0) to="/position/applyList" @endif>
                <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">
                     @if($deliveredNum <= 9)
                        {{$deliveredNum}}
                    @else
                        9+
                    @endif
                </span>
                <span class="mdl-chip__text">申请记录</span>
            </span>

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
