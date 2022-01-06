@extends('layouts.admin')
@section('title', 'Header Enrichment Logs')
@section('card_name', 'Header Enrichment Logs')

@section('action')
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered dataTable" id="header_enrichment_table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Msisdn</th>
                            <th>Status</th>
                            <th>Request Date & Time</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
@endpush
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush
@push('page-js')
<script src="{{ asset('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/pickers/daterange/daterangepicker.js"></script>
    <script>
        $(function () {
            // $('input[name="date_range"]').daterangepicker({
            //     autoUpdateInput: false,
            //     showDropdowns: true,
            //     locale: {
            //         cancelLabel: 'Clear',
            //         format: 'YYYY-MM-DD'
            //     },
            // });

            $("#header_enrichment_table").dataTable({
                lengthChange: true,
                lengthMenu: [[5, 10, 25, 50], [5, 10, 25, "All"]],
                pageLength: 5,
                paging: true,
                processing: true,
                searching: true,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                // dom: 'Bfrtip',
                // buttons: [
                //     { extend: 'excelHtml5', className: 'btn-primary pull-right btn-sm' },
                //     { extend: 'csvHtml5', className: 'btn-primary btn-sm' },
                // ],
                ajax: {
                    url: '{{ route('header-enrichment-logs') }}',
                    data: {
                        date: function () {
                            return $('input[name="date_range"]').val();
                        },
                        ratings: function () {
                            return $("#ratings").val();
                        }
                    }
                },
                columns: [
                    {
                        name: 'sl',
                        render: function (data, type, row) {
                            return null;
                        }
                    },
                    {
                        name: 'msisdn',
                        render: function (data, type, row) {
                            return row.msisdn
                        }
                    },
                    {
                        name: 'response_status',
                        render: function (data, type, row) {
                            let responseStatus = '';
                            if(row.response_status === 200) {
                                responseStatus += '<span class="badge badge-default badge-pill bg-success">Success</span>'
                            } else {
                                responseStatus += '<span class="badge badge-default badge-pill bg-danger">Failed</span>'
                            }
                            return responseStatus;
                        }
                    },
                    {
                        name: 'created_at',
                        render: function (data, type, row) {
                            return row.created_at;
                        }
                    }

                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });
        });
    </script>
@endpush
