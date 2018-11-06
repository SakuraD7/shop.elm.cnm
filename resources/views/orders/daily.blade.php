@extends('layout.default')

@section('contents')
    <!-- 引入 ECharts 文件 -->
    <script src="/js/echarts.common.min.js"></script>
    <h2>最近一周订单统计</h2>
    <table class="table table-bordered table-striped">
        <tr>
            @foreach($dates as $d=>$c)
            <th>{{ $d }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach($dates as $d=>$c)
                <th>{{ $c }}</th>
            @endforeach
        </tr>
    </table>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 1000px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '订单统计'
            },
            tooltip: {},
            legend: {
                data:['订单量']
            },
            xAxis: {
                data:@php echo json_encode(array_keys($dates))@endphp
            },
            yAxis: {},
            series: [{
                name: '订单量',
                type: 'line',
                data: @php echo json_encode(array_values($dates))@endphp
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>

    <h2>最近三月订单统计</h2>
    <table class="table table-bordered table-striped">
        <tr>
            @foreach($dates2 as $d=>$c)
                <th>{{ $d }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach($dates2 as $d=>$c)
                <th>{{ $c }}</th>
            @endforeach
        </tr>
    </table>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main2" style="width: 1000px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main2'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '订单统计'
            },
            tooltip: {},
            legend: {
                data:['订单量']
            },
            xAxis: {
                data:@php echo json_encode(array_keys($dates2))@endphp
            },
            yAxis: {},
            series: [{
                name: '订单量',
                type: 'line',
                data: @php echo json_encode(array_values($dates2))@endphp
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@endsection