@extends('layout.default')

@section('contents')
    <h3>订单列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>下单用户</th>
            <th>订单编号</th>
            <th>订单状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->username }}</td>
                <td>{{ $order->sn }}</td>
                <td>
                    @if($order->status==-1){{'已取消'}}@endif
                    @if($order->status==0){{'未支付'}}@endif
                    @if($order->status==1){{'待发货'}}@endif
                    @if($order->status==2){{'待确认'}}@endif
                    @if($order->status==3){{'完成'}}@endif
                </td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <a href="{{ route('order.delivery',[$order->id]) }}" class="btn btn-warning btn-xs">发货</a>
                    <a href="{{ route('order.cancel',[$order->id]) }}" class="btn btn-danger btn-xs">取消订单</a>
                    <a href="{{ route('order.details',[$order->id]) }}" class="btn btn-group btn-xs">订单详情</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $orders->links() }}
@endsection