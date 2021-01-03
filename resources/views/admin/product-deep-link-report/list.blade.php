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
                <div class="row">
                    <div class="col-md-7">

                    </div>
                    <div class="col-md-5 " style="float: left">
                    <table border="0" cellspacing="5" cellpadding="5" width="300px" style="float: right">
                        <tr>
                            <td>Date Range:</td>
                            <td><input type="text" id="date_range" name="date_range"></td>
                        </tr>
                        </table>
                    </div>
                </div>
                <table class="table table-striped table-bordered  dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th width="5%">Sl</th>
                        <th width="10%">Product Code</th>
                        <th width="8%">Total</th>
                        <th width="8%">Buy</th>
                        <th width="8%">Buy Failure</th>
                        <th width="8%">Cancel</th>
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
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
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
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('input[name="date_range"]').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD'
                },
            });

            $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + '=' + picker.endDate.format('YYYY-MM-DD'));
                $('#Example1').DataTable().ajax.reload();
            });

            $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $('#Example1').DataTable({
                processing: true,
                serverSide: false,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                pageLength: 10,
                ajax:{
                    'url':"{{ route('product-deeplink-list') }}",
                    'data': function(data){
                        let fullDate = $('#date_range').val();
                        let date = fullDate.split("=");
                        // Read values
                        var from_date = date[0];
                        var to_date = date[1];
                        // Append to data
                        data.searchByFromdate = from_date;
                        data.searchByTodate = to_date;
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'product_code', name: 'product_code'},
                    {data: 'total_view', name: 'total_view'},
                    {data: 'total_buy', name: 'total_buy'},
                    {data: 'total_cancel', name: 'total_cancel'},
                    {data: 'buy_attempt', name: 'buy_attempt'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                dom: 'Blfrtip',
                buttons:  [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6 ]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 1,2,3,4,5,6 ]
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    console.log(row, data, index);
                        $('td', row).eq(0).html(index + 1);
                    }
            });

        });

    </script>
@endpush
