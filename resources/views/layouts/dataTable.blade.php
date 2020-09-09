@section('content')
    <div class="card card-purple card-outline">
        <div class="card-body">
            @hasSection ('tbody')
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                @yield('button')
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="dataTableId_filter" class="dataTables_filter">
                                    <label>@lang('site.search')
                                        <input id="myInput" type="search" class="form-control form-control-sm" placeholder="@lang('site.search')" aria-controls="dataTableId">
                                    </label>
                                </div>
                        </div>
                        </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive-md">
                                <table id="dataTableId" class="table table-sm table-bordered table-striped  dataTable dtr-inline"
                                    role="grid" aria-describedby="admin_info">
                                    <thead>
                                        @yield('thead')
                                    </thead>
                                    <tbody>
                                        @yield('tbody')
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                   @hasSection ('paginate')
                      @yield('paginate')
                   @endif
                </div>
            @endif
            @yield('empty')
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@push('datatable')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/dataTablesScripts.js') }}"></script>
@include('includes.scripts.delete')
@endpush

