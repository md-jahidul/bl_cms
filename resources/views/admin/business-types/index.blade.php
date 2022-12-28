@extends('layouts.admin')
@section('title', 'Business Types')
@section('card_name', 'Business')
@section('breadcrumb')
    <li class="breadcrumb-item active">Business Types List</li>
@endsection
@section('action')
    <a href="{{ url('business-types/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Business types
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title pb-1"><strong>Business Types List</strong></h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="10%">Title EN</th>
                            <th width="10%">Title BN</th>
                            <th width="8%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($businessTypes as $key=>$data)
                            <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $data->title_en }}</td>
                                <td>{{ $data->title_bn }}</td>
                                <td class="text-right">
                                    <a href="{{ url("business-types-items/$data->id/") }}" class="btn-sm btn-outline-success border-1">Child Items</a>
                                    <a href="{{ url("business-types/$data->id/edit") }}" role="button" class="btn-sm btn-outline-success border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("business-types/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete the user">
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
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script type="text/javascript">
        var auto_save_url = "{{ url('business-types-sort') }}";
    </script>
@endpush
