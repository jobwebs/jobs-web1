@extends('layout.master')
@section('title', '企业圈')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/business/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/business/screen.css')}}">
 
    <style>
        
    </style>
@endsection

@section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2, 'type'=>$data['type']])
@endsection

@section('content')
    <section class="content-wrap">
    <div class="container">
      <div class="row">
      <div class="col-md-12 main-content">

          <div class="widget post">
          企业圈用于企业之间的交流

            <div class="content pull-right">
              <a class="btn btn-danger" data-toggle="modal" data-target="#publish_info">发布合作</a>
            </div>
          </div>
      </div>
        <div class="col-md-12 main-content">
          
          <article class="post tag-feature tag-text featured">
            <div class="post-head">
              <h3 class="post-title">
                <a  data-toggle="modal" data-target="#watch_details" href="">这半个月我们更换了镜像服务器</a></h3>
              <div class="post-meta">
                <span class="author">地点：
                  <a target="_blank">上海</a></span>•
                <span class="date">2017-03-06</span></div>
            </div>
            <div class="post-content">
              <p>首先向各位使用 Packagist/Composer 中国全量镜像的小伙伴们致歉，镜像从 2 月 20 日起暂停了更新（镜像仍然是可用的，只是不继续缓存新增的 package 了），今天（3月6日）正式恢复了！</p>
            </div>
            <div class="post-permalink pull-right">
              <a class="btn btn-default" data-toggle="modal" data-target="#watch_details">查看详情</a></div>
          </article>
        </div>
      </div>
    </div>
  </section>
  <!-- 模态框（Modal） -->
  <div class="modal fade" id="watch_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" 
              aria-hidden="true">×
          </button>
          <h4 class="modal-title" id="myModalLabel">
            Composer 是什么
          </h4>
        </div>
        <div class="modal-body look-detail-modal-body">
          <img src="./img/details.jpg" alt="" class="img-rounded img-detail">
          如果您仔细查看上面的代码，您会发现在 标签中，data-target="#watch_details" 是您想要在页面上加载的模态框的目标。您可以在页面上创建多个模态框，然后为每个模态框创建不同的触发器。现在，很明显，您不能在同一时间加载多个模块，但您可以在页面上创建多个在不同时间进行加载。
          <ul>
            <li>联系我们：13588888888</li>
            <li>邮箱：2564315815@qq.com</li>
          </ul>
          <form role="form">
            <div class="form-group">
              <label for="name">站内信：</label>
              <textarea class="form-control" rows="3"></textarea>
            </div>
          </form>
        </div>
      
        <div class="modal-footer">
          <button type="button" class="btn btn-default" 
              data-dismiss="modal">关闭
          </button>
          <button type="button" class="btn btn-primary">
            提交信息
          </button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- 模态框（Modal） -->
  <div class="modal fade" id="publish_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" 
              aria-hidden="true">×
          </button>
          <h4 class="modal-title" id="myModalLabel">
            发布信息
          </h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label class="col-sm-2 control-label">标题</label>
              <div class="col-sm-10 col-lg-4">
                <input class="form-control" id="focusedInput" type="text"  value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">城市</label>
              <div class="col-sm-10 col-lg-4">
                <input class="form-control" id="focusedInput" type="text"  value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">手机</label>
              <div class="col-sm-10 col-lg-4">
                <input class="form-control" id="focusedInput" type="text"  value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">邮箱</label>
              <div class="col-sm-10 col-lg-4">
                <input class="form-control" id="focusedInput" type="text"  value="">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">详情</label>
              <div class="col-sm-10 col-lg-8">
                <textarea class="form-control publish-text" rows="6"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">图片</label>
              <div class="col-sm-10 col-lg-4">
                <input class="form-file" id="focusedInput" type="file"  value="">
                <img src="./img/details.jpg" alt="" class="img-rounded">
              </div>
            </div>
          </form>
        </div>
      
        <div class="modal-footer">
          <button type="button" class="btn btn-default" 
              data-dismiss="modal">关闭
          </button>
          <button type="button" class="btn btn-primary">
            发布信息
          </button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endsection

@section('custom-script')
    <!-- <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script> -->
    


    <script type="text/javascript">

    </script>
@endsection
