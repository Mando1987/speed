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
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.'.defaultLangDirection().'min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/print.css')}}">
    <!-- Google Font: Source Sans Pro -->
    @if(defaultLangAbbr() == 'ar')
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
<body class="">
    <section class="content">
        @yield('content')
    </section>
</body>

</html>