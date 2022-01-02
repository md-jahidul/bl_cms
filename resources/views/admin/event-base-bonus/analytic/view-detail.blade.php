@extends('layouts.admin')
@section('title', 'Analytics Detail')
@section('card_name', 'Analytics Detail')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('event-base-bonus/analytics') }}">Analytics</a></li>
    <li class="breadcrumb-item active">Analytic Details By User</li>
@endsection
@section('content')
    <section class="mt-2">
        <div class="">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered text-center" id="task_analytic_details">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Msisdn</th>
                                    <th>No of Execution</th>
                                    <th>Status</th>
                                    <th>Started at</th>
                                    <th>Completed at</th>
                                    <th>Claimed at</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($taskAnalyticUserDetails as $key=>$taskAnalyticUserDetail)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$taskAnalyticUserDetail['msisdn']}}</td>
                                        <td>{{$taskAnalyticUserDetail['no_of_execution']}}</td>
                                        <td>{{$taskAnalyticUserDetail['status']}}</td>
                                        <td>{{$taskAnalyticUserDetail['started_at']}}</td>
                                        <td>{{$taskAnalyticUserDetail['completed_at']}}</td>
                                        <td>{{$taskAnalyticUserDetail['claimed_at']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#task_analytic_details').DataTable();
        });
    </script>
@endpush