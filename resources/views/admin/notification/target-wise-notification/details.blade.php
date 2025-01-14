@extends('layouts.admin')
@section('title', 'Notification')
@section('card_name', 'Notification')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification Report Details</li>
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
                        <div class="col-md-10">
                        <b>Notification Titel : @if(isset($notifications[0])) {{$notifications[0]['title']}} @endif</b>
                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">User</th>
                            <th width="12%">Title</th>
                            <th width="30%">Message</th>
                            <th width="10%">Date</th>
                            <th width="10%">Status</th>
                            {{--<th width="15%">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            @php($i = 0)
                        @foreach ($notifications as $notification)
                        @php($i++)
                            <tr>
                                <td width="5%">{{ $i }}</td>
                                <td width="10%">{{$notification['mobile']}}</td>
                                <td width="12%">{{$notification['title']}}</td>
                                <td width="30%">{{$notification['body']}}</td>
                                <td width="10%">{{!empty($notification['created_at'])?date('d-M-Y h:i a', strtotime($notification['created_at'])):''}}</td>
                                <td width="10%">{{$notification['status']}}</td>
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
                // dom: 'Bfrtip',
                // buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10
            });
        });

    </script>
@endpush
