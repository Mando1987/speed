@extends('layouts.dashboard')

@section('content')
<!-- start of card -->
<div class="card card-solid">
    <!-- start card-header-->
    <div class="card-header p-1 border-bottom-0">
        @include('includes.orders.index.header')
    </div>
    <!-- end card-header-->
    @if($orders->count())
    <!-- start card-body -->
    <div class="card-body p-1">
        @if($view =='grid')
        <div class="row d-flex align-items-stretch">
            @foreach($orders as $index => $order)
            @include('includes.indexViews.grid.order_'. request()->adminType)
            @endforeach
        </div>
        @else
        <div class="table-responsive p-0">
            <table class="table table-head-fixed table-bordered text-nowrap text-center table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach (trans('datatable.order.'. request()->adminType) as $column =>$val)
                        <th>{{trans('datatable.order.'. request()->adminType .'.' . $column)}}</th>
                        @endforeach
                        <th>@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index=>$order)
                    @include('includes.indexViews.list.order_'. request()->adminType)
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    <!-- end card-body -->

    @if ($orders->total() > $orders->count())
    <!-- start of card-footer -->
    <div class="card-footer">
        <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
                {{ $orders->appends(['status'=>$status??'all' , 'search'=> $search])->links() }}
            </ul>
        </nav>
    </div>
    <!-- end of card-footer -->
    @endif
    @else
    <div class="m-3">
        <x-empty-records-button-add route="order.create" />
    </div>
    @endif
    @endsection
    @push('scripts')
    <script src="{{asset('assets/dist/js/orderIndex.js')}}"></script>
    @endpush
