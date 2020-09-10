@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{ breadcrumbName() }} </h3>
                    </div>
                    <div class="card-body">
                        {{-- sender info  --}}
                        @includeWhen(session('page') == 1 ,'order.includes.sender_form')
                        @includeWhen(session('page') == 2 ,'order.includes.reciver_form')
                        @includeWhen(session('page') == 3 ,'order.includes.order_form')
                    </div>
                    <!-- /.card-body -->
                    @if(session('page') == 3)
                    <div class="card-footer">
                        <a href="{{ route('order.create' , ['page' => 2]) }}"
                            class="btn btn-outline-secondary">@lang('site.back')</a>
                        <button type="submit" class="btn btn-success">@lang('site.add')</button>
                    </div>
                    @endif
                </div> <!-- end of card -->
            </form>
        </div> <!-- end of row -->
    </div>
</div>
@endsection

@if($reciver['governorate_id'])
@push('scripts')
<script>
    $(function () {
        $('#governorate_id').val("{{$reciver['governorate_id'] }}");
        $('#governorate_id').trigger("change");
    });

</script>
@endpush
@elseif($sender['governorate_id'])
@push('scripts')
<script>
    $(function () {
        $('#governorate_id').val("{{$sender['governorate_id']}}");
        $('#governorate_id').trigger("change");
    });
</script>
@endpush
@endif
