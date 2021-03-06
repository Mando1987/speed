@extends('layouts.dashboard')

@section('content')
<!-- start of card -->
<div class="card card-solid">
    <!-- start card-header-->
    <div class="card-header p-1 border-bottom-0">
        {{-- @include('includes.delegates.index.header') --}}
    </div>
    <!-- end card-header-->
    @if($delegates->count())
    <!-- start card-body -->
    <div class="card-body p-1">
        @if($view =='grid')
        <div class="row d-flex align-items-stretch">
            @foreach($delegates as $index => $delegate)
                @include('includes.indexViews.grid.delegate')
            @endforeach
        </div>
        @else
        <div class="table-responsive p-0">
            <table class="table table-head-fixed table-bordered text-nowrap text-center table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach (trans('datatable.delegate') as $column =>$val)
                        <th>{{trans('datatable.delegate.' . $column)}}</th>
                        @endforeach
                        <th>@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($delegates as $index=>$delegate)
                    @include('includes.indexViews.list.delegate')
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    <!-- end card-body -->
    <!-- start of card-footer -->
    <div class="card-footer">
        <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
                {{ $delegates->appends(['search'=> $search])->links() }}
            </ul>
        </nav>
    </div>
    <!-- end of card-footer -->
    @else
    <div class="m-3">
        <x-empty-records-button-add route="order.create" />
    </div>
    @endif
    @endsection
    @push('scripts')
    <script src="{{asset('assets/dist/js/orderIndex.js')}}"></script>
    @endpush
