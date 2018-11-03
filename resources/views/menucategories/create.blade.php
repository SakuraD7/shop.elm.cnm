@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('menucategories.store') }}" enctype="multipart/form-data">
        <h3><label>添加菜品分类</label></h3>
        <div class="form-group">
            <label>菜品分类名</label>
            <input type="text" name="name" class="form-control" placeholder="菜品分类名" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>分类描述</label>
            <input type="text" name="description" class="form-control" placeholder="分类描述" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>是否默认分类</label>
            <div>
                <label>
                    <input type="radio" name="is_selected" value="1" > 是
                    <input type="radio" name="is_selected" value="0" checked> 否
                </label>
            </div>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop