@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span> 分类管理</span></h2>
    </div>

    <div class="contentpanel panel-email">
        @include('layouts.alert-msg')

        <div class="row">


            <div class="">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-white tooltips" data-toggle="tooltip" data-original-title="新增">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </a>
                                {{--<a class="btn btn-white tooltips deleteall" data-toggle="tooltip"--}}
                                   {{--data-original-title="删除" data-href="{{ route('admin.permission.destroy.all') }}"><i--}}
                                            {{--class="glyphicon glyphicon-trash"></i></a>--}}
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">分类列表</h5>

                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>
                                        <span class="ckbox ckbox-primary">
                                            <input type="checkbox" id="selectall"/>
                                            <label for="selectall"></label>
                                        </span>
                                    </th>
                                    <th>类型</th>
                                    <th>名称</th>
                                    <th>别名</th>
                                    <th>排序</th>
                                    <th>简介</th>
                                    <th>显示模板</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category as $cate)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $cate['id'] }}" value="{{ $cate['id'] }}" class="selectall-item"/>
                                                <label for="id-{{ $cate['id'] }}"></label>
                                                <a href="javascript:;" class="show-sub-permissions" data-id="{{ $cate['id'] }}">
                                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                                </a>
                                            </div>
                                        </td>
                                        <td><p class="text-info">{{ \App\Models\Category::getTypeStr($cate['type']) }}</p></td>
                                        <td>{{ $cate['name'] }}</td>
                                        <td>{{ $cate['alias'] }}</td>
                                        <td><span class="label label-default">{{ $cate['sort'] }}</span></td>
                                        <td>{{ $cate['intro'] }}</td>
                                        <td>{{ $cate['template'] }}</td>
                                        <td>{{ $cate['created_at'] }}</td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', ['id'=>$cate['id']]) }}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a class="btn btn-danger btn-sm category-delete" data-href="{{ route('admin.category.delete',['id'=>$cate['id']]) }}">
                                                <i class="fa fa-trash-o"></i> 删除
                                            </a>
                                        </td>
                                    </tr>

                                    @if(isset($cate['sub']))
                                        @foreach($cate['sub'] as $sub)
                                            <tr class="hide parent-permission-{{ $cate['id'] }}">
                                                <td>
                                                    <div class="ckbox ckbox-default">
                                                        <input type="checkbox" name="id" id="id-{{ $sub['id'] }}" value="{{ $sub['id'] }}" class="selectall-item"/>
                                                        <label for="id-{{ $sub['id'] }}"></label>
                                                    </div>
                                                </td>
                                                <td> </td>
                                                <td>|-- {{ $sub['name'] }}</td>
                                                <td>{{ $sub['alias'] }}</td>
                                                <td><span class="label label-default">{{ $sub['sort'] }}</span></td>
                                                <td>{{ $sub['intro'] }}</td>
                                                <td>{{ $sub['template'] }}</td>
                                                <td>{{ $sub['created_at'] }}</td>
                                                <td>
                                                    <a href="{{ route('admin.category.edit',['id'=>$sub['id']]) }}" class="btn btn-white btn-sm">
                                                        <i class="fa fa-pencil"></i> 编辑
                                                    </a>
                                                    <a class="btn btn-danger btn-sm category-delete" data-href="{{ route('admin.category.delete',['id'=>$sub['id']]) }}">
                                                        <i class="fa fa-trash-o"></i> 删除
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div><!-- panel-body -->
                </div><!-- panel -->

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

        $(".category-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除该分类吗？如果该分类有下属分类将一并删除，且该分类所属信息将会出现不可预测问题！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中分类吗？如果该分类有下属分类将一并删除，且该分类所属信息将会出现不可预测问题！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });
    </script>

@endsection
