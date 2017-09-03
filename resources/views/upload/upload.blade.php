@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">文件上传</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url('account/enterpriseVerify/upload')}}" enctype="multipart/form-data"><!--enctype 必须要有-->
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label">请选择文件</label>

                            <div class="col-md-6">
                                <input id="file" type="text" class="form-control" name="eid" required  >
                                <input id="file1" type="file" class="form-control" name="ecertifi" required  >
                                <input id="file2" type="file" class="form-control" name="lcertifi" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    确认上传
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
