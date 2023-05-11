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
                <div class="card-body card-dashboard">
                    <div class="col-md-12 mt-5" >
                        <div class="row">
                            <div class="col-md-3">
                                <input class="form-control filter" name="bill_payment_id" placeholder="Enter Bill Payment Id to Filter" id="bill_payment_id"/>
                            </div>
                        </div>
                    </div>
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
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function () {
            $("#commerce_transaction_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('commerce-bill-status') }}',
                    data: {
                        bill_payment_id: function () {
                            return $("#bill_payment_id").val();
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
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#commerce_transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
