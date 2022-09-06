<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bulk Ammo') }}</title>

    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('images/apple-touch-icon.png')}}">

    <link rel="stylesheet" href="{{asset('admin/assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/animation/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
    <script src="{{asset('admin/assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin/assets/ckeditor/ckeditor.js')}}"></script>
    <!-- Custom CSS -->
    <style>
        .error{color:#ff0000;font-style: italic;}
    </style>
</head>
<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    @include('layouts.admin.sidebar')
    @include('layouts.admin.navigation')
    <div class="col-xl-8 col-md-8" style="margin-left: 264px;">
        @include('layouts.flash-message')
    </div>
    @yield('content')    
	<script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/pcoded.min.js')}}"></script>
</body>
</html>
