@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-purple card-outline">
                <!-- form start -->
                <form role="form" id="quickForm" action="{{ route('place.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="card-body parentDiv">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <x-label title="{{__('site.governorate')}}" />
                                </div>
                                <div class="col-sm-8">
                                    <x-Governorates name="governorate_id" selected="1" />
                                </div>
                            </div>
                        </div>
                        @for($i = 0; $i < $city_count; $i++)
                        <div class="row border-bottom p-2 cloneDiv">
                            <div class="col-md ">
                                <div class="form-group row m-0">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.city_name_ar')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="cities[{{ $i }}][city_name]" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row m-0">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.city_name_en')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="cities[{{ $i }}][city_name_en]" value="" />
                                    </div>
                                </div>
                            </div>
                    </div>
                    @if($i == $city_count - 1)
                    <div class="text-center p-1">
                        <a href="{{route('place.create',['city_count' => $city_count + 1])}}"
                            class="btn btn-primary">@lang('site.city_add')</a>
                        <a href="{{route('place.create',['city_count' => $city_count - 1])}}"
                            class="btn btn-danger">@lang('site.delete')</a>
                    </div>
                    @endif
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
