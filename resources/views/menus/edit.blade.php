@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('menus.update',[$menu]) }}" enctype="multipart/form-data">
        <h3><label>修改菜品信息</label></h3>
        <div class="form-group">
            <label>菜品名称</label>
            <input type="text" name="goods_name" class="form-control" placeholder="菜品名称" value="{{ $menu->goods_name }}">
        </div>
        <div class="form-group">
            <label>菜品图片</label>
            <div>
                @if($menu->goods_img)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($menu->goods_img) }}"
                         class="img-thumbnail" width="150px">
                @endif
            </div>
            <input type="file" name="goods_img">
        </div>
        <div class="form-group">
            <label>菜品评分</label>
            <input type="text" name="rating" class="form-control" placeholder="菜品评分" value="{{ $menu->rating }}">
        </div>
        <div class="form-group">
            <label>	所属分类</label>
            <select name="category_id" class="form-control">
                <option value="">请选择菜品分类</option>
                @foreach($menucategories as $menucategory)
                    <option value="{{ $menucategory->id }}"
                            @if($menu->category_id==$menucategory->id)
                            selected="selected"
                            @endif
                    >{{ $menucategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>价格</label>
            <input type="text" name="goods_price" class="form-control" placeholder="价格" value="{{ $menu->goods_price }}">
        </div>
        <div class="form-group">
            <label>菜品描述</label>
            <input type="text" name="description" class="form-control" placeholder="菜品描述" value="{{ $menu->description }}">
        </div>
        <div class="form-group">
            <label>月销量</label>
            <input type="text" name="month_sales" class="form-control" placeholder="菜品分类名" value="{{ $menu->month_sales }}">
        </div>
        <div class="form-group">
            <label>评分数量</label>
            <input type="text" name="rating_count" class="form-control" placeholder="菜品分类名" value="{{ $menu->rating_count }}">
        </div>
        <div class="form-group">
            <label>提示信息</label>
            <input type="text" name="tips" class="form-control" placeholder="菜品分类名" value="{{ $menu->tips }}">
        </div>
        <div class="form-group">
            <label>满意度数量</label>
            <input type="text" name="satisfy_count" class="form-control" placeholder="菜品分类名" value="{{ $menu->satisfy_count }}">
        </div>
        <div class="form-group">
            <label>满意度评分</label>
            <input type="text" name="satisfy_rate" class="form-control" placeholder="菜品分类名" value="{{ $menu->satisfy_rate }}">
        </div>
        <div class="form-group">
            <label>菜品状态</label>
            <div>
                <label>
                    <input type="radio" name="status" value="1" @if($menu->status==1) checked="checked" @endif > 上架
                    <input type="radio" name="status" value="0" @if($menu->status==0) checked="checked" @endif > 下架
                </label>
            </div>
        </div>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop