<div class="col-xs-2">
    <div class="btn-group-vertical" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger dropdown-toggle btn-lg" >
                <a style="color:#fff" href="{{ route('menucategories.index') }}">菜品分类 </a>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger dropdown-toggle btn-lg">
                <a style="color:#fff" href="{{ route('menus.index') }}">菜品管理 </a>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger dropdown-toggle btn-lg" >
                <a style="color:#fff" href="{{ route('conduct') }}">活动列表 </a>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger dropdown-toggle btn-lg" >
                <a style="color:#fff" href="{{ route('orders') }}">订单管理 </a>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger dropdown-toggle btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                销量统计
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('statistics') }}">订单量统计</a></li>
                <li><a href="{{ route('sales_volume') }}">菜品销量统计</a></li>
            </ul>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger dropdown-toggle btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger dropdown-toggle btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Dropdown link</a></li>
                <li><a href="#">Dropdown link</a></li>
            </ul>
        </div>

    </div>
</div>