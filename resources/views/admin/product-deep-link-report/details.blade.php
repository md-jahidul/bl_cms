@extends('layouts.admin')
@section('title', 'Deeplink Product Purchase Details')
@section('card_name', 'Deeplink Product Purchase Details')
@section('breadcrumb')
    <li class="breadcrumb-item active">Deeplink Product Purchase Details</li>
@endsection
@section('action')
    <a href="{{ route('products-deep-link-report') }}" class="btn btn-primary round btn-glow px-2"><i
            class="la la-list"></i>
        Report List
    </a>
@endsection
@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-header">

                </div>
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered dataTable" id="Example1" role="grid"
                           aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Msisdn</th>
                            <th width="12%">Action Type</th>
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
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
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
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            let productCodeId = "{{$productDeeplinkDbId}}?from={{$from}}&to={{$to}}";
            $("#Example1").dataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                ordering: false,
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4]
                        }
                    }
                ],
                ajax: {
                    url: '{{ route('deeplink-product-purchase-details') }}/' + productCodeId,
                    type: 'GET',
                    data: function (d) {
                        d.option_name = $("#option").val();
                        d.product_code_id = productCodeId;
                        d.search_name = d.search.value;
                        return d;

                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'msisdn', name: 'msisdn'},
                    {data: 'action_type', name: 'action_type'},
                    {data: 'action_url', name: 'action_url'},
                    // {data: 'created_at', name: 'created_at'},
                    {
                        data: 'created_at', name: 'created_at',
                        orderable: true,
                        searchable: true
                    },
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4]
                        }
                    }
                ]
            });
            $(document).on('change', '#option', function (e) {
                $('#Example1').DataTable().ajax.reload();
            });
        });

    </script>
@endpush
