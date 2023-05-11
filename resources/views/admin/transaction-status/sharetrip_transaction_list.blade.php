@extends('layouts.admin')
@section('title', 'Sharetrip Transaction Status')
@section('card_name', 'Sharetrip Transaction Status')
@section('breadcrumb')
    <li class="breadcrumb-item active">Sharetrip Transaction Status</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="col-md-12 mt-5" >
                        <div class="row">
                            <div class="col-md-3">
                                <input class="form-control filter" name="booking_code" placeholder="Enter Booking Code to Filter" id="booking_code"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <table class="table table-striped table-bordered dataTable"
                            id="sharetrip_transaction_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Msisdn</th>
                                <th>pnr code</th>
                                <th>Booking Code</th>
                                <th>Booking Status</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Created At</th>
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
            $("#sharetrip_transaction_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('mybl.transaction-status.sharetrip.list') }}',
                    data: {
                        booking_code: function () {
                            return $("#booking_code").val();
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
                        name: 'msisdn',
                        render: function (data, type, row) {
                            return row.msisdn;
                        }
                    },
                    
                    {
                        name: 'pnr_code',
                        render: function (data, type, row) {
                            return row.pnr_code;
                        }
                    },
                    
                    {
                        name: 'booking_code',
                        render: function (data, type, row) {
                            return row.booking_code;
                        }
                    },
                    
                    {
                        name: 'booking_status',
                        render: function (data, type, row) {
                            return row.booking_status;
                        }
                    },
                    
                    {
                        name: 'payment_status',
                        render: function (data, type, row) {
                            return row.payment_status;
                        }
                    },
                    
                    {
                        name: 'amount',
                        render: function (data, type, row) {
                            return row.amount;
                        }
                    },
                    
                    {
                        name: 'createdAt	',
                        render: function (data, type, row) {
                            return row.createdAt	;
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#sharetrip_transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
