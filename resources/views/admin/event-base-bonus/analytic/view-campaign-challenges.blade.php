@extends('layouts.admin')
@section('title', 'Campaign Challenge Analytics Detail')
@section('card_name', 'Campaign Challenge Analytics Detail')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('event-base-bonus/v2/analytics') }}">Analytics</a></li>
<li class="breadcrumb-item active">Campaign Challenge</li>
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
                                    <th>Challenge Title</th>
                                    <th>Total Completed</th>
                                    <th>Total Claimed</th>
                                    <th>Total Streak Missed</th>
                                    <th>Total Users</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($challengeAnalytics as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item['title']}}</td>
                                    <td>
                                        @if($item['total_completed'])
                                        <a href="">{{$item['total_completed']}}</a>
                                        @else
                                        {{$item['total_completed']}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($item['total_claimed'])
                                        <a href="">{{$item['total_claimed']}}</a>
                                        @else
                                        {{$item['total_claimed']}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($item['total_streak_missed'])
                                        <a href="">{{$item['total_streak_missed']}}</a>
                                        @else
                                        {{$item['total_streak_missed']}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($item['total_users'])
                                        <a href="">{{$item['total_users']}}</a>
                                        @else
                                        {{$item['total_users']}}
                                        @endif
                                    </td>
                                    <td><a href="{{ url('event-base-bonus/v2/analytics') }}/{{$item['user_campaign']['id']}}/{{$item['id']}}" target="_blank"><button class="btn btn-success btn-sm">View Tasks</span></button></a></td>
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