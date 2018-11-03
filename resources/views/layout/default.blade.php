@include('layout._head')
<div>
    @include('layout._nav')
</div>
<div class="row">
    <div class="col-md-2">
        @include('layout._lift')
    </div>
    <div class="container col-md-9">
        @include('layout._notice')
        @yield('contents')
    </div>
</div>
@include('layout._foot')
