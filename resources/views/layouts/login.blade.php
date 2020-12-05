<!DOCTYPE html>

<html dir="{{$defaultLang['dir']}}" lang="{{$defaultLang['abbr']}}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>any</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.'.$defaultLang['dir'].'min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/dist/css/main.css')}}">
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

<body class="hold-transition text-sm login-page">

    @yield('content')

    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- AdminLTE App -->

    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/dist/js/demo.js')}}"></script>
    <script>
        $(function(){
            $("#governorate_id").change(function () {
        var id = $(this).val();
        $("#city_id").html("");
        $.get(
            "/get-cities",
            {
                governorate_id: id,
            },
            function (data) {
                $.each(
                    data,
                    function (index, city) {
                        $("#city_id").append(
                            $("<option></option>").val(city.id).html(city.name)
                        );
                    },
                    "json"
                );

                if ($("#city_id").attr("data")) {
                    $("#city_id").val($("#city_id").attr("data"));
                }
                $("#city_id").removeAttr("data");
            }
        );
    });
        });
    </script>
</body>

</html>