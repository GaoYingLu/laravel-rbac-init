@extends('layouts.admin-app')

@section('content')
    <script src="/ckeditor-dev/ckeditor.js"></script>
    <script src="/ckeditor-dev/samples/js/sample.js"></script>

<div class="pageheader">
        <h2><i class="fa fa-home"></i> 当前位置: <span> {{ $title or null }} </span></h2>
    </div>

    <div class="contentpanel">

        <div class="row">


            <div class="col-sm col-lg">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">表单信息</h4>
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            @foreach ($errors->all() as $error)
                                <strong>{{ $error }}!</strong>
                            @endforeach
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>{{ session('error') }}!</strong>
                        </div>
                    @endif
                    <form class="form-horizontal form-bordered" enctype="multipart/form-data" action="/admin/doAddOrUpdateArticle" method="POST">
                        <input type="hidden" name="id" value="@if(isset($article->id)){{$article->id}}@endif">
                        <div class="panel-body panel-body-nopadding">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">分类 <span class="asterisk">*</span></label>

                                <div class="col-sm-1">
                                    <select class="form-control form-select width-346 input-sm" style="width: 300px;" name="cat_id" >
                                        <option>--请选择--</option>
                                        @if( !empty($category) )
                                            {{ \App\Logics\CategoryLogic::getTreeData($category, '&nbsp;&nbsp;', (isset($article->cat_id) ? $article->cat_id : 0)) }}
                                        @endif
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">标题 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="title" data-trigger="hover" class="form-control tooltips" data-original-title="请填写标题" value="{{ Input::old('title') }}{{ $article->title or null }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">简介</label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="intro" data-trigger="hover" class="form-control tooltips" data-original-title="不填写则自动截取内容" value="{{ Input::old('intro') }}{{ $article->intro or null }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">内容 <span class="asterisk">*</span></label>
                                <div class="col-sm-6">
                                    <textarea name="content" id="editor">{{ Input::old('content') }}{{ $article->content or null }}</textarea>
                                </div>
                            </div>

                            @if( isset($article->thumb_img) && $article->thumb_img )
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">当前缩略图</label>
                                    <div class="col-sm-6">
                                        <a href="{{ $article->thumb_img }}"><img src="{{ $article->thumb_img }}" width="200" height="160"></a>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="col-sm-1 control-label">缩略图</label>
                                <div class="col-sm-6">
                                    <input type="file" data-toggle="tooltip" name="thumb" data-trigger="hover" class="form-control tooltips" data-original-title="缩略图,不上传则显示默认图片" >
                                </div>
                            </div>

                            @if( isset($article->attachment) && $article->attachment )
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">当前附件</label>
                                    <div class="col-sm-6">
                                        <a href="{{$article->attachment}}">点击查看</a>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="col-sm-1 control-label">附件</label>

                                <div class="col-sm-6">
                                    <input type="file"  data-toggle="tooltip" name="attachment" data-trigger="hover" class="form-control tooltips" data-original-title="附件,可不上传" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">关键词</label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="keywords" data-trigger="hover" class="form-control tooltips" data-original-title="关键词,可为空" value="{{ Input::old('keywords') }}{{ $article->keywords or null }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">描述</label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="description" data-trigger="hover" class="form-control tooltips" data-original-title="描述,可为空" value="{{ Input::old('description') }}{{ $article->description or null }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">点击量</label>

                                <div class="col-sm-1">
                                    <input type="text"  data-toggle="tooltip" name="hits" data-trigger="hover" class="form-control tooltips" data-original-title="点击量,可为空" value="{{ Input::old('hits') }}{{ $article->hits or rand(1,10000) }}" >
                                </div>
                                <label class="col-sm-1 control-label">排序</label>

                                <div class="col-sm-1">
                                    <input type="text"  data-toggle="tooltip" name="sort" data-trigger="hover" class="form-control tooltips" data-original-title="排序,可为空" value="{{ Input::old('sort') }}{{ $article->sort or 0 }}" >
                                </div>

                                <label class="col-sm-1 control-label">显示样式</label>

                                <div class="col-sm-1">
                                    <select name="template" class="form-control input-sm">
                                        <option value="">Default</option>
                                        <option value="content_1" @if(isset($article->template) && $article->template == 'content_1')selected="selected"@endif>Content_1</option>
                                        <option value="content_2" @if(isset($article->template) && $article->template == 'content_2')selected="selected"@endif>Content_2</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <input type="submit" name="submit" value="保存" class="btn btn-primary">
                                    &nbsp;
                                    <input type="reset" name="reset" value="取消" class="btn btn-default">
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>

    <script data-sample="1">
        CKEDITOR.replace( 'editor', {
            height: 300,
            width:1300,

            // Configure your file manager integration. This example uses CKFinder 3 for PHP.
            //浏览服务器
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
            //上传
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '/uploadImg?command=QuickUpload&type=Images'
        } );
    </script>

    {{--<script>
        initSample(CKEDITOR.config.height=300, CKEDITOR.config.width=1300);
        CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.config.uploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json';
    </script>--}}
@endsection
