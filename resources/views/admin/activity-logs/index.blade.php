@extends('layouts.admin')
@section('title', 'Activity Logs List')
@section('card_name', 'Activity Logs List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="/activity-logs"> Activity Logs List</a></li>
@endsection
@section('action')

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">
                            <div class="card-header">
                                <h4 class="pb-1"><strong>Activity Logs</strong></h4>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{route('activity-logs.search')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="from_date">From Date</label>
                                        <div class='input-group'>
                                            <input type="date" id="from_date" name="from_date" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="to_date">To Date</label>
                                        <div class='input-group'>
                                            <input type="date" id="to_date" name="to_date" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 pt-2" >
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="la la-check-square-o"></i> Search
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-responsive table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th>User Name</th>
                            <th>Action</th>
                            <th>Model</th>
                            <th>Logged At</th>
                            <th>Action</th>
                            {{-- <th width="15%">IP Address</th>
                            <th width="15%">Message</th>
                            <th width="8%">Status</th>
                            <th width="14%">Created At</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($activityLogs as $activityLog)
                                <tr>
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $activityLog->user_name }}</td>
                                    <td>{{ $activityLog->action }}</td>
                                    <td>{{ $activityLog->model }}</td>
                                    <td>{{ $activityLog->logged_at }}</td>
                                    <td width="20%">
                                        <div class="row" style="padding-right: 5px;">
    
                                            <div class="col-md-2 m-1">
                                                <a  role="button"
                                                    data-id=""
                                                    href="{{route('activity-logs.show',$activityLog->id)}}"
                                                    data-placement="right"
                                                    class="showButton btn btn-outline-success btn-sm"
                                                    onclick="">view</a>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td>{{ $accessLog->ip_address }}</td>
                                    <td>{{ $accessLog->event }}</td>
                                    <td>
                                        @if($accessLog->is_success == 1)
                                            <strong><span class="badge badge-success badge-pill">Success</span></strong>
                                        @else
                                            <strong><span class="badge badge-danger badge-pill">Failed</span></strong>
                                        @endif
                                    </td>
                                    <td>{{ $accessLog->created_at }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@stop

@push('page-css')
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')

@endpush





