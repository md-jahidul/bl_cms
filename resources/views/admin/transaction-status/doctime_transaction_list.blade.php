@extends('layouts.admin')
@section('title', 'DocTime Transaction Status')
@section('card_name', 'DocTime Transaction Status')
@section('breadcrumb')
    <li class="breadcrumb-item active">DocTime Transaction Status</li>
@endsection
@section('content')
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
                            id="doctime_transaction_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Transaction Id</th>
                                <th>Contact No</th>
                                <th>Service</th>
                                <th>Service Id</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Transaction Time</th>
                                <th>Remarks</th>
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
    <script>
        $(function () {
            
            $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

            $("#doctime_transaction_list").dataTable({
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
                    url: '{{ route('mybl.transaction-status.doctime.list') }}',
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
                        name: 'contact_no',
                        render: function (data, type, row) {
                            return row.contact_no;
                        }
                    },
                    
                    {
                        name: 'service',
                        render: function (data, type, row) {
                            return row.service;
                        }
                    },
                    
                    {
                        name: 'service_id',
                        render: function (data, type, row) {
                            return row.service_id;
                        }
                    },
                    
                    {
                        name: 'amount',
                        render: function (data, type, row) {
                            return row.amount;
                        }
                    },
                    
                    {
                        name: 'payment_status	',
                        render: function (data, type, row) {
                            return row.payment_status	;
                        }
                    },
                    
                    {
                        name: 'transaction_time	',
                        render: function (data, type, row) {
                            return row.transaction_time	;
                        }
                    },
                    
                    {
                        name: 'remarks	',
                        render: function (data, type, row) {
                            return row.remarks	;
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
                $('#doctime_transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
