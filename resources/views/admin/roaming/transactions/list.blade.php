<div class="col-md-12 mt-5" >
    <div class="row">
        <div class="col-md-4">
            <select name="sim_type" class="form-control filter" id="transaction_type">
                <option value="">Transaction Type</option>
                <option value="ROAMING_ACTIVE">ROAMING ACTIVE</option>
                <option value="ROAMING_PAYMENT">ROAMING PAYMENT</option>
            </select>
        </div>
        <div class="col-md-4">
            <input class="form-control filter" name="product_code" placeholder="Enter Msisdn" id="msisdn"/>
        </div>
        <div class="col-md-4">
            <select name="show_in_home" class="form-control filter" id="status">
                <option value="">Activation Status</option>
                <option value="pending">Pending</option>
                <option value="complete">Complete</option>
            </select>
        </div>
    </div>
</div>
<div class="col-md-12 mt-3">

    <table class="table table-striped table-bordered dataTable"
           id="product_list" role="grid">
        <thead>
        <tr>
            <th>Sl.</th>
            <th>Msisdn</th>
            <th>Transaction Type</th>
            <th>User Type</th>
            <th>Transaction ID</th>
            <th>Amount BDT</th>
            <th>Amount USD</th>
            <th>Transaction Status</th>
            <th>Status</th>
            <th>Payment Initiated</th>
            <th>Payment Completed</th>
{{--            <th class="filter_data">Actions</th>--}}
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
@push('page-js')
    {{--    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript">
        </script>--}}
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function () {
            new Clipboard('.copy-text');
            $("#product_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('roaming.transactions.list') }}',
                    data: {
                        transaction_type: function () {
                            return $("#transaction_type").val();
                        },
                        status: function () {
                            return $("#status").val();
                        },
                        msisdn: function () {
                            return $("#msisdn").val();
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
                        name: 'transaction_type',
                        render: function (data, type, row) {;
                            if (row.transaction_type === "ROAMING_ACTIVE") {
                                return "<span class='badge badge-primary'>" + row.transaction_type + "</span>";
                            } else {
                                return "<span class='badge badge-info'>" + row.transaction_type + "</span>";
                            }
                        }
                    },
                    {
                        name: 'user_type',
                        render: function (data, type, row) {
                            return row.user_type;
                        }
                    },
                    {
                        name: 'transaction_id',
                        render: function (data, type, row) {
                            return row.transaction_id;
                        }
                    },
                    {
                        name: 'amount_bdt',
                        render: function (data, type, row) {
                            return row.amount_bdt;
                        }
                    },
                    {
                        name: 'amount_usd',
                        render: function (data, type, row) {
                            return row.amount_usd;
                        }
                    },
                    {
                        name: 'transaction_status',
                        render: function (data, type, row) {;
                            if (row.transaction_status === "VALID") {
                                return "<span class='badge badge-success'>" + row.transaction_status + "</span>";
                            } else {
                                return "<span class='badge badge-warning'>" + row.transaction_status + "</span>";
                            }
                        }
                    },
                    {
                        name: 'status',
                        render: function (data, type, row) {
                            if (row.status === "PENDING") {
                                return "<span class='badge badge-warning'>Pending</span>";
                            } else {
                                return "<span class='badge badge-success'>Completed</span>";
                            }
                        }
                    },
                    {
                        name: 'payment_initiated',
                        render: function (data, type, row) {
                            let status = row.payment_initiated;
                            if (status == 1) {
                                return "<span class='badge badge-success'>Yes</span>";
                            } else {
                                return "<span class='badge badge-danger'>No</span>";
                            }
                        }
                    },
                    {
                        name: 'payment_complete',
                        render: function (data, type, row) {
                            let status = row.payment_completed;
                            if (status == 1) {
                                return "<span class='badge badge-success'>Yes</span>";
                            } else {
                                return "<span class='badge badge-danger'>No</span>";
                            }
                        }
                    },
                    // {
                    //     name: 'actions',
                    //     className: 'filter_data',
                    //     render: function (data, type, row) {
                    //         if (row.status === "PENDING") {
                    //             return `<div class="btn-group" role="group" aria-label="Basic example">
                    //                 <button class="btn btn-sm btn-success edit" onclick="startActivationProcess('` + row.transaction_id + `');">Start Process</button>
                    //             </div>`
                    //         } else {
                    //             return `<div class="btn-group" role="group" aria-label="Basic example">
                    //                 <button class="btn btn-sm btn-icon btn-info disabled">Completed</button>
                    //             </div>`
                    //         }
                    //     }
                    // }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#product_list').DataTable().ajax.reload();
            });
        });

        {{--function startActivationProcess(transaction_id){--}}
        {{--    alert("Are you sure?")--}}
        {{--    $.ajax({--}}
        {{--        url: "{{ url('roaming/dispatch-payment-job') }}/"+transaction_id,--}}
        {{--        methods: "get",--}}
        {{--        success: function (result) {--}}

        {{--            if(result.status_code === 200){--}}
        {{--                Swal.fire(--}}
        {{--                    'Success!',--}}
        {{--                    'Payment Processed Successfully',--}}
        {{--                    'success',--}}
        {{--                );--}}
        {{--            }else{--}}
        {{--                Swal.fire(--}}
        {{--                    'Oops!',--}}
        {{--                    'Something went wrong please try again ',--}}
        {{--                    'error',--}}
        {{--                );--}}
        {{--            }--}}
        {{--            setTimeout(redirect, 2000)--}}
        {{--            function redirect() {--}}
        {{--                $('#product_list').DataTable().ajax.reload();--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>
@endpush



