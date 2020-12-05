@extends('layouts.admin')
@section('title', 'Notification Report')
@section('card_name', 'Notification Report')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification List</li>
@endsection
@section('content')
<section>
    <div class="card card-info mt-0" style="box-shadow: 0px 0px">
        <div class="card-content">
            <div class="card-body card-dashboard">
                {{-- alt-pagination no-footer dataTable --}}
                <table class="table table-striped table-bordered" id="Example11" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="12%">Title</th>
                        <th width="25%">Body</th>
                        <th width="10%">Platform</th>
                        <th>Start / Send</th>
                        <th>Sends <br> <Small>Total > Send</Small></th>
                        <th width="10%">Action</th>
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
            $("#Example11").dataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: {
                    url: '{{ route('target-wise-notification-report.report') }}',
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
                        name: 'titel',
                        render: function (data, type, row) {
                            return row.titel;
                        }
                    },
                    {
                        name: 'body',
                        render: function (data, type, row) {
                            return row.body;
                        }
                    },
                    {
                        name: 'device_type',
                        render: function (data, type, row) {
                            return `<i class="la la-android" style="color: blue !important"></i> &nbsp;`+ row.device_type;
                            // return row.device_type;
                        }
                    },
                    {
                        name: 'starts_at',
                        render: function (data, type, row) {
                            return row.starts_at;
                        }
                    },{
                        name: 'sends',
                        render: function (data, type, row) {
                            return row.sends;
                        }
                    },
                    {
                        name: 'action',
                        render: function (data, type, row) {
                            return row.body;
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
