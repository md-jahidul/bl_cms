@extends('layouts.admin')
@section('title', 'Access Logs List')
@section('card_name', 'Access Logs List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href=""> Access Logs List</a></li>
@endsection
@section('action')

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Access Logs</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="20%">Email</th>
                            <th width="15%">IP Address</th>
                            <th width="15%">Message</th>
                            <th width="8%">Status</th>
                            <th width="10%">Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($accessLogs as $accessLog)
                                <tr>
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td>{{ $accessLog->user_email }}</td>
                                    <td>{{ $accessLog->ip_address }}</td>
                                    <td>{{ $accessLog->event }}</td>
                                    <td>
                                        @if($accessLog->is_success == 1)
                                            <strong><span class="badge badge-success badge-pill">Success</span></strong>
                                        @else
                                            <strong><span class="badge badge-danger badge-pill">Failed</span></strong>
                                        @endif
                                    </td>
                                    <td>{{ $accessLog->created_at }}</td>
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





