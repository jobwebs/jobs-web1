<div class="mdl-card mdl-shadow--2dp base-info--user info-card">

    <div class="base-info__header">
        <img class="img-circle info-head-img" src="{{asset('images/avatar.png')}}" width="70px"
             height="70px">

        <div class="base-info__title">
            <p>Jobs</p>
            <p><span>男</span> | <span>23岁</span> | <span>现居吉尔吉斯斯坦</span></p>
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
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Mauris sagittis pellentesque lacus eleifend lacinia...
        </div>
    </div>

    <ul class="mdl-list base-info__contact">
        <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon">phone</i>
                12348582784
            </span>
        </li>
        <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon">email</i>
                emailaddress@email.com
            </span>
        </li>
    </ul>

    @if($isShowFunctionPanel === true)
        <div style="clear: both;"></div>

        <div class="mdl-card__actions mdl-card--border base-info--user__functions">
            <span class="mdl-chip mdl-chip--contact" to="/position/applyList">
                <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">9+</span>
                <span class="mdl-chip__text">申请记录</span>
            </span>

            <span class="mdl-chip mdl-chip--contact" to="/message/">
                <span class="mdl-chip__contact mdl-color--green mdl-color-text--white">9+</span>
                <span class="mdl-chip__text">站内信</span>
            </span>
        </div>
    @endif
</div>
