<div class="header-nav">
    <div class="container">
        <!-- Title -->
        <div class="header-nav-title">
            <a href="/index">
                <img src="{{asset("images/logo-black1.png")}}" width="150px"/>
            </a>
            <small style="vertical-align: bottom; position: relative; bottom: 5px; left: 12px;"><?=$site_desc ?></small>
        </div>

        <!-- Add spacer, to align navigation to the right -->
        <!--<div class="spacer"></div>-->
        <!-- Navigation -->
        <nav class="nav">
            <ul class="nav navbar-nav navbar-right">
            @if($isLogged == true)
                <li class="user-logined" id="user-logined">
                    <div class="user-box">
                        <span >
                            <div class="user-img">
                                {{--这里需要对头像是否存在进行判断--}}
                                <img src="http://qzapp.qlogo.cn/qzapp/100414805/E1A18B430EC6C58B262F0FD237B1C785/100" width="28" height="28" alt="">
                            </div>
                            <div class="user-info">
                                <div class="clearfix">
                                    <p class="info-name fl "><a class="name" href="">
                                        @if($username != null)
                                                {{$username}}
                                            @else
                                                未命名
                                            @endif
                                        </a><a class="logout" href="/account/logout">退出</a></p>
                                </div>
                            </div>
                        </span>
                    </div>

                </li>
            @else
                    <li class="register-login m-l-65">
                        <a  class="btn btn-register-login" href="/account/login">登录</a></li>
                    <li class="register-login m-l-10">
                        <a class="btn btn-register-login" href="/account/register">注册</a></li>
            @endif
            {{--<a href="/about">关于我们</a>--}}



            </ul>
        </nav>
    </div>
</div>
