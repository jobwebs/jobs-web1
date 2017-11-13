<div class="header-tab">
    <div class="container">
        @if($activeIndex === 1)
            <a href="/index" class="mdl-layout__tab is-active">首页</a>
        @else
            <a href="/index" class="mdl-layout__tab">首页</a>
        @endif

        @if($activeIndex === 3)
            <a href="/position/advanceSearch" class="mdl-layout__tab is-active">职位搜索</a>
        @else
            <a href="/position/advanceSearch" class="mdl-layout__tab">职位搜索</a>
        @endif

         @if($activeIndex === 6)
             <a href="/resume/advanceSearch" class="mdl-layout__tab is-active">大神库</a>
         @else
             <a href="/resume/advanceSearch" class="mdl-layout__tab">大神库</a>
         @endif

        @if($activeIndex === 4)
            <a href="/news" class="mdl-layout__tab is-active">资讯中心</a>
        @else
            <a href="/news" class="mdl-layout__tab">资讯中心</a>
        @endif

        @if($activeIndex === 2)
            @if($type === 1)
                <a href="/account" class="mdl-layout__tab is-active">个人中心</a>
            @elseif($type ===2)
                <a href="/account" class="mdl-layout__tab is-active">企业中心</a>
            @endif
        @else
            @if($type === 1)
                <a href="/account" class="mdl-layout__tab">个人中心</a>
            @elseif($type ===2)
                <a href="/account" class="mdl-layout__tab">企业中心</a>
            @endif
        @endif
        {{--@if($activeIndex === 7)--}}
             {{--<a href="/business" class="mdl-layout__tab is-active">企业圈</a>--}}
        {{--@else--}}
             {{--<a href="/business" class="mdl-layout__tab">企业圈</a>--}}
        {{--@endif--}}
        @if($activeIndex === 5)
            <a href="/about" class="mdl-layout__tab is-active">关于我们</a>
        @else
            <a href="/about" class="mdl-layout__tab">关于我们</a>
        @endif
        @if($activeIndex === 7)
            <a href="/business" class="mdl-layout__tab is-active">企业圈</a>
        @else
            <a href="/business" class="mdl-layout__tab">企业圈</a>
        @endif
        <div style="clear: both;"></div>
    </div>
</div>
