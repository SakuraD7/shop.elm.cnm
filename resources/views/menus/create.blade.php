@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('menus.store') }}" enctype="multipart/form-data">
        <h3><label>添加菜品</label></h3>
        <div class="form-group">
            <label>菜品名称</label>
            <input type="text" name="goods_name" class="form-control" placeholder="菜品名称" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>图片</label>
            <input type="file" name="goods_img" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>菜品评分</label>
            <input type="text" name="rating" class="form-control" placeholder="菜品评分" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>所属分类</label>
            <select name="category_id" class="form-control">
                <option value="">请选择菜品分类</option>
                @foreach($menucategories as $menucategory)
                    <option value="{{ $menucategory->id }}"
                            @if(old('category_id')==$menucategory->id)
                            selected="selected"
                            @endif
                    >{{ $menucategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>价格</label>
            <input type="text" name="goods_price" class="form-control" placeholder="价格" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <input type="text" name="description" class="form-control" placeholder="描述" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>月销量</label>
            <input type="text" name="month_sales" class="form-control" placeholder="月销量" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>评分数量</label>
            <input type="text" name="rating_count" class="form-control" placeholder="评分数量" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>提示信息</label>
            <input type="text" name="tips" class="form-control" placeholder="提示信息" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>满意度数量</label>
            <input type="text" name="satisfy_count" class="form-control" placeholder="满意度数量" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>满意度评分</label>
            <input type="text" name="satisfy_rate" class="form-control" placeholder="满意度评分" value="{{ old('name') }}">
        </div>
        <input type="hidden" name="status" value="1">
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop