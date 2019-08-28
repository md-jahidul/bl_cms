<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="">
    <meta name="keywords"
          content="">
    <meta name="author" content="">
    <title>@yield('title') - AssetLite CMS</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="apple-touch-icon" href="{{asset('theme/assets/images/ico/apple-icon-120.png')}}">
    {{--fevicon--}}
    {{--    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/images/ico/favicon.ico') }}">--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
          rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/vendors.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/selects/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/selectize/selectize.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/app.css')}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/core/colors/palette-gradient.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/plugins/forms/checkboxes-radios.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('theme/vendors/css/charts/jquery-jvectormap-2.0.3.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/vendors/css/charts/morris.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/fonts/simple-line-icons/style.css')}}">


    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/ui/jqueryui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">

    <!-- Begin File uploader dropzone CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/file-uploaders/dropzone.css') }}">


    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/assets/css/style.css')}}">
    <!-- END Custom CSS-->
    @yield('page-css')
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<!-- fixed-top-->
@include('layouts.partials.fixed_top')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('layouts.partials.left_menu')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">@yield('card_name')</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Admin</a>
                            </li>
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="dropdown float-md-right">
                    @yield('action')
                </div>
            </div>
        </div>

        <div class="content-body">
            @include('layouts.partials.alert_message')
            @yield('content')
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('layouts.partials.footer')
<!-- BEGIN VENDOR JS-->
<script src="{{asset('/theme/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
<script src="{{asset('/theme/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('/theme/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('/theme/js/scripts/customizer.js')}}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/tables/datatables/datatable-basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/ui/jquery-ui/date-pickers.js') }}" type="text/javascript"></script>

<script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

@stack('page-js')
</body>
</html>