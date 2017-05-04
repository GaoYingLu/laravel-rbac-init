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
                    <form class="form-horizontal form-bordered" enctype="multipart/form-data" action="/admin/doModifyEnvConfig" method="POST">
                        <div class="panel-body panel-body-nopadding">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">配置信息: <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <textarea cols="120" rows="20" name="value">{{ $config }}</textarea>
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

    <script>
        initSample(CKEDITOR.config.height=300, CKEDITOR.config.width=1300);
    </script>
@endsection
