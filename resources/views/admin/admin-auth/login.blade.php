{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <title>AdminLTE 3 | Log in</title>--}}
{{--    <!-- Tell the browser to be responsive to screen width -->--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <!-- Font Awesome -->--}}
{{--    <link rel="stylesheet" href="{{ asset('/back-end') }}/plugins/fontawesome-free/css/all.min.css">--}}
{{--    <!-- Ionicons -->--}}
{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
{{--    <!-- icheck bootstrap -->--}}
{{--    <link rel="stylesheet" href="{{ asset('/back-end') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">--}}
{{--    <!-- Theme style -->--}}
{{--    <link rel="stylesheet" href="{{ asset('/back-end') }}/dist/css/adminlte.min.css">--}}
{{--    <!-- Google Font: Source Sans Pro -->--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
{{--</head>--}}
{{--<body class="hold-transition login-page">--}}
{{--<div class="login-box">--}}
{{--    <div class="login-logo">--}}
{{--        <a href="../../index2.html"><b>Asset</b>Lite</a>--}}
{{--    </div>--}}
{{--    <!-- /.login-logo -->--}}
{{--    <div class="card">--}}
{{--        <div class="card-body login-card-body">--}}
{{--            <p class="login-box-msg">Sign in to start your session</p>--}}

{{--            <form action="{{ route('login') }}" method="post">--}}
{{--                @csrf--}}
{{--                <div class="input-group mb-3">--}}
{{--                    <input type="email" class="form-control" placeholder="Email">--}}

{{--                    <input id="email" type="email" placeholder="Enter your email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                    @error('email')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                    @enderror--}}

{{--                    <div class="input-group-append">--}}
{{--                        <div class="input-group-text">--}}
{{--                            <span class="fas fa-envelope"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="input-group mb-3">--}}
{{--                    <input type="password" class="form-control" placeholder="Password">--}}
{{--                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}
{{--                    @error('password')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                    @enderror--}}

{{--                    <div class="input-group-append">--}}
{{--                        <div class="input-group-text">--}}
{{--                            <span class="fas fa-lock"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-8">--}}
{{--                        <div class="icheck-primary">--}}
{{--                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                            <label for="remember">--}}
{{--                                Remember Me--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.col -->--}}
{{--                    <div class="col-4">--}}
{{--                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>--}}
{{--                    </div>--}}
{{--                    <!-- /.col -->--}}
{{--                </div>--}}
{{--            </form>--}}

{{--            <form method="POST" action="{{ route('login') }}">--}}
{{--                @csrf--}}
{{--                <div class="form-group row">--}}
{{--                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                        @error('email')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                <strong>{{ $message }}</strong>--}}
{{--                            </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group row">--}}
{{--                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                        @error('password')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group row">--}}
{{--                    <div class="col-md-6 offset-md-4">--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                            <label class="form-check-label" for="remember">--}}
{{--                                {{ __('Remember Me') }}--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group row mb-0">--}}
{{--                    <div class="col-md-8 offset-md-4">--}}
{{--                        <button type="submit" class="btn btn-primary">--}}
{{--                            {{ __('Login') }}--}}
{{--                        </button>--}}

{{--                        @if (Route::has('password.request'))--}}
{{--                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                {{ __('Forgot Your Password?') }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--            <!-- /.social-auth-links -->--}}
{{--        </div>--}}
{{--        <!-- /.login-card-body -->--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- /.login-box -->--}}

{{--<!-- jQuery -->--}}
{{--<script src="{{ asset('/back-end') }}/plugins/jquery/jquery.min.js"></script>--}}
{{--<!-- Bootstrap 4 -->--}}
{{--<script src="{{ asset('/back-end') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}

{{--</body>--}}
{{--</html>--}}


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Asset Lite CMS Login</title>
{{--    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">--}}
{{--    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
          rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/css/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme') }}/assets/css/style.css">
    <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
      data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-md-8 offset-2 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <img src="{{ asset('logo/logo.png') }}" height="70" alt="branding logo">
                                </div>
{{--                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">--}}
{{--                                    <span>Easily Using</span>--}}
{{--                                </h6>--}}
                            </div>
                            <div class="card-content">
{{--                                <div class="text-center">--}}
{{--                                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook">--}}
{{--                                        <span class="la la-facebook"></span>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter">--}}
{{--                                        <span class="la la-twitter"></span>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin">--}}
{{--                                        <span class="la la-linkedin font-medium-4"></span>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-github">--}}
{{--                                        <span class="la la-github font-medium-4"></span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                    <span><strong>Asset-Lite CMS Login Panel</strong></span>
                                </p>
                                <div class="card-body">
{{--                                    <form class="form-horizontal" action="index.html" novalidate>--}}
                                    <form class="form-horizontal" action="{{ route('login') }}" method="post" novalidate>
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="user-name" placeholder="Your Username"
                                                   required>
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="user-password" placeholder="Enter Password"
                                                   required>
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </fieldset>
                                        <div class="form-group row">
                                        </div>
                                        <button type="submit" class="btn btn-outline-warning btn-block"><i class="ft-unlock"></i> Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('theme') }}/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('theme') }}/vendors/js/forms/validation/jqBootstrapValidation.js"
        type="text/javascript"></script>
<!-- BEGIN MODERN JS-->
<script src="{{asset('theme') }}/js/core/app-menu.js" type="text/javascript"></script>
<script src="{{asset('theme') }}/js/core/app.js" type="text/javascript"></script>
<!-- END MODERN JS-->
</body>
</html>
