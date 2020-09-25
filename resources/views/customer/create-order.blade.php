@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">

            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card card-purple card-outline">
                    <div class="card-body">

                        @includeWhen(session('page') == 1 ,'customer.includes.reciver_form')
                        @includeWhen(session('page') == 2 ,'customer.includes.order_form')
                    </div>
                    <!-- /.card-body -->
                    @if(session('page') == 2)
                    <div class="card-footer">
                        <a href="{{ route('order.create' , ['page' => 1]) }}"
                            class="btn btn-outline-secondary">@lang('site.back')</a>
                        <button type="submit" class="btn btn-success">@lang('site.add')</button>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@if($userData->governorate_id)
@push('scripts')
<script>
    $(function () {
        $('#governorate_id').val("{{$userData->governorate_id}}");
        $('#governorate_id').trigger("change");
    });

</script>
@endpush
@endif