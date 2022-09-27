@extends('layouts.admin')
@section('title', 'Campaign Modality Purchase Detail')
@section('card_name', 'Campaign Modality Purchase Detail')

@section('action')
    <a href="{{ route('new-campaign-analytic.report', $campaignId) }}" class="btn btn-primary round btn-glow px-2">
        <i class="la la-list"></i>
        Product Purchase List
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">

                <div class="card-body">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Date Range</label>
                                <input type="text" required name="date_range" id="from" class="form-control datetime"
                                       placeholder="Pick Dates to filter" autocomplete="off">
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">MSISDN</label>
                                <input type="text" name="msisdn" placeholder="e.g: 019xxxxxxxx" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>

{{--                <div class="card-header">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <table class="table">--}}
{{--                                <tr>--}}
{{--                                    <td><strong>Product Code:</strong></td>--}}
{{--                                    <td colspan="5">--}}{{--{{$popup->title}}--}}{{--</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td><strong>Popup Stat :</strong></td>--}}
{{--                                    <td>--}}
{{--                                        <span class="badge badge-success">--}}
{{--                                            Total Purchase Success:--}}
{{--                                        </span>--}}
{{--                                        <strong>10</strong>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <span class="badge badge-danger">--}}
{{--                                            Total Purchase Failed:--}}
{{--                                         {{ $popupPurchaseLogDetails->where('action_type', 'popup_cancel')->count('action_type') ?? 0 }}--}}
{{--                                        </span>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered dataTable"
                           role="grid" aria-describedby="Example1_info" id="purchase-msisdn">
                        <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th width="10%">MSISDN</th>
                            <th width="10%">Purchase Status</th>
                            <th width="10%">Purchase Failed Reason</th>
                            <th width="10%">Date And Time</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">

    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
    </style>
@endpush

@push('page-js')

    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>

    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.datetime').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY/MM/DD'
                }
            });

            $('.datetime').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('.datetime').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $("#from").val("{{\Illuminate\Support\Facades\Input::get('date_range') ?? ''}}");

            $("#purchase-msisdn").dataTable({
                processing: true,
                searching: false,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ordering: false,
                lengthChange: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4]
                        }
                    }
                ],

                ajax: {
                    url: "",
                    data: {
                        msisdn: function () {
                            return $('input[name="msisdn"]').val();
                        },
                        date_range: function () {
                            return $('input[name="date_range"]').val();
                        }
                    }
                },
                columns: [
                    {
                        name: 'sl',
                        width: "2%",
                        render: function () {
                            return null;
                        }
                    },
                    {
                        name: 'msisdn',
                        width: "15%",
                        render: function (data, type, row) {
                            return row.msisdn;
                        }
                    },
                    {
                        name: 'purchase_status',
                        width: "6%",
                        render: function (data, type, row) {
                            let statusData = "";
                            if (row.action_type === 'buy_success') {
                                statusData = `<span class="badge badge-success">`+row.action_type+`</span>`;
                            } else {
                                statusData = `<span class="badge badge-danger">`+row.action_type+`</span>`;
                            }
                            return statusData;
                        }
                    },
                    {
                        name: 'failed_reason',
                        width: "6%",
                        render: function (data, type, row) {
                            return row.failed_reason;
                        }
                    },
                    {
                        name: 'created_at',
                        width: "10%",
                        render: function (data, type, row) {
                            return row.created_at;
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });

            $('input[name="msisdn"]').keyup(function() {
                $('#purchase-msisdn').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $('#purchase-msisdn').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#purchase-msisdn').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
