<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/back-end') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('/back-end') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/back-end') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('/back-end') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/back-end') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/back-end') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/back-end') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/back-end') }}/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ asset('/back-end') }}/plugins/jquery/jquery.min.js"></script>
    {{--sweetalert2--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    @stack('scripts')




    <!-- jQuery -->
    {{--<script src="{{ asset('/back-end') }}/plugins/jquery/jquery.min.js"></script>--}}
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/back-end') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('/back-end') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('/back-end') }}/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/back-end') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
    @stack('style')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('admin.partials.nav-bar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.partials.left-sidebar')
    <!-- End Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{--<div class="content-header">--}}
            {{--<div class="container-fluid">--}}
                {{--<div class="row mb-2">--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<h1 class="m-0 text-dark">Dashboard</h1>--}}
                    {{--</div><!-- /.col -->--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<ol class="breadcrumb float-sm-right">--}}
                            {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                            {{--<li class="breadcrumb-item active">Dashboard v1</li>--}}
                        {{--</ol>--}}
                    {{--</div><!-- /.col -->--}}
                {{--</div><!-- /.row -->--}}
            {{--</div><!-- /.container-fluid -->--}}
        {{--</div>--}}
        <!-- /.content-header -->

        <!-- Main content -->

        <section class="content">
            <div class="container-fluid">
               @yield('main-content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <!-- /.content-wrapper -->

    {{--Footer start--}}
    @include('admin.partials.footer')
    {{--Footer end--}}

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/back-end') }}/plugins/jquery-ui/jquery-ui.min.js"></script>



<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- overlayScrollbars -->
<script src="{{ asset('/back-end') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

{{--<script>--}}
    {{--$(function () {--}}
        {{--$("#example1").DataTable();--}}
        {{--// $('#example2').DataTable({--}}
        {{--//     "paging": true,--}}
        {{--//     "lengthChange": false,--}}
        {{--//     "searching": false,--}}
        {{--//     "ordering": true,--}}
        {{--//     "info": true,--}}
        {{--//     "autoWidth": false,--}}
        {{--// });--}}
    {{--});--}}
{{--</script>--}}

{{--@stack('scripts')--}}

<!-- Bootstrap 4 -->
<script src="{{ asset('/back-end') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('/back-end') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('/back-end') }}/plugins/sparklines/sparkline.js"></script>


<!-- daterangepicker -->
<script src="{{ asset('/back-end') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('/back-end') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/back-end') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('/back-end') }}/plugins/summernote/summernote-bs4.min.js"></script>

<!-- FastClick -->
<script src="{{ asset('/back-end') }}/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/back-end') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/back-end') }}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/back-end') }}/dist/js/demo.js"></script>
 {{--@stack('scripts')--}}
</body>
</html>
