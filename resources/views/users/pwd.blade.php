@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('users.savepwd') }}" enctype="multipart/form-data">
        <h3><label>修改商家账号密码</label></h3>
        <div class="form-group">
            <label>账号名称</label>
            <input type="text" name="name" class="form-control" placeholder="管理员名称" value="{{ auth()->user()->name }}" disabled>
        </div>
        <div class="form-group">
            <label>旧密码</label>
            <input type="password" name="password" class="form-control" placeholder="请填写旧密码">
        </div>
        <div class="form-group">
            <label>新密码</label>
            <input type="password" name="newpwd" class="form-control" placeholder="请输入新的密码">
        </div>
        <div class="form-group">
            <label>确认密码</label>
            <input type="password" name="newpwd_confirmation" class="form-control" placeholder="请再次输入新密码">
        </div>
        {{--{{ method_field('PUT') }}--}}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop