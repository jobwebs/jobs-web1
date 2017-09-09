@extends('layout.admin')
@section('title', 'Admin')

@section('custom-style')
    <style>
        ul.mdl-menu,
        li.mdl-menu__item {
            padding: 0;
        }

        a[data-toggle="modal"] {
            cursor: pointer;
            display: block;
            padding: 0 16px;
        }
    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'admin', 'subtitle'=>''])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        管理员列表
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a data-toggle="modal" data-target="#addAdminModal">添加管理员</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-admin-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>管理员名</th>
                            <th>是否可用</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse([1,2,3,4,5] as $admin)
                            <tr>
                                <td>{{$admin}}</td>
                                <td>admin</td>
                                <td>可用</td>
                                <td>
                                    <button>delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">暂无管理员</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dialogs ====================================================================================================================== -->
    <!-- Default Size -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">添加一个管理员</h4>
                </div>
                <form role="form" method="post" id="add_admin_form">
                    <div class="modal-body">

                        <label for="username">登录名</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="username" name="username" class="form-control"
                                       placeholder="登录名(支持:数字 字母 汉字 下滑线)">
                            </div>
                            <label id="username-error" class="error" for="username"></label>
                        </div>

                        <label for="password">密码</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="password" id="password" name="password" class="form-control"
                                       placeholder="密码至少六位">
                            </div>
                            <label id="password-error" class="error" for="password"></label>
                        </div>

                        <label for="password">确认密码</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="confirm_password" name="password_confirm"
                                       class="form-control"
                                       placeholder="再次输入密码">
                            </div>
                            <label id="confirm-password-error" class="error" for="confirm_password"></label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect">添加</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">

    </script>
@show
