@extends('layout.default')

@section('contents')
    @include('layout._errors')
          {!! $activity->text !!}
@stop