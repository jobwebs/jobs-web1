<header
        class="mdl-layout__header mdl-layout__header--seamed esh-layout__header {{$styles or null}}"
        id="{{empty($id) ? 'esh-layout-header' : $id}}"
>
    @isset($buttonLeft)
        <div class="mdl-layout-icon esh-layout-icon--left">
            <i class="material-icons esh-icon">{{is_string($buttonLeft) ? $buttonleft : 'navigate_before'}}</i>
        </div>
    @endisset

    @if(isset($rightContent) or isset($buttonRight))
        <div class="mdl-layout-icon esh-layout-icon--right">
            @if(!empty($rightContent))
                {!! $rightContent !!}
            @elseif(!empty($buttonRight))
                <i class="material-icons esh-icon">{{$buttonRight}}</i>
            @endif
        </div>
    @endif

    <div class="mdl-layout__header-row esh-layout__header-row {{(!empty($buttonLeft) or !empty($buttonRight)) ? 'esh-layout__header-row--has-button' : null}}">
        <span class="mdl-layout__title esh-layout__title">{{$title or '电竞猎人'}}</span>
    </div>
</header>