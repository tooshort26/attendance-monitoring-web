<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="icon" href="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569386717/ogi-sys/andres-soriano-logo.png"> --}}
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>{{ config('app.name') }}  | @yield('title')</title>
        <!-- Styles -->
        
        <!-- Custom fonts for this template-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/fontawesome-free/css/all.min.css">
        <!-- Custom styles for this template-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/css/sb-admin-2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <style>
            .bg-login-image {
                background:url({{URL::asset('img/undraw_login_jdch.svg')}}) center center; 
                background-size: cover;
            }
        </style>
        @stack('page-css')
    </head>
        <body id="page-top">
             <!-- Page Wrapper -->
  <div id="wrapper">
