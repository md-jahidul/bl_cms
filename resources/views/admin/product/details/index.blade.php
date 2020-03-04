@extends('layouts.admin')
@section('title', 'Section List')
@section('card_name', 'Section List')
@section('breadcrumb')
{{--    <li class="breadcrumb-item active"><a href="{{ route('product.list', [$type]) }}"> Product List</a></li>--}}
    <li class="breadcrumb-item active">Section List</li>
@endsection
@section('action')
    <a href="{{ route('section-create', [$productDetailsId]) }}" class="btn btn-success  round btn-glow px-2"><i class="la la-plus"></i>
        Add Section
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Section List</h4>
                    <table class="table table-striped table-bordered" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Title (English)</th>
                            <th>Title (Bangla)</th>
                            <th>Components</th>
                            <th width="12%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productSections as $section)
                            <tr>
                                <td class="pt-2">{{ $loop->iteration }}</td>
                                <td class="pt-2">{{ $section->title_en }}</td>
                                <td class="pt-2">{{ $section->title_bn }}</td>
                                <td class="pt-2">
                                    <a href="{{ route('component-list', [$productDetailsId, $section->id]) }}"
                                       class="btn-sm btn-outline-primary border">Components</a>
                                </td>
                                <td class="action" width="8%">
                                    <a href="{{ route('section-edit', [$productDetailsId, $section->id]) }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ route('section-destroy', [$productDetailsId, $section->id]) }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $section->id }}" title="Delete the user">
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

{{--<style>--}}
{{--    h4.menu-title {--}}
{{--        font-weight: bold;--}}
{{--    }--}}
{{--</style>--}}

