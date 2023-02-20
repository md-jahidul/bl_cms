@extends('layouts.admin')
@section('title', 'Notification V2 Report')
@section('card_name', 'Notification V2 Report')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification V2 Report</li>
@endsection

@section('content')

    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">

                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="12%">Title</th>
                            <th width="25%">Body</th>
                            <th width="10%">All</th>
                            <th>Start Send</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($allNotifications as $notification)
                            <tr>
                                <td width="5%">{{ $notification['id'] }}</td>
                                <td width="12%">{{ $notification['title'] }}</td>
                                <td width="30%">{{ $notification['body'] }}</td>
                                <td width="10%">{{ $notification['all'] ? 'True' : 'False' }}</td>
                                <td width="10%">{{ $notification['create_at'] }}</td>
                                <td width="20%">
                                    <a href="{{url('target-wise-notification-report-details-v2')}}/{{ $notification['id'] }}" role="button" class="showButton btn btn-outline-info btn-sm"><i class="la la-magic" ></i></a>
                                </td>
                            </tr>
                        @endforeach
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
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10,
                "order": [[ 0, "desc" ]]
            });
        });

    </script>
@endpush


