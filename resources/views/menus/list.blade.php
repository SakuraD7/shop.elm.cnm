@extends('layout.default')

@section('contents')
    <h3>菜品列表</h3>
    <form class="navbar-form navbar-left" action="{{ route('menus.index') }}" method="get">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="菜品名称" name="name">
            <input type="text" class="form-control" placeholder="价格" name="price1" style="width: 90px">
            --
            <input type="text" class="form-control" placeholder="价格" name="price2" style="width: 90px">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>菜品名称</th>
            <th>商品图片</th>
            <th>评分</th>
            <th>所属商家</th>
            <th>所属分类</th>
            <th>价格</th>
            <th>菜品描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>菜品状态</th>
            <th>操作</th>
        </tr>
        @foreach ($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->goods_name }}</td>
                <td>
                    @if( $menu->goods_img )
                        <img class="img-thumbnail"
                             src="{{ \Illuminate\Support\Facades\Storage::url($menu->goods_img) }}"
                             width="100px"
                        />
                    @endif
                </td>
                <td>{{ $menu->rating }}</td>
                <td>{{ $shop_name }}</td>
                <td>{{ $menu->MenuCategory->name }}</td>
                <td>{{ $menu->goods_price }}</td>
                <td>{{ $menu->description }}</td>
                <td>{{ $menu->month_sales }}</td>
                <td>{{ $menu->rating_count }}</td>
                <td>{{ $menu->tips }}</td>
                <td>{{ $menu->satisfy_count }}</td>
                <td>{{ $menu->satisfy_rate }}</td>
                <td>{{ $menu->status  == 1 ? '上架' : '下架'}}</td>
                <td><a href="{{ route('menus.edit',[$menu]) }}" class="btn btn-warning btn-xs">修改</a>
                    <form method="post" action="{{ route('menus.destroy',[$menu]) }}" style="display: inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $menus->appends(request()->except('page'))->links() }}
    <a href="{{ route('menus.create') }}" class="btn btn-info btn-s pull-right" role="button" >添加菜品</a>
@endsection