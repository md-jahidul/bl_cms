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
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="apple-touch-icon" href="{{asset('theme/assets/images/ico/apple-icon-120.png')}}">
    {{--fevicon--}}
    {{--    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/images/ico/favicon.ico') }}">--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
          rel="stylesheet">

    {{--<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">--}}
    <link href="{{ asset('app-assets/fonts/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/vendors.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/selects/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">

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

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
    </script>

    {{--SummerNote Editor CSS--}}
    <link href="{{ asset('app-assets/vendors/js/editors/summernote/summernote-lite.min.css') }}" rel="stylesheet">

    {{--  dropify  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    {{--Summernote Table Colore Modify--}}
    <style>
        .note-editor.note-frame.fullscreen .note-editable {
            background-color: white;
        }
        .table-primary th {
            background-color: #b1e2e7; /* #d9eef0 This front-end default table colour */
        }
        .table-primary, .table-primary > th, .table-primary > td {
            background-color: white;
        }
    </style>

    @stack('page-css')
    @yield('page-css')
    @stack('style')
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<!-- fixed-top-->
@include('layouts.partials.fixed_top')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('layouts.partials.left_menu.parent')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">@yield('card_name')</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb mb-1">
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
{{--<script src="{{asset('/theme/js/core/app.js')}}" type="text/javascript"></script>--}}
<script src="{{asset('/theme/js/scripts/customizer.js')}}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/tables/datatables/datatable-basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/ui/jquery-ui/date-pickers.js') }}" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/forms/toggle/switchery.min.js')}}"></script>

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

<script src="{{ asset('theme/js/scripts/ui/jquery-ui/navigations.js') }}" type="text/javascript"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- END PAGE LEVEL JS-->

<!-- Dropify -->
<script src="{{asset('app-assets/vendors/js/dropify/dropify.min.js')}}" type="text/javascript"></script>



<!-- URL Slug Converter -->
<script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>

@stack('page-js')

<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote_0.8.18/summernote-table-headers.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        $("textarea.summernote_editor").summernote({
            tableClassName: 'table table-primary table_large offer_table', /* This Table class is front-end table class */
            toolbar: [
                ['style',['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['table', ['table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ],
            popover: {
                table: [
                    ['custom', ['tableHeaders']],
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']]
                ],
            },

            height:200
        })
    })

        function readURL(input) {
        if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imgDisplay').css('display', 'block');
                    $('#imgDisplay').attr('src', e.target.result);

                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            readURL(this);
        });


        function readImageURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile_image_Display').css('display', 'block');
                    $('#profile_image_Display').attr('src', e.target.result);

                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profile_image").change(function() {
            readImageURL(this);
        });



        /**
         * On number type input ignore plus, minus operators. only allow digits
         *
         */
        let myInput = document.querySelectorAll("input[type=number]");

        function keyAllowed(key) {
            let keys = [8, 9, 13, 16, 17, 18, 19, 20, 27, 46, 48, 49, 50,
                51, 52, 53, 54, 55, 56, 57, 91, 92, 93
            ];
            if (key && keys.indexOf(key) === -1)
                return false;
            else
                return true;
        }

        myInput.forEach(function(element) {
            element.addEventListener('keypress', function(e) {
                let key = !isNaN(e.charCode) ? e.charCode : e.keyCode;
                if (!keyAllowed(key))
                    e.preventDefault();
            }, false);

            // Disable pasting of non-numbers
            element.addEventListener('paste', function(e) {
                let pasteData = e.clipboardData.getData('text/plain');
                if (pasteData.match(/[^0-9]/))
                    e.preventDefault();
            }, false);
        })


</script>
<script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
</body>
</html>
