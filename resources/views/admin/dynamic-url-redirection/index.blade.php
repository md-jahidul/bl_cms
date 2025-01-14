@extends('layouts.admin')
@section('title', 'Dynamic URL Redirection List')
@section('card_name', 'Dynamic URL Redirection List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('tag-category') }}"> Dynamic URL Redirection List</a></li>
@endsection
@section('action')
    <a href="{{ route('dynamic-url-redirection.create') }}" class="btn btn-primary round btn-glow px-2">
        <i class="la la-plus"></i>
        Create New Redirection
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Tag Categories</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th>Title</th>
                            <th>From URL</th>
                            <th>To URL</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($redirections as $redirection)
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $redirection->title }}</td>
                                <td>{{ $redirection->from_url }}</td>
                                <td>{{ $redirection->to_url }}</td>
                                <td>{{ $redirection->status ? 'Active' : 'Inactive' }}</td>
                                <td width="12%" class="text-center">
                                    <a href="{{ route('dynamic-url-redirection.edit', $redirection->id) }}"
                                       role="button"
                                       class="btn btn-sm btn-info">
                                        <i class="la la-pencil"></i>
                                    </a>

                                    <a href="{{ route('dynamic-url-redirection.toggle-status', [$redirection->id, $redirection->status ? 0 : 1]) }}"
                                       class="btn btn-sm {{$redirection->status ? 'btn-danger' : 'btn-success' }}"
                                       onclick="return confirm('Are you sure to change the status? ')">
                                        @if($redirection->status)
                                            <i class="la la-times" title="Deactivate"></i>
                                        @else
                                            <i class="la la-check" title="Activate"></i>
                                        @endif
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
    {{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
    <style>
        #sortable tr td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')

@endpush





