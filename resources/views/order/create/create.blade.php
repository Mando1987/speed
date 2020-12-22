@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content p-0">
                {{-- add customer  --}}
                <div class="tab-pane active" id="tab-pane-customer">
                    <div class="card card-purple card-outline">
                        <div class="card-body">
                            @include('order.includes.create.sender_form')
                        </div>
                    </div>
                </div>
                {{-- add customer  --}}
                {{-- add reciver --}}
                <div class="tab-pane" id="tab-pane-reciver">
                    <div class="card card-purple card-outline">
                        <div class="card-body">
                            @include('order.includes.create.reciver_form')
                        </div>
                    </div>
                </div>
                {{-- add reciver --}}
                {{-- add order detials --}}
                <div class="tab-pane" id="tab-pane-order">
                    <div class="card card-purple card-outline">
                        <div class="card-body">
                            @include('order.includes.create.order_form')
                        </div>
                    </div>
                </div>
                {{-- add order detials --}}
            </div>
        </div> <!-- End of col-md-12-->
    </div><!-- End of row -->
</div> <!-- End of container-fluid -->
@endsection

@push('scripts')
<script src="{{asset('assets/dist/js/order.js')}}"></script>
@endpush
