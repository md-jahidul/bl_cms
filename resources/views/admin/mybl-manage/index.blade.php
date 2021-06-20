@extends('layouts.admin')
@section('title', 'Manage Category List')
@section('card_name', 'Manage Category List')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('manage-category') }}">Category List</a></li>
{{--    @if($parent_id != 0)--}}
{{--        <li class="breadcrumb-item active">{{ $parentMenu->title_en }}</li>--}}
{{--    @endif--}}
@endsection
@section('action')
    <a href="{{ route('mybl-manage-items.create', $parentMenu->id) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New Item
    </a>
@endsection
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title mb-2"><strong>{{ $parentMenu->title_en }} Category Item List</strong></h4>
                    @if(count($manageItems) == !0)
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <thead>
                        <tr>
                            <th><i class="icon-cursor-move icons"></i></th>
                            <th>Image</th>
                            <th>Item Name</th>
                            <th>Type</th>
                            <th>CTA Action</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($manageItems as $data)
                                {{--                                {{ dd($data->manageItems->count()) }}--}}
                                {{--                                @php($childNumber = count($data->children))--}}
                                <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                    <td class="pt-1" width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td width="15%">
                                        @if(isset($data->other_info['type']) && $data->other_info['type'] == "video")
                                            <img src="{{ asset("component-images/video-logo-thumbnail.png") }}" alt="Video Icon Image"
                                                 height="100" width="200"/>
                                        @else
                                            @if($parentMenu->type == "slider")
                                                <img src="{{ asset($data->image_url) }}" alt="Slider Image"
                                                     height="100" width="250"/>
                                            @else
                                                <img src="{{ asset($data->image_url) }}" alt="Icon Image"
                                                     height="50" width="50"/>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="pt-1">
                                        {{ $data->title_en  }} {!! $data->status == 0 ? '<span class="text-danger"> ( Inactive )</span> <br>' : '' !!}
                                        {!! $data->show_for_guest == 1 ? '<span class="text-success"> ( Showing For Guest )</span>' : '' !!}
                                    </td>
                                    <td class="pt-1">{{ $data->type  }}</td>
                                    <td class="pt-1">{{ $data->component_identifier  }}</td>
                                    <td class="action" width="12%">
                                        <a href="{{ route('mybl-manage-items.edit', [$parentMenu->id, $data->id]) }}" role="button"
                                           class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ route('mybl-manage-items.destroy', [$parentMenu->id, $data->id]) }}"
                                           class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete the user">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="text-center mt-5">
                            <spen>No data available in table</spen>
                        </div>
                    @endif
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
        var auto_save_url = "{{ url("mybl-manage-items/$parentMenu->id/sort-auto-save") }}";
    </script>
@endpush


