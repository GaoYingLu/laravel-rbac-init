@extends('layouts.admin-app')

@section('content')

    <div class="contentpanel panel-email">
        <div class="col-sm col-lg">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-btns">
                        <a href="" class="panel-close" title="隐藏">×</a>
                        <a href="" class="minimize" title="收起">−</a>
                    </div>
                    <h4 class="panel-title">当前位置: {{ $title or null }}</h4>
                </div>

                <form class="form-horizontal form-bordered" action="/admin/statsUser" method="get">

                    <div class="panel-body panel-body-nopadding">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">开始日期: <span class="asterisk">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" onClick="WdatePicker()" data-toggle="tooltip" name="start_time" class="form-control tooltips" value="{{ $_GET['start_time'] or null }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">结束日期: <span class="asterisk">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" onClick="WdatePicker()" data-toggle="tooltip" name="end_time" class="form-control tooltips" value="{{ $_GET['end_time'] or null }}">
                            </div>
                            <input class="btn btn-primary" type="submit" name="submit" value="搜索">
                            &nbsp;
                            <input class="btn btn-default" type="reset" name="reset" value="重置">
                        </div>
                    </div><!-- panel-body -->
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                </form>
                <div id="main" class="contentpanel panel-email" style="width: 100%; height:700px;"></div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        option = {
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
                feature: {
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            legend: {
                data:[@if(!empty($legend)) @foreach($legend as $legends) '{{ $legends }}', @endforeach @endif]
            },
            xAxis: [
                {
                    type: 'category',
                    data: [@if(!empty($times)) @foreach($times as $time) '{{ $time }}', @endforeach @endif]
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    name: '人数',
                    min: 0,
                    max: {{$maxNum or 0}},
                    interval: 50,
                    axisLabel: {
                        formatter: '{value} 人'
                    }
                }
            ],
            series: [
                    @if(!empty($list))
                        @foreach($list as $key => $item)
                            {
                                name:'{{$key}}',
                                type:'bar',
                                data:[{{implode(',', $item)}}]
                            },
                        @endforeach
                    @endif
            ]
        };


        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@endsection


