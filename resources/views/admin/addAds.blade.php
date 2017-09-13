@extends('layout.admin')
@section('title', 'Add Ads')

@section('custom-style')
    <style>
        .top-border {
            border-top: 1px solid var(--divider-light);
        }

        .operate-btn {
            height: 80px !important;
            margin-bottom: 16px !important;
            cursor: pointer !important;
        }

        .operate-content {
            min-height: 400px;
        }

        .operate-content > p {
            text-align: center;
            margin-top: 24px;
        }

        .preview-holder {
            margin: 16px 0;
        }

        .preview-holder .delete-image {
            cursor: pointer;
            font-size: 18px;
            margin-left: 8px;
            color: var(--tomato-dark);
            border: 2px solid var(--tomato);
            border-radius: 20px;
        }

        .preview-holder .delete-image:hover {
            background-color: var(--divider-light);
        }

        .image-preview img {
            border: 3px solid var(--divider-light);
        }

        .search-position {
            padding: 16px;
            background-color: var(--divider-light);
        }

        .search-position .form-line {
            width: 350px;
            display: inline-block;
            margin-right: 24px;
        }

        .search-position .form-line input {
            display: inline-block;
            width: 300px;
            background-color: var(--divider-light);
        }

        .big-image--ad,
        .small-image--ad,
        .word--ad {
            padding: 24px;
        }

    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'ad', 'subtitle'=>'addAds'])
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    发布广告
                </h2>
            </div>

            <div class="body">

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 operate-btn big-image--btn">
                    <div class="info-box-3 bg-indigo hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">crop_3_2</i>
                        </div>
                        <div class="content">
                            <div class="text">发布大图片广告</div>
                            <div class="number" id="cu-applies-num"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 operate-btn small-image--btn">
                    <div class="info-box-3 bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">crop_7_5</i>
                        </div>
                        <div class="content">
                            <div class="text">发布小图片广告</div>
                            <div class="number" id="cu-users-num"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 operate-btn word--btn">
                    <div class="info-box-3 bg-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">font_download</i>
                        </div>
                        <div class="content">
                            <div class="text">发布文字广告</div>
                            <div class="number" id="cu-users-num"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 operate-btn hiring--btn">
                    <div class="info-box-3 bg-red hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">whatshot</i>
                        </div>
                        <div class="content">
                            <div class="text">设置急聘职位</div>
                            <div class="number" id="cu-users-num"></div>
                        </div>
                    </div>
                </div>

                <div style="clear:both;"></div>
            </div>

            <div class="top-border operate-content">
                <p class="undefined-type">请先选择操作类型</p>

                <div class="big-image--ad">

                    <h4>发布大图片广告</h4>

                    <form role="form" method="post" id="add-big-image--form">
                        <div class="input-group">
                            <div class="form-line">
                                <input type="file" id="picture-big" name="picture-big" class="form-control"
                                       onchange='showBigPreview(this)'/>
                            </div>
                            <div class="help-info" for="picture-big">.jpg 或 .png格式，330×150 像素</div>
                            <label id="picture-big-error" class="error" for="picture-big"></label>
                        </div>

                        <div id="preview-holder-big" class="preview-holder">
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="title-big" name="title-big" class="form-control"
                                       placeholder="标题，例如公司名称" required>
                            </div>
                            <label id="title-big-error" class="error" for="title-big"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="subtitle-big" name="subtitle-big" class="form-control"
                                       placeholder="副标题，例如公司介绍／职位" required>
                            </div>
                            <label id="subtitle-big-error" class="error" for="subtitle-big"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="url-word" name="url-word" class="form-control"
                                       placeholder="链接">
                            </div>
                            <div class="help-info" for="url-word">公司网址链接，可以为空</div>
                            <label id="url-word-error" class="error" for="url-word"></label>
                        </div>

                        <label for="big-image--location">位置</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="big-image--location"
                                    name="big-image--location">
                                <option value="0">请选择广告位置</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            发布
                        </button>
                    </form>
                </div>

                <div class="small-image--ad">

                    <h4>发布小图片广告</h4>

                    <form role="form" method="post" id="add-small-image--form">
                        <div class="input-group">
                            <div class="form-line">
                                <input type="file" id="picture-small" name="picture-small" class="form-control"
                                       onchange="showSmallPreview(this)"/>
                            </div>
                            <div class="help-info" for="picture">.jpg 或 .png格式，330×100 像素</div>
                            <label id="picture-error" class="error" for="picture"></label>
                        </div>

                        <div id="preview-holder-small" class="preview-holder">
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="title-small" name="title-small" class="form-control"
                                       placeholder="标题，例如公司名称"
                                       required>
                            </div>
                            <label id="title-small-error" class="error" for="title-small"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="url-word" name="url-word" class="form-control"
                                       placeholder="链接">
                            </div>
                            <div class="help-info" for="url-word">公司网址链接，可以为空</div>
                            <label id="url-word-error" class="error" for="url-word"></label>
                        </div>

                        <label for="small-image--location">位置</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="small-image--location"
                                    name="small-image--location">
                                <option value="0">请选择广告位置</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            发布
                        </button>
                    </form>
                </div>

                <div class="word--ad">
                    <h4>发布文字广告</h4>

                    <form role="form" method="post" id="add-word--form">

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="title-word" name="title-word" class="form-control"
                                       placeholder="公司名称"
                                       required>
                            </div>
                            <label id="title-word-error" class="error" for="title-word"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="url-word" name="url-word" class="form-control"
                                       placeholder="链接">
                            </div>
                            <div class="help-info" for="url-word">公司网址链接，可以为空</div>
                            <label id="url-word-error" class="error" for="url-word"></label>
                        </div>

                        <label for="word--location">位置</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="word--location"
                                    name="word--location">
                                <option value="0">请选择广告位置</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            发布
                        </button>
                    </form>
                </div>
                <div class="hiring--ad">
                    <div class="input-group">
                        <div class="search-position">

                            <div class="form-line">
                                <input type="text" id="position-title" name="position-title" class="form-control"
                                       placeholder="搜索职位名称">
                                <button class="mdl-button mdl-button--icon mdl-js-button" id="publish-position">
                                    <i class="material-icons">search</i>
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped" id="cu-admin-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>职位名称</th>
                                    <th>公司名称</th>
                                    <th>是否急聘</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse([1,2,3,4,5] as $position)
                                    <tr>
                                        <td>{{$position}}</td>
                                        <td>position title</td>
                                        <td>company name</td>
                                        <td>N</td>
                                        <td>
                                            <button>设为急聘</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">暂无广告</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        var bigImageAd = $(".big-image--ad");
        var smallImageAd = $(".small-image--ad");
        var wordAd = $(".word--ad");
        var hiringAd = $(".hiring--ad");

        var undefinedType = $(".undefined-type");

        bigImageAd.hide();
        smallImageAd.hide();
        wordAd.hide();
        hiringAd.hide();

        $(".big-image--btn").click(function (event) {
            undefinedType.hide();
            smallImageAd.hide();
            wordAd.hide();
            hiringAd.hide();

            bigImageAd.fadeIn(500);
        });

        $(".small-image--btn").click(function (event) {
            undefinedType.hide();
            bigImageAd.hide();
            wordAd.hide();
            hiringAd.hide();

            smallImageAd.fadeIn(500);
        });

        $(".word--btn").click(function (event) {
            undefinedType.hide();
            bigImageAd.hide();
            smallImageAd.hide();
            hiringAd.hide();

            wordAd.fadeIn(500);
        });

        $(".hiring--btn").click(function (event) {
            undefinedType.hide();
            bigImageAd.hide();
            smallImageAd.hide();
            wordAd.hide();

            hiringAd.fadeIn(500);
        });

        function showBigPreview(element) {
            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            $("#preview-holder-big").html("<div class='image-preview'>" +
                "<img src='" + objectUrl + "' width='300' height='150'>" +
                "<i class='material-icons delete-image' onclick='deleteBigImage(this)'>close</i></div>");
        }

        function showSmallPreview(element) {
            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            $("#preview-holder-small").html("<div class='image-preview'>" +
                "<img src='" + objectUrl + "' width='300' height='110'>" +
                "<i class='material-icons delete-image' onclick='deleteSmallImage(this)'>close</i></div>");
        }

        function deleteBigImage(element) {

            var imageHolder = element.parentNode;

            swal({
                title: "确认",
                text: "确认删除图片吗",
                type: "info",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                swal("图片已删除");
                $("#picture-big").val(null);
                imageHolder.remove();
            });
        }

        function deleteSmallImage(element) {

            var imageHolder = element.parentNode;

            swal({
                title: "确认",
                text: "确认删除图片吗",
                type: "info",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                swal("图片已删除");
                $("#picture-small").val(null);
                imageHolder.remove();
            });
        }
    </script>
@show
