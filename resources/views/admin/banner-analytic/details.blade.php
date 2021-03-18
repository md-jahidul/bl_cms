@extends('layouts.admin')
@section('title', 'Banner Analytic Details')
@section('card_name', "Banner Analytic Report Details")

@section('action')
    <a href="{{ url('banner-analytic') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i>
        Report
        List </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="row" style="margin-bottom: -20px;">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <table border="0" cellspacing="5" cellpadding="5">
                            <tr>
                                <td>From:</td>
                                <td><input type="text" class="datepicker form-control" id="from" name="from"
                                           autocomplete="off"
                                           value="@if(!empty($from)){{date("Y-m-d", strtotime($from))}} @endif"></td>
                                <td>To:</td>
                                <td><input type="text" class="datepicker form-control" id="to" name="to"
                                           autocomplete="off"
                                           value="@if(!empty($to)){{date("Y-m-d", strtotime($to))}} @endif"></td>
                                <td><input id="submit" value="Search" class="btn btn-sm btn-success " type="button">
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="row table-responsive">
                    <div class="col-md-12 pt-2 pb-2">
                        <table class="table table-striped table-bordered dataTable"
                               id="question_list_table" role="grid">
                            <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="10%">Slider name</th>
                                <th width="10%">Image name</th>
                                <th width="15%">Msisdn</th>
                                <th width="12%">Action</th>
                                <th width="10%">Session time</th>
                                <th width="30%">Error</th>
                                <th width="15%">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        .add-button {
            margin-top: 1.9rem !important;
        }

        .filter_data {
            text-align: right;
        }

        .dataTable {
            width: 100% !important;
        }

        .dt-buttons.btn-group {
            margin-bottom: -70px;
        }

        div#question_list_table_length {
            margin-bottom: -50px;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>

    <script>
        $(function () {
            $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'}).val();
            $('#question_list_table').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                pageLength: 10,
                ajax: {
                    'url': "{{ route('banner-analytic.report.details',$deeplinkId) }}",
                    'data': function (data) {
                        let fromdate = $('#from').val();
                        ;
                        let todate = $('#to').val();
                        if (fromdate !== "") {
                            data.from = fromdate;
                        }
                        if (fromdate !== "") {
                            data.to = todate;
                        }
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'slider_name', name: 'slider_name'},
                    {data: 'slider_image_name', name: 'slider_image_name'},
                    {data: 'msisdn', name: 'msisdn'},
                    {data: 'action_type', name: 'action_type'},
                    {data: 'session_time', name: 'session_time'},
                    {data: 'error_title', name: 'error_title'},
                    {
                        data: 'date',
                        name: 'date',
                        orderable: true,
                        searchable: true
                    },
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                ]
            });
            $(document).on('change', '#filter_category', function (e) {
                $('#question_list_table').DataTable().ajax.reload();
            });
        });
        $("#submit").click(function () {
            $('#question_list_table').DataTable().ajax.reload();
        });
    </script>
@endpush
