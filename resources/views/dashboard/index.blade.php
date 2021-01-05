@extends('layouts.dashboard')

@section('content')
<div class="row">
  @foreach ($data as $key => $status)
  <div class="col-lg-3 col-6">
    <div class="small-box {{ __(sprintf('dashboard.%s.background', $key)) }}">
      <div class="inner">
        <h3>{{ $status['total'] }}</h3>
        <p>{{ __(sprintf('dashboard.%s.label', $key)) }}</p>
      </div>
      <div class="icon">
        {!! __(sprintf('dashboard.%s.icon', $key)) !!}
      </div>
      <a href="{{ route('order.index',['status' => $key]) }}" class="small-box-footer">
        @lang('site.more_info') <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  @endforeach
@endsection
