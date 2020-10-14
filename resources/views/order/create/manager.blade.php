@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card card-purple card-outline">
                    @if($userData->adminType == 'manager')
                    <div class="card-body">
                        @includeWhen(session('page') == 1 ,'order.includes.manager.sender_form')
                        @includeWhen(session('page') == 2 ,'order.includes.manager.reciver_form')
                        @includeWhen(session('page') == 3 ,'order.includes.manager.order_form')
                    </div>
                    @if(session('page') == 3)
                    <div class="card-footer">
                        <a href="{{ route('order.create' , ['page' => 2]) }}"
                            class="btn btn-outline-secondary">@lang('site.back')</a>
                        <button type="submit" class="btn btn-success">@lang('site.add')</button>
                    </div>
                    @endif
                    @else

                    <div class="card-body">
                        @includeWhen(session('page') == 1 ,'order.includes.manager.reciver_form')
                        @includeWhen(session('page') == 2 ,'order.includes.manager.order_form')
                    </div>
                    @if(session('page') == 2)
                    <div class="card-footer">
                        <a href="{{ route('order.create' , ['page' => 1]) }}"
                            class="btn btn-outline-secondary">@lang('site.back')</a>
                        <button type="submit" class="btn btn-success">@lang('site.add')</button>
                    </div>
                    @endif
                    @endif

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@if(isset($userData->governorate_id))
@push('scripts')
<script>
    $(function () {
        $('#governorate_id').val("{{$userData->governorate_id}}");
        $('#governorate_id').trigger("change");
    });
</script>
@endpush
@endif