@extends('layouts.admin-app')

@section('content')
    <script language="javascript" type="text/javascript" src="/js/datepicker/WdatePicker.js"></script>

    <div class="contentpanel">
        @if (empty($detail))
            <form class="form-horizontal form-bordered" method="post" action="{{ route('admin.activity.doCreate') }}" enctype="multipart/form-data">
        @else
            <form class="form-horizontal form-bordered" method="post" action="{{ route('admin.activity.doEdit') }}" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$detail['id']}}">
        @endif
            {{csrf_field()}}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <div class="btn-group mr10">
                            <a href="{{ route('admin.activity.create') }}" class="btn btn-white tooltips" data-toggle="tooltip" data-original-title="新增"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                    </div>
                    <h4 class="panel-title">添加活动</h4>
                    {{--<p>Individual form controls automatically receive some global styling. All textual elements with <code>.form-control</code> are set to width: 100%; by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing.</p>--}}
                </div>
                <div class="panel-body panel-body-nopadding">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">状态</label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control" style="border-radius: 3px; padding: 10px; height: 40px;">
                                    @foreach($statusArr as $key => $status)
                                        <option value="{{$key}}" @if(!empty($detail) && $detail['status'] == $key) selected="selected"@endif>{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"> 名称</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" placeholder="请填写名称" value="{{$detail['name'] or null}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">开始时间</label>
                            <div class="col-sm-6">
                                <input type="text" name="start_at" onClick="WdatePicker()" placeholder="开始时间" value="{{$detail['start_at'] or null}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">结束时间</label>
                            <div class="col-sm-6">
                                <input type="text" name="end_at" onClick="WdatePicker()" placeholder="结束时间" value="{{$detail['end_at'] or null}}" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">描述</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="description" placeholder="关于活动的描述" rows="5">@if (!empty($detail['description']))@foreach($detail['description'] as $content){{$content}}@endforeach @endif</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">扩展信息</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="extends_info" placeholder="关于活动的扩展信息" rows="5">@if (!empty($detail['extends_info']))@foreach($detail['extends_info'] as $content){{$content}}@endforeach @endif</textarea>
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
