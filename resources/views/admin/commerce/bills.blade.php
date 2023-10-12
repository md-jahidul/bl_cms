@extends('layouts.admin')
@section('title', 'Commerce Bill Status')
@section('card_name', 'Commerce Bill Status')
@section('breadcrumb')
    <li class="breadcrumb-item active">Commerce Bill Status</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="row" style="margin-bottom: -20px;">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <table border="0" cellspacing="5" cellpadding="5" style="float: right">
                            <tr>
                                <td>Bill Payment Id:</td>
                                <td><input type="text" class="form-control" id="bill_payment_id" name="bill_payment_id" autocomplete="off"></td>
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
                            id="commerce_transaction_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Result</th>
                                <th>Message</th>
                                <th>Bill Payment Id</th>
                                <th>Bill Refer Id</th>
                                <th>Bllr Id</th>
                                <th>Bill Name</th>
                                <th>Bill No</th>
                                <th>Biller Acc No</th>
                                <th>Biller Mobile</th>
                                <th>Bill From</th>
                                <th>Bill To</th>
                                <th>Bill Gen. Date</th>
                                <th>Bill Due Date</th>
                                <th>Charge</th>
                                <th>Bill Total Amount</th>
                                <th>Transaction Id</th>
                                <th>Payment Date</th>
                                <th>Payment Status</th>
                                <th>Payment Amount</th>
                                <th>Payment Trx Id</th>
                                <th>Payment Method</th>
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

            $("#commerce_transaction_list").dataTable({
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
                    url: '{{ route('commerce-bill-status') }}',
                    data: {
                        bill_payment_id: function () {
                            return $("#bill_payment_id").val();
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
                        name: 'result',
                        render: function (data, type, row) {
                            return row.result;
                        }
                    },
                    
                    {
                        name: 'message',
                        render: function (data, type, row) {
                            return row.message;
                        }
                    },
                    
                    {
                        name: 'bill_payment_id',
                        render: function (data, type, row) {
                            return row.bill_payment_id;
                        }
                    },
                    
                    {
                        name: 'bill_refer_id',
                        render: function (data, type, row) {
                            return row.bill_refer_id;
                        }
                    },
                    
                    {
                        name: 'bllr_id',
                        render: function (data, type, row) {
                            return row.bllr_id;
                        }
                    },
                    
                    {
                        name: 'bill_name',
                        render: function (data, type, row) {
                            return row.bill_name;
                        }
                    },
                    
                    {
                        name: 'bill_no	',
                        render: function (data, type, row) {
                            return row.bill_no	;
                        }
                    },
                    
                    {
                        name: 'biller_acc_no	',
                        render: function (data, type, row) {
                            return row.biller_acc_no	;
                        }
                    },
                    
                    {
                        name: 'biller_mobile	',
                        render: function (data, type, row) {
                            return row.biller_mobile	;
                        }
                    },
                    
                    {
                        name: 'bill_from	',
                        render: function (data, type, row) {
                            return row.bill_from	;
                        }
                    },
                    
                    {
                        name: 'bill_to	',
                        render: function (data, type, row) {
                            return row.bill_to	;
                        }
                    },
                    
                    {
                        name: 'bill_gen_date	',
                        render: function (data, type, row) {
                            return row.bill_gen_date	;
                        }
                    },
                    
                    {
                        name: 'bill_due_date	',
                        render: function (data, type, row) {
                            return row.bill_due_date	;
                        }
                    },
                    
                    {
                        name: 'charge	',
                        render: function (data, type, row) {
                            return row.charge	;
                        }
                    },
                    
                    {
                        name: 'bill_total_amount	',
                        render: function (data, type, row) {
                            return row.bill_total_amount	;
                        }
                    },
                    
                    {
                        name: 'transaction_id	',
                        render: function (data, type, row) {
                            return row.transaction_id	;
                        }
                    },
                    
                    {
                        name: 'payment_date	',
                        render: function (data, type, row) {
                            return row.payment_date	;
                        }
                    },
                    
                    {
                        name: 'payment_status	',
                        render: function (data, type, row) {
                            return row.payment_status	;
                        }
                    },
                    
                    {
                        name: 'payment_amount	',
                        render: function (data, type, row) {
                            return row.payment_amount	;
                        }
                    },
                    
                    {
                        name: 'payment_trx_id	',
                        render: function (data, type, row) {
                            return row.payment_trx_id	;
                        }
                    },
                    
                    {
                        name: 'payment_method	',
                        render: function (data, type, row) {
                            return row.payment_method	;
                        }
                    },
                    
                    {
                        name: 'date	',
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
                            columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $( "#submit" ).click(function() {
                $('#commerce_transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
