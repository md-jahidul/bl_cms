@extends('layouts.admin')
@section('title', 'Challenge List')
@section('card_name', 'Challenge List')
@section('breadcrumb')
<li class="breadcrumb-item active">Challenge List</li>
@endsection
@section('action')
<a href="{{ url('event-base-bonus/challenges/create') }}" class="btn btn-outline-primary  round btn-glow px-2"><i class="la la-user-plus"></i>
    Add Challenge
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
                        <table class="table table-striped table-bordered challenge-table">
                            <thead>
                                <tr>
                                    <th>Title En</th>
                                    <th>Btn Text En</th>
                                    <th>Reward Prepaid</th>
                                    <th>Reward Postpaid</th>
                                    <th>Reward Text</th>
                                    <th>Day</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
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
    $('.challenge-table').DataTable();
</script>
@endpush