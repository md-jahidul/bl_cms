@extends('layouts.admin')
@section('title', 'Onmobile Transaction Status')
@section('card_name', 'OnMobile Transaction Status')
@section('breadcrumb')
    <li class="breadcrumb-item active">Onmobile Transaction Status</li>
@endsection
@section('content')
    @php
        @endphp
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="row" style="margin-bottom: -20px;">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <table border="0" cellspacing="5" cellpadding="5" style="float: right">
                            <tr>
                                <td>Transaction Id:</td>
                                <td><input type="text" class="form-control" id="transaction_id" name="transaction_id" autocomplete="off"></td>
                                <td>From:</td>
                                <td><input type="text" class="datepicker form-control" id="from" name="from" autocomplete="off"></td>
                                <td>To:</td>
                                <td><input type="text" class="datepicker form-control" id="to" name="to" autocomplete="off"></td>
                                <td><input id="submit" value="Search"  class="btn btn-sm btn-success "  type="button" ></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <div class="col-md-12 mt-3">
                        <table class="table table-striped table-bordered dataTable"
                               id="onmobile_transaction_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Transaction Id</th>
                                <th>CreatedAt</th>
                                <th>Msisdn</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Subscription Id</th>
                                <th>Event</th>
                                <th>Date</th>
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
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
        div.dataTables_wrapper div.dataTables_filter {
            text-align: right;
            margin-top: -52px;
        }
        .dt-buttons.btn-group {
            text-align: center;
            margin-bottom: 2px;
            /*margin-left: 27%;*/
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(function () {
            $('.datepicker').datetimepicker({
                format : 'YYYY-MM-DD',
                showClose: true,
            });

            $("#onmobile_transaction_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                lengthMenu: [[30, 50, -1], [30, 50, "All"]],
                pageLength: 30,
                lengthChange: true,
                ajax: {
                    url: '{{ route('mybl.transaction-status.list',['type' => request('type')]) }}',
                    data: {
                        transaction_id: function () {
                            return $("#transaction_id").val();
                        },
                        from: function () {
                            return $("#from").val();
                        },
                        to: function () {
                            return $("#to").val();
                        }
                    }
                },
                columns: [
                    {
                        name: 'sl',
                        width: '30px',
                        render: function () {
                            return null;
                        }
                    },

                    {
                        name: 'transaction_id',
                        render: function (data, type, row) {
                            return row.transaction_id;
                        }
                    },

                    {
                        name: 'createdAt',
                        render: function (data, type, row) {
                            return row.createdAt;
                        }
                    },

                    {
                        name: 'msisdn',
                        render: function (data, type, row) {
                            return row.msisdn;
                        }
                    },

                    {
                        name: 'status',
                        render: function (data, type, row) {
                            return row.status;
                        }
                    },

                    {
                        name: 'amount',
                        render: function (data, type, row) {
                            return row.amount;
                        }
                    },

                    {
                        name: 'subscriptionId',
                        render: function (data, type, row) {
                            return row.subscriptionId	;
                        }
                    },

                    {
                        name: 'event',
                        render: function (data, type, row) {
                            return row.event	;
                        }
                    },

                    {
                        name: 'date',
                        render: function (data, type, row) {
                            return row.date	;
                        }
                    }
                ],
                dom: 'Blfrtip',
                buttons:  [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7,8]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7,8]
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $( "#submit" ).click(function() {
                $('#onmobile_transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
