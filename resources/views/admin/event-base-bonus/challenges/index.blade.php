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
                                @foreach($challenges as $challenge)
                                <tr>
                                    <td>{{$challenge['title']}}</td>
                                    <td>{{$challenge['btn_text']}}</td>
                                    <td>{{$challenge['reward_product_code_prepaid']}}</td>
                                    <td>{{$challenge['reward_product_code_postpaid']}}</td>
                                    <td>{{$challenge['reward_text']}}</td>
                                    <td>{{$challenge['day']}}</td>
                                    <td>{{$challenge['status']}}</td>
                                    <td>
                                        <a href="{{ url('event-base-bonus/challenge/'.$challenge['id']).'/edit' }}" class="mr-3">
                                            <i class="la la-pencil text-primary"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logoutform-{{$challenge['id']}}').submit();">
                                            <i class="la la-trash text-danger"></i>
                                        </a>
                                        <form id="logoutform-{{$challenge['id']}}" action="{{ url('event-base-bonus/challenge/'.$challenge['id']) }}" method="POST">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                        </form>
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
    $('.challenge-table').DataTable();
</script>
@endpush