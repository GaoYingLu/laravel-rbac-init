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
                                    <th>邮箱</th>
                                    <th>姓名</th>
                                    <th>联系电话</th>
                                    <th>地址</th>
                                    <th>公司</th>
                                    <th>职位</th>
                                    <th>主营产品</th>
                                    <th>创建时间</th>
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
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->company }}</td>
                                        <td>{{ $item->job }}</td>
                                        <td>{{ $item->product }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a class="btn btn-danger btn-sm user-delete" onclick="return confirm('确定删除？')" href="/admin/user/doDelUser/{{ $item->id }}">
                                                <i class="fa fa-trash-o"></i> 删除
                                            </a>
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

@endsection
