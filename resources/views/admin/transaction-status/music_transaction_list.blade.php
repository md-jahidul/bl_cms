@extends('layouts.admin')
@section('title', 'Music Transaction Status')
@section('card_name', 'Music Transaction Status')
@section('breadcrumb')
    <li class="breadcrumb-item active">Music Transaction Status</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="row" style="margin-bottom: -20px;">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <table border="0" cellspacing="5" cellpadding="5" style="float: right">
                            <tr>
                                <td>Payment Id:</td>
                                <td><input type="text" class="form-control" id="payment_id" name="payment_id" autocomplete="off"></td>
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
                            id="music_transaction_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Subscription Request Id</th>
                                <th>Action Type</th>
                                <th>Action Message</th>
                                <th>Payment Id</th>
                                <th>Msisdn</th>
                                <th>Service Id</th>
                                <th>Amount</th>
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

            $("#music_transaction_list").dataTable({
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
                    url: '{{ route('mybl.transaction-status.music.list') }}',
                    data: {
                        payment_id: function () {
                            return $("#payment_id").val();
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
                        name: 'subscription_request_id',
                        render: function (data, type, row) {
                            return row.subscription_request_id;
                        }
                    },
                    
                    {
                        name: 'action_type',
                        render: function (data, type, row) {
                            return row.action_type;
                        }
                    },
                    
                    {
                        name: 'action_message',
                        render: function (data, type, row) {
                            return row.action_message;
                        }
                    },
                    
                    {
                        name: 'payment_id',
                        render: function (data, type, row) {
                            return row.payment_id;
                        }
                    },
                    
                    {
                        name: 'msisdn',
                        render: function (data, type, row) {
                            return row.msisdn;
                        }
                    },
                    
                    {
                        name: 'service_id',
                        render: function (data, type, row) {
                            return row.service_id;
                        }
                    },
                    
                    {
                        name: 'amount	',
                        render: function (data, type, row) {
                            return row.amount	;
                        }
                    }
                ],
                dom: 'Blfrtip',
                buttons:  [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6,7]
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $( "#submit" ).click(function() {
                $('#music_transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
