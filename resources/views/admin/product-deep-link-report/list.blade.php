@extends('layouts.admin')
@section('title', 'Product Deeplink Report')
@section('card_name', 'Product Deeplink Report')
@section('breadcrumb')
    <li class="breadcrumb-item active">Product Deeplink List</li>
@endsection
@section('content')
<section>
    <div class="card card-info mt-0" style="box-shadow: 0px 0px">
        <div class="card-content">
            <div class="card-body card-dashboard table-responsive">
                <table class="table table-striped table-bordered  dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="10%">Product Code</th>
{{--                        <th width="15%">Deeplink</th>--}}
                        <th width="8%">Total View</th>
                        <th width="8%">Total Buy</th>
                        <th width="8%">Total Attempt</th>
                        <th width="8%">Total Cancel</th>
                        <th width="15%">Date</th>
                        <th width="10%">action</th>
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
            $("#Example1").dataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: {
                    url: '{{ route('product-deeplink-list') }}',
                    type: 'GET',
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
                        name: 'product_code',
                        render: function (data, type, row) {
                            return row.product_code;
                        }
                    },
                    // {
                    //     name: 'deep_link',
                    //     render: function (data, type, row) {
                    //         return row.deep_link;
                    //     }
                    // },
                    {
                        name: 'total_view',
                        render: function (data, type, row) {
                            return row.total_view;
                        }
                    },
                    {
                        name: 'total_buy',
                        render: function (data, type, row) {
                            return row.total_buy;
                        }
                    },{
                        name: 'total_cancel',
                        render: function (data, type, row) {
                            return row.total_cancel;
                        }
                    },{
                        name: 'buy_attempt',
                        render: function (data, type, row) {
                            return row.buy_attempt;
                        }
                    },{
                        name: 'date',
                        render: function (data, type, row) {
                            return row.date;
                        }
                    },
                    {
                        name: 'action',
                        render: function (data, type, row) {
                            let viewUrl="{{url('target-wise-notification-report-details')}}/"+row.date;
                            return  `<a  role="button" data-id="" href="`+viewUrl+`" data-placement="right" class="showButton btn btn-outline-info btn-sm"
                                                onclick="" ><i class="la la-magic" ></i></a>`;
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });
        });

    </script>
@endpush
