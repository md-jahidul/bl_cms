@extends('layouts.admin')
@section('title', 'Corp Resp Contact Us Page')
@section('card_name', 'Corp Resp Contact Us Page')
@section('breadcrumb')
    <li class="breadcrumb-item active">Contact Us Page List</li>
@endsection
@section('action')
    {{-- <a href="{{ url('life-at-banglalink/topbanner/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New Banner
    </a> --}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title pb-1"><strong>Contact Us Page List</strong></h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th width="30%">Page Type</th>
                            <th width="3%"></th>
                            <th width="3%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $key=> $page)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $page->page_type }} {!! $page->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td class="text-center">
                                    <a href="{{ route("contact-us-field.index", $page->id) }}" role="button" class="btn btn-sm btn-blue-grey border-0">Field</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route("contact-us-page-info.edit", $page->id) }}" role="button" class="btn btn-sm btn-outline-info border-0"><i class="la la-edit" aria-hidden="true"></i></a>
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


