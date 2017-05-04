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

                        {!! $data->appends(isset($_GET['cat_id']) ? ['cat_id' => $_GET['cat_id']] : '')->render() !!}
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
                                    <th>name</th>
                                    <th>email/phone</th>
                                    <th>msg</th>
                                    <th>创建时间</th>
                                    <th>状态</th>
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
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->msg }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>@if($item->status == 100) 未处理 @else 已处理 @endif </td>

                                        <td>
                                            <a class="btn btn-danger btn-xs role-delete" data-href="/admin/delMsg/{{ $item->id }}">
                                                <i class="fa fa-trash-o"></i> 删除
                                            </a>
                                            @if($item->status == 100)
                                                <a class="btn btn-darkblue btn-xs role-delete" data-href="/admin/doMsg/{{ $item->id }}">
                                                    <i class="fa fa-pencil"></i> 处理
                                                </a>
                                            @endif

                                            {{--<a class="btn btn-xs btn-danger " onclick="return confirm('确定删除？')" href="/admin/delArticle/{{ $item->id }}">
                                                <i class="fa fa-trash-o"></i> 删除
                                            </a>--}}
                                        </td>
                                    </tr>
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

    <script src="/js/ajax.js"></script>
    <script src="/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">
        $(".role-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定操作?',
                href: $(this).data('href'),
                successTitle: '操作成功!'
            });
        });

    </script>
@endsection
