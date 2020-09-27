@extends('layouts.admin')
@section('title', 'Corporate Responsibility Sections')
@section('card_name', 'Corporate Responsibility Sections')
@section('breadcrumb')
    <li class="breadcrumb-item active">Sections List</li>
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
                    <h4 class="menu-title pb-1"><strong>Section List</strong></h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th width="20%">Title</th>
                            <th width="30%">Banner Image</th>
{{--                            <th width="20%">URL Slug</th>--}}
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sections as $key=> $section)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $section->title_en }} {!! $section->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td><img src="{{ config('filesystems.file_base_url') . $section->banner_image_url }}" height="100" width="270"></td>
{{--                                <td>{{ $section->url_slug }}</td>--}}
                                <td class="text-center">
                                    <a href="{{ url("corporate-resp-section/$section->id/edit") }}" role="button" class="btn btn-sm btn-outline-info border-0"><i class="la la-edit" aria-hidden="true"></i></a>
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


