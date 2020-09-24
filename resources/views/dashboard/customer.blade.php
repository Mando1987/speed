@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-info">
        <div class="inner">
        <h3>{{ $data->all_count ?? 0 }}</h3>
          <p>@lang('site.dashboard_all_orders')</p>
        </div>
        <div class="icon">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <a href="{{ route('order.index') }}" class="small-box-footer">
          @lang('site.more_info') <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-lightblue">
        <div class="inner">
        <h3>{{ $data->under_review_count ?? 0 }}</h3>

          <p>@lang('site.dashboard_under_review_count')</p>
        </div>
        <div class="icon">
          <i class="ion">👁‍🗨</i>
        </div>
        <a href="{{ route('order.index' ,['status' => 'under_review']) }}" class="small-box-footer">
          @lang('site.more_info') <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-info bg-gradient-info">
        <div class="inner">
        <h3>{{ $data->under_preparation_count ?? 0 }}</h3>

          <p>@lang('site.dashboard_under_preparation_count')</p>
        </div>
        <div class="icon">
          <i class="fas fa-chart-pie"></i>
        </div>
        <a href="{{ route('order.index' ,['status' => 'under_preparation']) }}" class="small-box-footer">
          @lang('site.more_info') <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-pink">
        <div class="inner">
        <h3>{{ $data->my_balance_count ?? 0 }}</h3>

          <p>@lang('site.dashboard_my_balance_count')</p>
        </div>
        <div class="icon">
          <i class="ion">$</i>
        </div>
      <a href="{{ route('order.index' ,['status' => 'my_balance']) }}" class="small-box-footer">
          @lang('site.more_info') <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
  </div>
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-teal">
        <div class="inner">
        <h3>{{ $data->ready_to_chip_count ?? 0 }}</h3>
          <p>@lang('site.dashboard_ready_to_chip_count')</p>
        </div>
        <div class="icon">
          <i class="ion">🏍</i>
        </div>
        <a href="{{ route('order.index' ,['status' => 'ready_to_chip']) }}" class="small-box-footer">
          @lang('site.more_info') <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-success">
        <div class="inner">
        <h3>{{ $data->delivered_count ?? 0}}</h3>

          <p>@lang('site.dashboard_delivered_count')</p>
        </div>
        <div class="icon">

          <i class="ion">😃</i>
        </div>
        <a href="{{ route('order.index' ,['status' => 'delivered']) }}" class="small-box-footer">
          @lang('site.more_info') <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-purple">
        <div class="inner">
        <h3>{{ $data->postpond_count ?? 0 }}</h3>

          <p>@lang('site.dashboard_postpond_count')</p>
        </div>
        <div class="icon">
          <i class="ion">🚳</i>
        </div>
        <a href="{{ route('order.index' ,['status' => 'postpond']) }}" class="small-box-footer">
          @lang('site.more_info') <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-danger">
        <div class="inner">
        <h3>{{ $data->cancelld_count ?? 0}}</h3>

          <p>@lang('site.dashboard_cancelld_count')</p>
        </div>
        <div class="icon">
          <i class="ion">❌</i>
        </div>
        <a href="{{ route('order.index' ,['status' => 'cancelld']) }}" class="small-box-footer">
          @lang('site.more_info') <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
  </div>
@endsection