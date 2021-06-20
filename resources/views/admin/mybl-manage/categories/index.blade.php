@extends('layouts.admin')
@section('title', 'Manage Category List')
@section('card_name', 'Manage Category List')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('mybl-manage') }}">Category List</a></li>
{{--    @if($parent_id != 0)--}}
{{--        <li class="breadcrumb-item active">{{ $parentMenu->title_en }}</li>--}}
{{--    @endif--}}
@endsection
@section('action')
    <a href="{{ route('manage-category.create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New Category
    </a>
@endsection
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Category List</h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <thead>
                            <tr>
                                <th><i class="icon-cursor-move icons"></i></th>
                                <th>Name</th>
                                <th>Type</th>
                                <th></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                        @if(count($manageCategories) == !0)
                            @foreach($manageCategories as $data)
{{--                                {{ dd($data->manageItems->count()) }}--}}
{{--                                @php($childNumber = count($data->children))--}}
                                <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                    <td class="pt-1" width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td class="pt-1">{{ $data->title_en  }} {!! $data->status == 0 ? '<span class="text-danger"> ( Inactive )</span>' : '' !!}</td>
                                    <td class="pt-1">{{ $data->type  }}</td>
                                    <td class="text-center" width="10%">
                                        <a href="{{ url("mybl-manage-items/$data->id") }}" class="btn btn-outline-dark">Item List
                                            <span class="ml-1 badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{ $data->manageItems->count() }}</span></a>
                                    </td>
                                    <td class="action" width="12%">
                                        <a href="{{ route('manage-category.edit', $data->id) }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ route('manage-category.destroy', $data->id) }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete the user">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <div class="text-center mt-5">
                                <spen>No data available in table</spen>
                            </div>
                        @endif


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
{{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('manage-category/sort-auto-save') }}";
    </script>
@endpush


