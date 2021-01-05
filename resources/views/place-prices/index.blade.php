
@section('button')
<div class="row">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <x-add-button route="price.create" />
            </div>
            <div style=width:20px></div>
            <div class="input-group-prepend">
                <span class="badge bg-secondary pt-3">
                    @lang('site.governorate')
                </span>
            </div>
            <form role="form" id="getCitiesPrice" action="{{ route('price.index') }}" method="GET" >
                <select class="custom-select" name="governorate_id" id="getCitiesPriceSelect">
                </select>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- ***************************************************************************************** --}}
@extends('layouts.dashboard')

@section('content')
<!-- start of card -->
<div class="card card-solid">
    <!-- start card-header-->
    <div class="card-header p-1 border-bottom-0">
        {{-- @include('includes.prices.index.header') --}}
    </div>
    <!-- end card-header-->
    @if($prices->count())
    <!-- start card-body -->
    <div class="card-body p-1">
        @if($view =='grid')
        <div class="row d-flex align-items-stretch">
            @foreach($prices as $index => $price)
                @include('includes.indexViews.grid.prices')
            @endforeach
        </div>
        @else
        <div class="table-responsive p-0">
            <table class="table table-head-fixed table-bordered text-nowrap text-center table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach (trans('datatable.prices') as $column =>$val)
                        <th>{{trans('datatable.prices.' . $column)}}</th>
                        @endforeach
                        <th>@lang('site.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prices as $index=>$price)
                    @include('includes.indexViews.list.prices')
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    <!-- end card-body -->
    <!-- start of card-footer -->
    @if($prices->total() > $prices->count())
        <div class="card-footer">
            <nav aria-label="Contacts Page Navigation">
                <ul class="pagination justify-content-center m-0">
                    {{  $prices->appends(['governorate_id' =>1 ])->links() }}
                </ul>
            </nav>
        </div>
        <!-- end of card-footer -->
    @endif
    @else
    <div class="m-3">
        <x-empty-records-button-add route="price.create" />
    </div>
    @endif
    @endsection
    @push('scripts')
    <script src="{{asset('assets/dist/js/orderIndex.js')}}"></script>
    @endpush

