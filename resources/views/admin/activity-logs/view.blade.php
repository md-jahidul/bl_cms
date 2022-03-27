@extends('layouts.admin')
@section('title', 'Activity Log Detalis')
@section('card_name', 'Activity Log Detalis')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href=""> Activity Log Detalis</a></li>
@endsection
@section('action')

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table">
                        <tr>
                            <th>User ID</th>
                            <td>{{ $activityLog->user_id }}</td>
                        </tr>
                        <tr>
                            <th>Action</th>
                            <td>{{ $activityLog->action }}</td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td>{{ $activityLog->model }}</td>
                        </tr>
                        <tr>
                            <th>LoggedAt</th>
                            <td>{{ $activityLog->logged_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Activity</strong></h4>
                    
                        @if ($flag)
                            <table class="table">
                                <h4><strong> After</strong></h4>
                                @foreach($data['after'] as $k=>$d)
                                    <tr>
                                        <th>{{ $k }}</th>
                                        <td>{{ $d }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <table class="table">
                            <h4><strong> Before</strong></h4>
                                @foreach($data['before'] as $k=>$d)
                                    <tr>
                                        <th>{{ $k }}</th>
                                        <td>{{ $d }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <table class="table">
                                @foreach($data as $k=>$d)
                                    <tr>
                                        <th>{{ $k }}</th>
                                        <td>{{ $d }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
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





