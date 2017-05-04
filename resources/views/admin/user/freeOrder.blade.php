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
                        <h4 class="panel-title">列表信息</h4>
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
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                    <div class="panel-body">
                        <div class="pull-left">

                        {!! $data->render() !!}
                        </div><!-- pull-right -->



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
                                    <th>用户ID</th>
                                    <th>订单号</th>
                                    <th>状态</th>
                                    <th>申请时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        <td>
                                            <div class="ckbox ckbox-default">
                                                <input type="checkbox" name="id" id="id-{{ $item->id }}" value="{{ $item->id }}" class="selectall-item">
                                                <label for="id-{{ $item->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user_id }}</td>
                                        <td>
                                            <a href="javascript:;" title="点击查看详情" class="show-sub-permissions" data-id="{{$item['id']}}">
                                                <p class="text-info">{{ $item->order_id }}</p>
                                            </a>
                                            </td>
                                        <td>
                                            @if( $item->status == \App\Models\FreeOrderModel::STATUS_DEFAULT )
                                                <span class="label label-danger">待处理</span>
                                            @else
                                                <span class="label label-info">已处理</span>

                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if( $item->status == \App\Models\FreeOrderModel::STATUS_DEFAULT )
                                                <a href="/admin/user/dealFreeOrder/{{ $item->id }}" onclick="return confirm('确定操作？')" class="btn btn-info btn-sm">
                                                    <i class="fa fa-"></i> 处理
                                                </a>

                                            @endif

                                            <a class="btn btn-danger btn-sm user-delete" onclick="return confirm('确定删除？')" href="/admin/user/delFreeOrder/{{ $item->id }}">
                                                <i class="fa fa-trash-o"></i> 删除
                                            </a>
                                        </td>
                                    </tr>

                                    @if( $item->json_value )
                                        <tr class="hide parent-permission-{{ $item['id'] }}">
                                            <td colspan="8">
                                                <table border="1" width="20%" cellspacing="15">
                                                    <tr><td colspan="14" align="center" >申请人信息</td>
                                                    <tr><td align="center">邮箱: </td><td align="center">{{ $item->email }}</td></tr>
                                                    <tr><td align="center">姓名: </td><td align="center">{{ $item->name }}</td></tr>
                                                    <tr><td align="center">电话: </td><td align="center">{{ $item->phone }}</td></tr>
                                                    <tr><td align="center">地址: </td><td align="center">{{ $item->address }}</td></tr>
                                                    <tr><td align="center">公司名称: </td><td align="center">{{ $item->company }}</td></tr>
                                                    <tr><td align="center">职位: </td><td align="center">{{ $item->job }}</td></tr>
                                                    <tr><td align="center">主营产品: </td><td align="center">{{ $item->product }}</td></tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr class="hide parent-permission-{{ $item['id'] }}"><td colspan="8">{!! json_decode($item->json_value) !!}  </td></tr>
                                    @endif

                                @empty
                                    <tr><td colspan="8">暂无信息</td></tr>
                                @endforelse


                                </tbody>
                            </table>
                            {!! $data->render() !!}
                        </div>



                    </div>
                </div>

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
                confirmTitle: '确定删除该分类吗？如果该分类有子分类将被一起删除！',
                href: $(this).data('href'),
                successTitle: '删除成功'
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