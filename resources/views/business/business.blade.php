@extends('layout.master')
@section('title', '企业圈')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/business/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/business/screen.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/business/fileinput.min.css')}}">
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
    @include('components.headerTab', ['activeIndex' => 7, 'type'=>$data['type']])
@endsection

@section('content')
   <div class="paged archive-template">
  <!-- http://www.phpcomposer.com/ -->
  <section class="content-wrap">
    <div class="container">
      <div class="row">
          <div class="col-md-12 main-content">

              <div class="widget post">
              企业圈用于企业之间的交流-寻求相互间合作
                <div class="content pull-right">
                  <a class="btn btn-danger" to="business/publish">发布合作</a>
                </div>
              </div>
          </div>
          @foreach($data['cooperation'] as $item)
            <div class="col-md-12 main-content">
              <article class="post tag-feature tag-text featured">
                <div class="post-head">
                  <h3 class="post-title">
                    <a  data-toggle="modal" data-target="#watch_details" href="">{{$item->title}}</a></h3>
                  <div class="post-meta">
                    <span class="author">地点：
                      <a target="_blank">{{$item->city}}</a></span>•
                    <span class="date">{{$item->created_at}}</span></div>
                </div>
                <div class="post-content">
                  <p>{{str_replace("<br>","",mb_substr($item->content, 0, 100))}}</p>
                </div>
                <div class="post-permalink pull-right">
                  <a class="btn btn-default" data-toggle="modal" data-target="#watch_details">查看详情</a></div>
              </article>
            </div>
              @endforeach
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
</div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/business/fileinput.min.js')}}"></script>
    <script src="{{asset('plugins/business/fileinput_locale_de.js')}}"></script>
    <script>
        $("#file-1").fileinput({
            uploadUrl: 'uploasdf', // you must set a valid URL here else you will get an error
            allowedFileExtensions : ['jpg', 'png','gif'],
            overwriteInitial: false,
            maxFileSize: 1000,
            maxFilesNum: 1,
            //allowedFileTypes: ['image', 'video', 'flash'],
            slugCallback: function(filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
    </script>
@endsection
