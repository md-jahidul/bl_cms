@extends('layouts.admin')
@section('title', 'Banner Analytics Report')
@section('card_name', "Banner Analytics Report")

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
                                           autocomplete="off" placeholder="Select Start Date"></td>
                                <td>To:</td>
                                <td><input type="text" class="datepicker form-control" id="to" name="to"
                                           autocomplete="off" placeholder="Select End Date"></td>
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
                                <th width="5%">Sl.</th>
                                <th width="10%">Banner</th>
                                <th width="10%">Code</th>
                                <th width="10%">Total View</th>
                                <th width="7%">Total Click</th>
                                <th width="7%">Buy Success</th>
                                <th width="7%">Failure</th>
                                <th width="7%">Cancel</th>
                                <th width="5%">Action</th>
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
                serverSide: false,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                pageLength: 10,
                ajax: {
                    'url': "{{ route('banner-analytic.index') }}",
                    'data': function (data) {
                        let fromdate = $('#from').val();
                        let todate = $('#to').val();
                        if (fromdate !== "") {
                            data.searchByFromdate = fromdate;
                        }
                        if (fromdate !== "") {
                            data.searchByTodate = todate;
                        }
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'banner_name', name: 'banner_name'},
                    {data: 'code', name: 'code'},
                    {data: 'tview', name: 'view_count'},
                    {data: 'click_count', name: 'click_count'},
                    {data: 'total_buy', name: 'total_buy'},
                    {data: 'buy_attempt', name: 'buy_attempt'},
                    {data: 'total_cancel', name: 'total_cancel'},
                    {
                        data: 'action',
                        name: 'action',
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
