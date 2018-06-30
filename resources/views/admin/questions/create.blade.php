@extends('layouts.admin-app')

@section('content')

    <div class="contentpanel">
        @if (empty($detail))
            <form class="form-horizontal form-bordered" method="post" action="{{ route('admin.questions.doCreate') }}" enctype="multipart/form-data">
        @else
            <form class="form-horizontal form-bordered" method="post" action="{{ route('admin.questions.doEdit') }}" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$detail['id']}}">
        @endif
            {{csrf_field()}}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <div class="btn-group mr10">
                            <a href="{{ route('admin.questions.create') }}" class="btn btn-white tooltips" data-toggle="tooltip" data-original-title="新增"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                    </div>
                    <h4 class="panel-title">添加问题</h4>
                    {{--<p>Individual form controls automatically receive some global styling. All textual elements with <code>.form-control</code> are set to width: 100%; by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing.</p>--}}
                </div>
                <div class="panel-body panel-body-nopadding">


                        <div class="form-group">
                            <label class="col-sm-3 control-label">选项类型</label>
                            <div class="col-sm-6">
                                <select name="type" class="form-control" style="border-radius: 3px; padding: 10px; height: 40px;">
                                    @foreach($multiChoices as $key => $multiChoice)
                                        <option value="{{$key}}" @if(!empty($detail) && $detail['type'] == $key) selected="selected"@endif>{{$multiChoice}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属分类</label>
                            <div class="col-sm-6">
                                <select name="category_id" class="form-control" style="border-radius: 3px; padding: 10px; height: 40px;">
                                    @foreach($categorys as $key => $category)
                                        <option value="{{$category['id']}}" @if(isset($detail['category_id']) && $detail['category_id'] == $category['id']) selected="selected"@endif>{{$category['name']}}</option>
                                        @if(!empty($category['sub']))
                                            @foreach($category['sub'] as $sub)
                                                <option value="{{$sub['id']}}" @if(isset($detail['category_id']) && $detail['category_id'] == $sub['id']) selected="selected"@endif>|--{{$sub['name']}}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">问题</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" placeholder="请填写问题" value="{{$detail['name'] or null}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">答案</label>
                            <div class="col-sm-6">
                                <input type="text" name="answer" placeholder="请填写答案" value="{{$detail['answer'] or null}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">问题选项</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="content" placeholder="每行一行" rows="5">@if (!empty($detail['content']))@foreach($detail['content'] as $content){{$content}}@endforeach @endif</textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">图片 <code> * 可不上传</code></label>
                            <input type="file" name="file" style="border-radius: 3px; padding: 10px; height: 40px;">
                        </div>
                    @if(isset($detail['file']) && !empty($detail['file']))
                        <div class="form-group">
                            <label class="col-sm-3 control-label">当前图片</label>
                            <img src="{{route('file.get', ['file' => $detail['file']])}}" width="500" height="300">
                        </div>
                    @endif

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
