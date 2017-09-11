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
        {{--TODO 这里设置一些快速进入某些常用功能的入口，基本信息的统计展示--}}
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">

    </script>
@show
