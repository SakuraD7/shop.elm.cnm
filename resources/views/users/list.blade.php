@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('users.update',['null']) }}" enctype="multipart/form-data">
        <h3><label>账号修改</label></h3>
        <div class="form-group">
            <label>账号名称</label>
            <input type="text" name="name" class="form-control" placeholder="账号名称" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="text" name="email" class="form-control" placeholder="邮箱" value="{{ $user->email }}">
        </div>

        <h3><label>信息修改</label></h3>
        <div class="form-group">
            <label>商家分类</label>
            <select name="shop_category_id" class="form-control">
                <option value="">请选择商家分类</option>
                @foreach($shopgories as $shopgory)
                    <option value="{{ $shopgory->id }}"
                            @if($shop->shop_category_id==$shopgory->id)
                            selected="selected"
                            @endif
                    >{{ $shopgory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>商家名称</label>
            <input type="text" name="shop_name" class="form-control" placeholder="商家名称" value="{{ $shop->shop_name }}">
        </div>
        <div class="form-group">
            <label>商家图片</label>
            <div>
                @if($shop->shop_img)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($shop->shop_img) }}"
                         class="img-thumbnail" width="150px">
                @endif
            </div>
            <input type="file" name="shop_img">
        </div>
        <div class="form-group">
            <label>商家评分</label>
            <input type="text" name="shop_rating" class="form-control" placeholder="商家评分" value="{{ $shop->shop_rating }}">
        </div>
        <div class="row">
            <div class="form-group col-lg-2">
                <label>是否是品牌</label>
                <div>
                    <label>
                        <input type="radio" name="brand" value="1"> 是
                        <input type="radio" name="brand" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>是否准时送达</label>
                <div>
                    <label>
                        <input type="radio" name="on_time" value="1"> 是
                        <input type="radio" name="on_time" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>是否蜂鸟配送</label>
                <div>
                    <label>
                        <input type="radio" name="fengniao" value="1"> 是
                        <input type="radio" name="fengniao" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>	是否保标记</label>
                <div>
                    <label>
                        <input type="radio" name="bao" value="1"> 是
                        <input type="radio" name="bao" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>是否票标记</label>
                <div>
                    <label>
                        <input type="radio" name="piao" value="1"> 是
                        <input type="radio" name="piao" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>是否准标记</label>
                <div>
                    <label>
                        <input type="radio" name="zhun" value="1"> 是
                        <input type="radio" name="zhun" value="0" checked> 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>起送金额</label>
            <input type="text" name="start_send" class="form-control" placeholder="起送金额" value="{{ $shop->start_send }}">
        </div>
        <div class="form-group">
            <label>配送费</label>
            <input type="text" name="send_cost" class="form-control" placeholder="配送费" value="{{ $shop->send_cost }}">
        </div>
        <div class="form-group">
            <label>店公告</label>
            <input type="text" name="notice" class="form-control" placeholder="店公告" value="{{ $shop->notice }}">
        </div>
        <div class="form-group">
            <label>优惠信息</label>
            <input type="text" name="discount" class="form-control" placeholder="优惠信息" value="{{ $shop->discount }}">
        </div>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop