@extends('layouts.admin')

@section('title', "Dynamic Pages")
@section('card_name', "Dynamic Deeplink")
@section('breadcrumb')
    <li class="breadcrumb-item active">Dynamic Link List</li>
@endsection
@section('action')
{{--    <a href="{{ url('dynamic-pages/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Page--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th width="8%">Reference Name</th>
                            <th width="12%">Link</th>
                            <th width="3%">Clicked On Android</th>
                            <th width="3%">Clicked On IOS</th>
                            <th width="14%">Created At</th>
                        </tr>
                        </thead>
                        <tbody class="service_sortable cursor-move">
                        @foreach($analytics as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->reference_name }}</td>
                                <td>{{ $data->link }}</td>
                                <td>{{ $data->clicked_android }}</td>
                                <td>{{ $data->clicked_ios }}</td>
                                <td>{{ $data->created_at }}</td>
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






