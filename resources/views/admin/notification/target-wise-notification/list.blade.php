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
                <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
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
                        @php
                         $id=1;
                        @endphp
                        @foreach ($notifications as $notification)
                        @php

                            $send = (array) $notification->getNotification;
                        @endphp
                            <tr>
                                <td width="5%">{{$id++}}</td>
                                <td width="12%">{{$notification->title}}</td>
                                <td width="30%">{{$notification->body}}</td>
                                <td width="10%"><i class="la la-android" style="color: blue !important"></i> &nbsp;{{$notification->device_type}}</td>
                                <td>{{!empty($notification->starts_at)?date('d-M-Y h:i a', strtotime($notification->starts_at)):''}}</td>
                                <td style="text-align: center">{{$notification->getNotification->count()}}&nbsp;>&nbsp;{{$notification->getNotificationSuccessfullySend->count()}}</td>
                                <td width="10%">
                                    <div class="row" style="padding-right: 5px;">
                                        <div class="col-md-2 m-1">
                                            <a  role="button"
                                                data-id=""
                                                href="{{route('target-wise-notification-report.report-details',$notification->title)}}"
                                                data-placement="right"
                                                class="showButton btn btn-outline-info btn-sm"
                                                onclick="" ><i class="la la-magic" ></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php
                            $send = array();
                        @endphp
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
                // dom: 'Bfrtip',
                // buttons: [],
                // paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10,
                // "order": [[ ]]
            });
        });

    </script>
@endpush
