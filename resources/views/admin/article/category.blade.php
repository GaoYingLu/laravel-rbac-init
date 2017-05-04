@extends('layouts.admin-app')

@section('content')

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

                    @if (session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>{{ session('success') }}!</strong>
                        </div>
                    @endif
                    <form class="form-horizontal form-bordered" action="/admin/doAddOrUpdateCategory" method="POST">
                        @if( isset($cateInfo->id) )
                            <input type="hidden" name="id" value="{{ $cateInfo->id }}">
                        @endif
                        <div class="panel-body panel-body-nopadding">

                            <div class="form-group">
                                <label class="col-sm-1 control-label">分类 <span class="asterisk">* </span></label>

                                <div class="col-sm-1">
                                    <select class="form-control form-select width-346 input-sm" style="width: 400px;" name="pid" >
                                        <option value="0">--顶级分类--</option>
                                        @if( !empty($category) )
                                            {{ \App\Logics\CategoryLogic::getTreeData($category, '&nbsp;&nbsp;', (isset($cateInfo->pid) ? $cateInfo->pid : 0)) }}
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">名称 <span class="asterisk">*</span></label>

                                <div class="col-sm-3">
                                    <input type="text"  data-toggle="tooltip" name="name" data-trigger="hover" class="form-control tooltips" data-original-title="请填写名称" value="{{ Input::old('name') }}{{ $cateInfo->name or null }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">介绍 </label>

                                <div class="col-sm-3">
                                    <input type="text"  data-toggle="tooltip" name="intro" data-trigger="hover" class="form-control tooltips" data-original-title="请填写介绍,可为空" value="{{ Input::old('intro') }}{{ $cateInfo->intro or null }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">模板 <span class="asterisk">* </span></label>

                                <div class="col-sm-1">
                                    <select class="form-control input-sm" name="template">
                                        <option value="List_1" @if( Input::old('template') == 'List_1' || (isset($cateInfo->template) && $cateInfo->template == 'List_1' ) ) selected="selected" @endif>List_1</option>
                                        <option value="List_2" @if( Input::old('template') == 'List_2' || (isset($cateInfo->template) && $cateInfo->template == 'List_2' ) ) selected="selected" @endif>List_2</option>
                                    </select>
                                </div>

                                <label class="col-sm-1 control-label">别名</label>

                                <div class="col-sm-1">
                                    <input type="text"  data-toggle="tooltip" name="alias" data-trigger="hover" class="form-control tooltips" data-original-title="请填写别名" value="{{ Input::old('alias') }}{{ $cateInfo->alias or null }}" >
                                </div>

                                <label class="col-sm-1 control-label">排序</label>

                                <div class="col-sm-1">
                                    <input type="text"  data-toggle="tooltip" name="sort" data-trigger="hover" class="form-control tooltips"  value="{{ Input::old('sort') }}{{ $cateInfo->sort or null }}" >
                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-1">
                                    <input type="submit" name="submit" value="保存" class="btn btn-primary">
                                    &nbsp;
                                    <input type="reset" name="reset" value="取消" class="btn btn-default">
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

                @if( isset($cateInfo->id) )

                @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">列表信息</h4>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="table-responsive col-md-12">
                                <table class="table mb30">
                                    <thead>
                                    <tr>
                                        <th>
                                        <span class="ckbox ckbox-primary">
                                            <input type="checkbox" id="selectall">
                                            <label for="selectall"></label>
                                        </span>
                                        </th>
                                        <th>ID</th>
                                        <th>名称</th>
                                        <th>别名</th>
                                        <th>排序</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        {{ \App\Logics\CategoryLogic::getListStyleTreeData($category) }}
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- panel-body -->
                    </div>
                </div>
                @endif

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>


@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script>
        $(".show-sub-permissions").toggle(function () {
            var id = $(this).data('id'), subSelector = $('.parent-permission-' + id);
            $(this).children('.glyphicon').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
            subSelector.removeClass('hide');
        }, function () {
            var id = $(this).data('id'), subSelector = $('.parent-permission-' + id);
            $(this).children('.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
            subSelector.addClass('hide');
        });

        $(".permission-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除该分类吗？请确认该分类下没有子分类!',
                href: $(this).data('href'),
                successTitle: '操作成功'
            });
        });

        /*$(".deleteall").click(function () {
         Rbac.ajax.deleteAll({
         confirmTitle: '确定删除该分类吗？如果该分类有子分类将被一起删除！',
         href: $(this).data('href'),
         successTitle: '删除成功'
         });
         });*/
    </script>

@endsection