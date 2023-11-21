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
            <th class="filter_data">Actions</th>
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
                        render: function (data, type, row) {
                            return row.transaction_type;
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
                        render: function (data, type, row) {
                            return row.transaction_status;
                        }
                    },
                    {
                        name: 'status',
                        render: function (data, type, row) {
                            return row.status;
                        }
                    },
                    {
                        name: 'payment_initiated',
                        render: function (data, type, row) {
                            return row.payment_initiated;
                        }
                    },
                    {
                        name: 'payment_complete',
                        render: function (data, type, row) {
                            return row.payment_complete;
                        }
                    },
                    {
                        name: 'actions',
                        className: 'filter_data',
                        render: function (data, type, row) {
                            let detail_question_url = "{{ URL('mybl/products/') }}" + "/" + row.product_code;
                            return `<div class="btn-group" role="group" aria-label="Basic example">
                            <a href=" ` + detail_question_url + ` "class="btn btn-sm btn-icon btn-outline-success edit"><i class="la la-eye"></i></a>
                          </div>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#product_list').DataTable().ajax.reload();
            });
        });
    </script>
@endpush



