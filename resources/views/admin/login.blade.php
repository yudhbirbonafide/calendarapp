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
    <!-- Custom CSS -->
</head>
<body>
<div class="auth-wrapper">
<div class="auth-content">
        <div class="auth-bg">
            <span class="r"></span>
            <span class="r s"></span>
            <span class="r s"></span>
            <span class="r"></span>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="feather icon-unlock auth-icon"></i>
                        </div>
                        <h3 class="mb-4">Login</h3>
                        <form method="POST" action="{{ route('admin_login') }}" id="login_frm">
                            @csrf
                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                            </div>
                            <div class="row ml-1">
                                <button type="submit" class="btn btn-primary shadow-2 mb-4"> {{ __('Login') }} </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
<script src="{{asset('admin/assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>
