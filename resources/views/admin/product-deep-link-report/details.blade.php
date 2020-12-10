@extends('layouts.admin')
@section('title', 'Deeplink Product Purchase Details')
@section('card_name', 'Deeplink Product Purchase Details')
@section('breadcrumb')
    <li class="breadcrumb-item active">Deeplink Product Purchase Details</li>
@endsection
@section('action')
            <a href="{{ route('target-wise-notification-report.report') }}" class="btn btn-primary round btn-glow px-2"><i class="la la-list"></i>
               Report List
            </a>
@endsection
@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 flex">
                            <div class="row" style="text-align: center">
                            <div class="col-md-2"> <b>Product Type : </b></div>
                            <div class="col-md-3">
                                <select class="form-control" name="action" id="option">
                                    <option value="">Select Option</option>
                                    <option value="view">View</option>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Msisdn</th>
                            <th width="12%">Action Type</th>
                            <th width="10%">Action Status</th>
                            <th width="30%">Action URL</th>
                            <th width="15%">Date</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            let productCodeId='<?php echo $productDeeplinkDbId;?>';
            $("#Example1").dataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ordering: false,
                // dataType: "json",
                ajax: {
                    url: '{{ route('deeplink-product-purchase-details') }}/'+productCodeId,
                    type: 'GET',
                    data: function ( d ) {
                        d.option_name=$("#option").val();
                        d.product_code_id=productCodeId;
                        d.search_name=d.search.value;
                        return d;

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
                        name: 'action_type',
                        render: function (data, type, row) {
                            return row.action_type;
                        }
                    },
                    {
                        name: 'action_status',
                        render: function (data, type, row) {
                            return row.action_status;
                        }
                    },{
                        name: 'action_url',
                        render: function (data, type, row) {
                            return row.action_url;
                        }
                    },{
                        name: 'date',
                        render: function (data, type, row) {
                            return row.date;
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });
            $(document).on('change', '#option', function (e) {
                $('#Example1').DataTable().ajax.reload();
            });
        });

    </script>
@endpush
