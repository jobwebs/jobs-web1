@extends('layout.admin')
@section('title', 'Enterprise')

@section('custom-style')
    <style>

    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'enterprise', 'subtitle'=>''])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        企业列表
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-apply-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>企业名称</th>
                            <th>法人姓名</th>
                            <th>审核状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse([1] as $enterprise)
                            <tr>
                                <td>{{$enterprise}}</td>
                                <td>企业名称{{$enterprise}}</td>
                                <td>法人</td>
                                <td>未审核</td>
                                <td>
                                    <button data-toggle='modal' data-target='#detailApplyModal'>审核</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">暂无企业入住</td>
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
    <div class="modal fade" id="detailApplyModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">企业详情/审核</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="cu-apply-detail-table">
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect" onclick="passApply()">审核通过</button>
                    <button type="button" class="btn btn-danger waves-effect" onclick="denyApply()">审核拒绝</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">

    </script>
@show
