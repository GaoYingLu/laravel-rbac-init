@extends('layouts.admin-app')

@section('content')

    <div class="contentpanel">
        @if (empty($detail))
            <form class="form-horizontal form-bordered" method="post" action="{{ route('admin.category.doCreate') }}">
        @else
            <form class="form-horizontal form-bordered" method="post" action="{{ route('admin.category.doEdit') }}">
            <input type="hidden" name="id" value="{{$detail['id']}}">
        @endif
            {{csrf_field()}}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <div class="btn-group mr10">
                            <a href="{{ route('admin.category.create') }}" class="btn btn-white tooltips" data-toggle="tooltip" data-original-title="新增"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                    </div>
                    @if (empty($detail))
                    <h4 class="panel-title">添加分类</h4>
                    @else
                    <h4 class="panel-title">编辑分类</h4>
                    @endif
                    {{--<p>Individual form controls automatically receive some global styling. All textual elements with <code>.form-control</code> are set to width: 100%; by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing.</p>--}}
                </div>
                <div class="panel-body panel-body-nopadding">


                        <div class="form-group">
                            <label class="col-sm-3 control-label">分类类型</label>
                            <div class="col-sm-6">
                                <select name="type" class="form-control" style="border-radius: 3px; padding: 10px; height: 40px;">
                                    @foreach($categoryType as $key => $value)
                                        <option value="{{$key}}" @if(!empty($detail) && $detail['type'] == $key) selected="selected"@endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属分类</label>
                            <div class="col-sm-6">
                                <select name="pid" class="form-control" style="border-radius: 3px; padding: 10px; height: 40px;">
                                    <option value="0">一级分类</option>
                                    @foreach($categorys as $key => $category)
                                        <option value="{{$category['id']}}" @if(isset($detail['pid']) && $detail['pid'] == $category['id']) selected="selected"@endif>{{$category['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">名称</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" placeholder="请填写名称" value="{{$detail['name'] or null}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">别名</label>
                            <div class="col-sm-6">
                                <input type="text" name="alias" placeholder="请填写别名" value="{{$detail['alias'] or null}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">排序</label>
                            <div class="col-sm-6">
                                <input type="text" name="sort" placeholder="排序-数字越到越靠后" value="{{$detail['sort'] or 0}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">简介</label>
                            <div class="col-sm-6">
                                <input type="text" name="intro" placeholder="关于分类的简介" value="{{$detail['intro'] or null}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">显示模板</label>
                            <div class="col-sm-6">
                                <select name="template" class="form-control" style="border-radius: 3px; padding: 10px; height: 40px;">
                                    <option value="default">--默认--</option>
                                    @foreach($templates as $template)
                                        <option value="{{$template}}" @if(isset($detail['template']) && $detail['template'] == $template) selected="selected"@endif>{{$template}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                </div><!-- panel-body -->

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
                </div><!-- panel-footer -->

            </div>
        </form>








    </div><!-- mainpanel -->




@endsection
