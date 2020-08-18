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
                                <td width="2%">#</td>
                                <th width="15%">Name</th>
                                <th width="15%">Email</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $info)
                                @if($info->id != $leadSuperAdmin)
                                    <tr data-index="{{ $info->id }}" data-position="{{ $info->display_order }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $info->name }}</td>
                                        <td>{{ $info->email }}</td>
                                        <td class="text-center">
                                            <a href="{{ route("lead.send_mail_form") }}" role="button" class="btn-sm btn-info border-0"><i class="la la-shield" aria-hidden="true"></i> Product Permission</a>
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





