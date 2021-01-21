@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-purple card-outline">

                <!-- form start -->
                <form role="form" action="{{ route('place.updateMultiCites') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <x-label title="{{__('site.governorate')}}" />
                                </div>
                                <div class="col-sm-8">
                                    <x-Governorates name="governorate_id" selected="{{ $governorate_id }}" />
                                </div>
                            </div>
                        </div>
                        @foreach ($cities as $city)
                        <div class="row border-bottom p-2">
                            <div class="col-md ">
                                <div class="form-group row m-0">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.city_name_ar')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="cities[{{ $city->id }}][city_name]"
                                             value="{{ old('cities.'.$city->id.'.city_name') ?? $city->city_name}}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md ">
                                <div class="form-group row m-0">
                                    <div class="col-sm-4">
                                        <x-label title="{{__('site.city_name_en')}}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-input name="cities[{{ $city->id }}][city_name_en]"
                                            value="{{ old('cities.'.$city->id.'.city_name_en') ?? $city->city_name_en }}" />
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of row-->
                        @endforeach
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">@lang('site.edit')</button>
                       <a href="{{ route('place.index') }}"  class="btn btn-danger ml-1">
                        @lang('site.cancel')

                       </a>
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
<script src="{{asset('assets/dist/js/formProccess.js')}}"></script>
@endpush
