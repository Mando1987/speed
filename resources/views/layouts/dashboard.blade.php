<!DOCTYPE html>
@php
    $languages= config('languages');
@endphp
<html dir="{{defaultLangDirection()}}" lang="{{defaultLangAbbr()}}">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ siteTitle() }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
    <!-- DataTables -->
  <link rel="stylesheet"
    href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.'.defaultLangDirection().'min.css') }}">
  <link rel="stylesheet"
   href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.'.defaultLangDirection().'min.css') }}">
   
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.'.defaultLangDirection().'min.css')}}">


  <link rel="stylesheet" href="{{asset('assets/dist/css/notify.css')}}">
  <link rel="stylesheet" href="{{asset('assets/dist/css/main.css')}}">
  <!-- Google Font: Source Sans Pro -->
  @if(defaultLangAbbr() == 'ar')
  <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
  <style>
    html,body,h1,h2,h3,h4,h5,h6{
      font-family: 'Cairo' , sans-serif !important; 
    }
  </style>
 @endif
</head>
<body class="hold-transition sidebar-mini">
 
  @auth('admin')

    <div class="wrapper">
        {{-- ########### Header ###################################################### --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
             @include('includes.dashboard.header')
        </nav>
        {{-- ########### Header ###################################################### --}}
        
        {{-- ########### SideBar ###################################################### --}}
        @include('includes.dashboard.sidebar')
        {{-- ########### SideBar ###################################################### --}}
        
        
        <div class="content-wrapper"> <!-- ################################################# start content-wrapper -->
          
           {{-- ########### Bredcrumbs ###################################################### --}}
            @include('includes.dashboard.bredcrumbs')    
           {{-- ########### Bredcrumbs ###################################################### --}}
          
           {{-- ########### Content ###################################################### --}}
           <section class="content">
               @yield('content') 
           </section>
           {{-- ########### Content ###################################################### --}}
          
        </div><!-- ############################################################################ end content-wrapper -->
        
            
        <footer class="main-footer">
            @include('includes.dashboard.footer') 
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>
        
    </div>
  @endauth

  @hasSection ('login')
      @yield('login')      
  @endif


  <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
         
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
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
