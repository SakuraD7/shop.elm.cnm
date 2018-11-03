@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('menucategories.update',[$menucategory]) }}" enctype="multipart/form-data">
        <h3><label>修改菜品分类</label></h3>
        <div class="form-group">
            <label>菜品分类名</label>
            <input type="text" name="name" class="form-control" placeholder="菜品分类名" value="{{ $menucategory->name }}">
        </div>
        <div class="form-group">
            <label>分类描述</label>
            <input type="text" name="description" class="form-control" placeholder="分类描述" value="{{ $menucategory->description }}">
        </div>
        <div class="form-group">
            <label>是否默认分类</label>
            <div>
                <label>
                    <input type="radio" name="is_selected" value="1" @if($menucategory->is_selected==1) checked="checked" @endif> 是
                    <input type="radio" name="is_selected" value="0" @if($menucategory->is_selected==0) checked="checked" @endif> 否
                </label>
            </div>
        </div>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop