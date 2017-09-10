@extends('layout.admin')
@section('title', 'Dashboard')

@section('custom-style')
    <style>

    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'dashboard', 'subtitle'=>''])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-indigo hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="content">
                    <div class="text">企业审核申请</div>
                    <div class="number" id="cu-applies-num"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-orange hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="content">
                    <div class="text">新用户</div>
                    <div class="number" id="cu-users-num"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">

    </script>
@show
