<!DOCTYPE html>
@inject('admin', 'App\Services\CurrentAdminService')

<html dir="{{$defaultLang['dir']}}" lang="{{$defaultLang['abbr']}}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ siteTitle() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.'.$defaultLang['dir'].'min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.'.$defaultLang['dir'].'min.css') }}">

    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.'.$defaultLang['dir'].'min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/notify.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/print.css')}}">
    <!-- Google Font: Source Sans Pro -->
    @if($defaultLang['abbr'] == 'ar')
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
    @endif
</head>

<body class="hold-transition layout-fixed layout-navbar-fixed text-sm sidebar-mini">
    <div class="wrapper hide-in-print">
        {{-- ########### Header ###################################################### --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            @include('includes.dashboard.header')
        </nav>
        {{-- ########### Header ###################################################### --}}

        {{-- ########### SideBar ###################################################### --}}
        @include('includes.dashboard.sidebar')
        {{-- ########### SideBar ###################################################### --}}


        <div class="content-wrapper">
            <!-- ################################################# start content-wrapper -->

            {{-- ########### Bredcrumbs ###################################################### --}}
            @include('includes.dashboard.bredcrumbs')
            {{-- ########### Bredcrumbs ###################################################### --}}

            {{-- ########### Content ###################################################### --}}
            <section class="content">
                @yield('content')
            </section>
            {{-- ########### Content ###################################################### --}}
        </div><!-- ############################################################################ end content-wrapper -->
        <footer class="main-footer d-none d-sm-block">
            @include('includes.dashboard.footer')
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>
        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog p-0">
                <div class="modal-content p-0">
                    <div class="modal-body p-0">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal-print" style="display: none;" aria-hidden="true">
            <div class="modal-dialog p-0 modal-xl">
                <div class="modal-content p-0">
                    <div class="modal-body p-0">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.cancel')</button>
                        <button class="btn btn-success ml-1 button-print">
                            <i class="fas fa-print"></i>
                            @lang('site.modal_print')
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    <div id="print">
    </div>
    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->

    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/dist/js/demo.js')}}"></script>
    <script src="{{asset('assets/dist/js/main.js')}}"></script>
    @stack('datatable')
    @include('includes.notify.message')
    @stack('scripts')
</body>

</html>