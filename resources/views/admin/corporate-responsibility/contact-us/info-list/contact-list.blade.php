@extends('layouts.admin')
@section('title', 'Customer Contact List')
@section('card_name', 'Customer Contact List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Customer Contact List</li>
@endsection
@section('action')

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered zero-configuration" id="feedback_list"> <!--zero-configuration-->
                        <thead>
                        <tr>
                            <td>#</td>
                            <th>Page Name</th>
                            <th>Created At</th>
                            <th width="20%">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($infoList as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ str_replace('_', ' ', ucfirst($data->page_slug)) }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('contact-us.more_details', $data->id) }}" role="button" class="btn-sm btn-cyan"><i class="la la-feed" aria-hidden="true"></i> More Details</a>
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





