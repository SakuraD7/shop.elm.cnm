@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" enctype="multipart/form-data">
        <h3><label>订单详情</label></h3>
        @foreach($orders as $order)
        <div class="form-group">
            <label>收货人姓名</label>
            <input type="text" name="goods_name" class="form-control" value="{{ $order->name }}">
        </div>
        <div class="form-group">
            <label>收货地址</label>
            <input type="text" name="goods_price" class="form-control" value="{{ $order->province.$order->city.$order->county.$order->address }}">
        </div>
        <div class="form-group">
            <label>商品名称</label>
            <input type="text" name="rating" class="form-control" value="{{ $order->goods_name }}">
        </div>
        <div class="form-group">
            <label>商品单价</label>
            <input type="text" name="goods_price" class="form-control" value="{{ $order->goods_price }}">
        </div>
        <div class="form-group">
            <label>商品数量</label>
            <input type="text" name="goods_price" class="form-control" value="{{ $order->amount }}(份)">
        </div>
        <div class="form-group">
            <label>合计</label>
            <input type="text" name="goods_price" class="form-control" value="{{ $order->goods_price*$order->amount }} 元">
        </div>
        @endforeach
    </form>
@stop