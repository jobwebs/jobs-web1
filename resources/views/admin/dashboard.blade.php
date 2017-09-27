@extends('layout.admin')
@section('title', '首页')

@section('custom-style')
    <style>
        .btn:hover,
        .btn:focus {
            color: var(--snow);
        }
    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'dashboard', 'subtitle'=>'', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">

        <h5>网站信息</h5>

        <button class="btn bg-teal waves-effect">修改公司电话</button>
        <button class="btn bg-teal waves-effect">修改公司邮箱</button>
        <button class="btn bg-teal waves-effect">修改公司地址</button>
        <button class="btn bg-teal waves-effect">修改公司工作时间</button>
        <button class="btn bg-teal waves-effect">修改副标题</button>
        <button class="btn bg-teal waves-effect">修改网站介绍</button>

    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">

    </script>
@show
