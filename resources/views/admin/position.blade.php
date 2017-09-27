@extends('layout.admin')
@section('title', '已发布职位')

@section('custom-style')
    <style>
        ul.mdl-menu,
        li.mdl-menu__item {
            padding: 0;
        }

        li.mdl-menu__item a {
            cursor: pointer;
            display: block;
            padding: 0 16px;
        }

        i.material-icons {
            cursor: pointer;
            margin-right: 12px;
        }
    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'position', 'subtitle'=>'', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        职位列表
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-admin-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>职位名称</th>
                            <th>职位描述</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['position'] as $position)
                            <tr>
                                <td>{{$position->pid}}</td>
                                <td>{{$position->title or '无'}}</td>
                                <td>{{substr($position->pdescribe, 0, 100)}}</td>

                                <td>
                                    @if($position->position_status == 1)
                                        <span class="label label-success">正常</span>
                                    @elseif($position->position_status == 2)
                                        <span class="label label-warning">已过期</span>
                                    @elseif($position->position_status == 3)
                                        <span class="label label-danger">已下架</span>
                                    @endif
                                </td>

                                <td>
                                    <i class="material-icons off-the-shelf" data-content="{{$position->pid}}">remove_circle</i>
                                    {{--<i class="material-icons on-the-shelf" data-content="{{$position->pid}}">file_upload</i>--}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">暂无职位</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <nav>
                {!! $data['position']->render() !!}
            </nav>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        $(".off-the-shelf").click(function () {
            var element = $(this);

            swal({
                type: "warning",
                title: "确认",
                text: "确定下架该职位吗？",
                confirmButtonText: "下架",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true
            }, function () {
                $.ajax({
                    url: "/admin/position/offposition?id=" + element.attr("data-content"),
                    type: "get",
                    success: function (data) {
                        checkResult(data['status'], "操作成功", data['msg'], null);
                        setTimeout(function () {
                            location.reload();
                        }, 1200);
                    }
                })
            })
        })
    </script>
@show
