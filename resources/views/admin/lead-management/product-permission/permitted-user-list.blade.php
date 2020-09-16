@extends('layouts.admin')
@section('title', 'Lead Permitted User List')
@section('card_name', 'Lead Permitted User List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Lead Permitted User List</li>
@endsection
@section('action')
    <a href="{{ url("lead-product-permission-form") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
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
                                <th width="15%">Lead Category</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permittedUsers as $info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $info['user_name'] }}</td>
                                    <td>{{ $info['user_email'] }}</td>
                                    <td>
                                        @foreach($info['lead_categories'] as $cat)
                                            <strong><span class="badge badge-secondary badge-pill">{{ $cat->title }}</span></strong>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('permission.edit', $info['user_id']) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("lead-product-permission/destroy/" . $info['user_id']) }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $info['user_id'] }}" title="Delete">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
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





