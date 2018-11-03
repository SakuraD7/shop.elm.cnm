@extends('layout.default')

@section('contents')
    <h3>菜品分类列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>菜品分类名称</th>
            <th>菜品编号</th>
            <th>所属商家</th>
            <th>分类描述</th>
            <th>是否是默认分类</th>
            <th>操作</th>
        </tr>
        @foreach ($menucategories as $menucategory)
            <tr>
                <td>{{ $menucategory->id }}</td>
                <td><a href="{{ route('menus.show',[$menucategory->id]) }}">{{ $menucategory->name }}</a></td>
                <td>{{ $menucategory->type_accumulation }}</td>
                <td>{{ $shop_name }}</td>
                <td>{{ $menucategory->description }}</td>
                <td>{{ $menucategory->is_selected  == 1 ? '是' : '否'}}</td>
                <td><a href="{{ route('menucategories.edit',[$menucategory]) }}" class="btn btn-warning btn-xs">修改</a>
                    <form method="post" action="{{ route('menucategories.destroy',[$menucategory]) }}" style="display: inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $menucategories->links() }}
    <a href="{{ route('menucategories.create') }}" class="btn btn-info btn-s pull-right" role="button" >添加菜品分类</a>
@endsection