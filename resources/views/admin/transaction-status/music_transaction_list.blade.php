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
                <div class="card-body card-dashboard">
                    <div class="col-md-12 mt-5" >
                        <div class="row">
                            <div class="col-md-3">
                                <input class="form-control filter" name="payment_id" placeholder="Enter Payment Id to Filter" id="payment_id"/>
                            </div>
                        </div>
                    </div>
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
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function () {
            $("#music_transaction_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('mybl.transaction-status.music.list') }}',
                    data: {
                        payment_id: function () {
                            return $("#payment_id").val();
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
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#music_transaction_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
