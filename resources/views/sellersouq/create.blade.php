@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-purple card-outline">

                <!-- form start -->
                <form role="form" id="quickForm" action="{{ route('sellersouq.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        @for($i = 0; $i < $order_num; $i++)
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm  mb-3 ">
                                        <span class="bg-pink p-1 rounded-pill">

                                            <strong>@lang('site.order_number_badge')</strong>
                                            <strong> <span class="bg-pink p-2 rounded-circle">{{$i + 1}}</span></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <x-label title="{{__('site.sellersouq_order_num')}}" />
                                            </div>
                                            <div class="col-sm-8">
                                                <x-input-text name="sellersouq[{{$i}}][order_num]" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <x-label title="{{__('site.sellersouq_order_info')}}" />
                                            </div>

                                            <div class="col-sm-8">
                                                <x-input-text name="sellersouq[{{$i}}][order_info]" />
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end of row-->
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <x-label title="{{__('site.sellersouq_order_quantity')}}" />
                                            </div>
                                            <div class="col-sm-8">
                                                <x-input-text name="sellersouq[{{$i}}][order_quantity]" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <x-label title="{{__('site.sellersouq_order_weight')}}" />
                                            </div>

                                            <div class="col-sm-8">
                                                <x-input-text name="sellersouq[{{$i}}][order_weight]" />
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end of row-->
                            </div>
                            @if($i == $order_num - 1)
                            <div class="text-center p-1">
                            <a href="{{route('sellersouq.create',['order_num' => $order_num + 1])}}" class="btn btn-primary">@lang('site.seller_add')</a>
                            <a href="{{route('sellersouq.create',['order_num' => $order_num - 1])}}" class="btn btn-danger">@lang('site.delete')</a>
                            </div>
                        @endif
                    </div>
                    @endfor
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">@lang('site.add')</button>
            </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">

    </div>
    <!--/.col (right) -->
</div>
<!-- /.row -->
</div>
@endsection

@push('scripts')
<script>
    // $('#governorate_id').val(14);

</script>
@endpush
