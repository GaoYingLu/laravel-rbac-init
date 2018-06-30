@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>系统设置</span></h2>
    </div>
    <div class="contentpanel">

        @include('layouts.alert-msg')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <div class="btn-group mr10">
                            <a href="{{ route('admin.questions.create') }}" class="btn btn-white tooltips" data-toggle="tooltip" data-original-title="新增"><i class="glyphicon glyphicon-plus"></i></a>
                            {{--<a class="btn btn-white tooltips deleteall" data-toggle="tooltip" data-original-title="删除" data-href="http://local.laravel.com:20003/admin/admin_user/destroyall"><i class="glyphicon glyphicon-trash"></i></a>--}}
                        </div>
                    </div>
                    <h4 class="panel-title">问题列表</h4>
                    {{--<p>Individual form controls automatically receive some global styling. All textual elements with <code>.form-control</code> are set to width: 100%; by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing.</p>--}}
                </div>

                <table class="table table-primary mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>分类</th>
                        <th>问题</th>
                        <th>答案</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (!empty($questions))
                        @foreach($questions as $question)
                            <tr>
                            <td>{{$question->id}}</td>
                            <td>@if(isset($categorys[$question->category_id]['name'])){{$categorys[$question->category_id]['name']}}@else未知@endif</td>
                            <td>{{$question->name}}</td>
                            <td>{{$question->answer}}</td>
                            <td>{{$question->created_at}}</td>
                                <td>
                                    <a class="btn btn-white btn-sm" href="{{ route('admin.questions.edit', ['id' => $question->id]) }}"><i class="fa fa-pencil"> </i> 编辑</a>
                                    <a class="btn btn-danger btn-sm questions-delete" data-href="{{ route('admin.questions.delete', ['id' => $question->id]) }}"> <i class="fa fa-trash-o"></i> 删除</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">暂无信息</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
                {!! $questions->links() !!}
            </div>


    </div><!-- mainpanel -->


@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script>

        $(".questions-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确认删除？',
                href: $(this).data('href'),
                successTitle: '删除成功'
            });
        });

    </script>

@endsection