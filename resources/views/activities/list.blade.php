@extends('layout.default')

@section('contents')
    <h3>活动信息列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach ($activities as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
                <td>
                    <a href="{{ route('details',[$activity]) }}" class="btn btn-warning btn-xs">活动详情</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{--{{ $activities->links() }}--}}
@endsection