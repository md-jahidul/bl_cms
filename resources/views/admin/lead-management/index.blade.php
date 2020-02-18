@extends('layouts.admin')
@section('title', 'Lead Request List')
@section('card_name', 'Lead Request List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Lead Request List</li>
@endsection
@section('action')

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong></strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <td width="3%">#</td>
                                <th width="15%">Name</th>
                                <th width="12%">Company Name</th>
                                <th width="7%">Mobile</th>
                                <th width="7%">Email</th>
                                <th width="7%">District</th>
                                <th width="7%">Thana</th>
                                <th width="20%">Address</th>
                                <th width="4%">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allRequest as $info)
                                <tr data-index="{{ $info->id }}" data-position="{{ $info->display_order }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $info->name }}</td>
                                    <td>{{ $info->company_name }}</td>
                                    <td>{{ $info->mobile }}</td>
                                    <td>{{ $info->email }}</td>
                                    <td>{{ $info->district }}</td>
                                    <td>{{ $info->thana }}</td>
                                    <td>{{ $info->address }}</td>
                                    <td>{{ $info->quantity }}</td>
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

@endpush

@push('page-js')

@endpush





