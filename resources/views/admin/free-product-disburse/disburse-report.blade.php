@extends('layouts.admin')
@section('title', 'Free Product Disburse Report')
@section('card_name', 'Free Product Disburse Report')
@section('breadcrumb')
    <li class="breadcrumb-item active">Free Product Disburse Report</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="row" style="margin-bottom: -20px;">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <table border="0" cellspacing="5" cellpadding="5" style="float: right">
                            <tr>
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
                            id="free_product_disburse_report" role="grid">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>File Id</th>
                                    <th>msisdn</th>
                                    <th>product_code</th>
                                    <th>Disburse Status</th>
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

            $("#free_product_disburse_report").dataTable({
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
                    url: '{{ route('free-product-disburse-report.list') }}',
                    data: {
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
                        name: 'file_id',
                        render: function (data, type, row) {
                            return row.file_id;
                        }
                    },
                    
                    {
                        name: 'msisdn',
                        render: function (data, type, row) {
                            return row.msisdn;
                        }
                    },
                    
                    {
                        name: 'product_code',
                        render: function (data, type, row) {
                            return row.product_code;
                        }
                    },
                    
                    {
                        name: 'is_disburse',
                        render: function (data, type, row) {
                            return row.is_disburse;
                        }
                    },
                    
                    {
                        name: 'created_at	',
                        render: function (data, type, row) {
                            return row.created_at	;
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $( "#submit" ).click(function() {
                $('#free_product_disburse_report').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
