@extends('layouts.admin')
@section('title', 'Campaign List')
@section('card_name', 'Campaign List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Campaign List</li>
@endsection
@section('action')
    <a href="{{ url('event-base-bonus/campaigns/create') }}" class="btn btn-outline-primary  round btn-glow px-2"><i class="la la-user-plus"></i>
        Add Campaign
    </a>
@endsection
@section('content')

    <section id="configuration">
        <div class="">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered task-tabel">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Reward Prepaid</th>
                                    <th>Reward Postpaid</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($campaigns as $campaign)

                                    <tr>
                                        <td>{{ $campaign['title'] }}</td>
                                        <td>{{ $campaign['start_date'] }}</td>
                                        <td>{{ $campaign['end_date'] }}</td>
                                        <td>{{ $campaign['reward_product_code_prepaid'] }}</td>
                                        <td>{{ $campaign['reward_product_code_postpaid'] }}</td>
                                        <td>{{ $campaign['status'] ? 'active':'inactive'}}</td>
                                        <td>
                                            <a href="{{ url('event-base-bonus/campaigns/'.$campaign['id']).'/edit' }}"  class="mr-3">
                                                <i class="la la-pencil text-primary"></i>
                                            </a>
                                        </td>
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

@push('page-js')
    <script>
        $('.task-tabel').DataTable();
    </script>
@endpush
