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
                                <th width="7%">Category</th>
                                <th width="7%">Product</th>
                                <th width="4%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allRequest as $info)
                                @if($info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $info['lead_cat'] }}</td>
                                        <td>{{ $info['lead_product'] }}</td>
                                        <td class="text-center">
                                            <strong>
                                                @php($status = str_replace('_', ' ', ucwords($info['status'])))
                                                @if($info['status'] == "pending")
                                                    <span class="badge badge-warning badge-pill">{{ $status }}</span>
                                                @elseif($info['status'] == "in_progress")
                                                    <span class="badge badge-primary badge-pill">{{ $status }}</span>
                                                @else
                                                    <span class="badge badge-success badge-pill">{{ $status }}</span>
                                                @endif
                                            </strong>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route("lead.send_mail_form") }}" role="button" class="btn-sm btn-info border-0"><i class="la la-paper-plane" aria-hidden="true"></i> Send</a>
                                            <a href="{{ route('lead.details', $info['id']) }}" role="button" class="btn-sm btn-success border-0"><i class="la la-refresh" aria-hidden="true"></i> Details</a>
                                        </td>
                                    </tr>
                                @endif
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





