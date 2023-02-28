@extends('layouts.admin')
@section('title', 'Item list')
@section('card_name', 'Item list')
@section('breadcrumb')
    <li class="breadcrumb-item active">Item list</li>
@endsection

@php
    if(
        $parent_categories['category'] == 'life_at_bl_events' ||
        $parent_categories['category'] == 'life_at_bl_general' ||
        $parent_categories['category'] == 'programs_photogallery'
    ){
        $sortable = true;
    }
    else{
        $sortable = false;
    }

    if(
        $parent_categories['category'] == 'life_at_bl_teams' ||
        ($parent_categories['category'] == 'programs_progeneral' && $parent_categories['additional_type'] == 'programs_news_section')

    ){
        $single_item = true;
    }
    else{
        $single_item = false;
    }


@endphp

@section('action')
    <a href="{{ url("$route_slug") }}" class="btn btn-info round btn-glow px-2">Go back Section</a>

    @if( !$single_item || count($all_items) == 0 )
        <a href="{{ url("ecarrer-items/$parent_id/create") }}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
            Add New Item
        </a>
    @endif

@endsection



@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title pb-1"><strong>Item List</strong></h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>

                            @if(
                                $parent_categories['category'] == 'life_at_bl_events' ||
                                $parent_categories['category'] == 'life_at_bl_general' ||
                                $parent_categories['category'] == 'programs_photogallery'
                                )
                                <th>Images</th>
                            @endif

                            <th>Title</th>
                            <th width="15%">Status</th>
                            <th width="22%">Action</th>
                        </tr>
                        </thead>
                        <tbody @if($sortable) id="sortable" @endif>
                            {{-- {{ dd($all_items) }} --}}
                        @if( !empty($all_items) )
                        @foreach($all_items as $key=> $items)
                            {{-- @php( $itemsType = str_replace(" ", "-", strtolower( $items->type->name ) )) --}}
                            <tr @if($sortable) data-index="{{ $items->id }}" data-position="{{ $items->display_order }}" @endif>
                                <td>{{ ++$key }}</td>
                                @if(
                                    $parent_categories['category'] == 'life_at_bl_events' ||
                                    $parent_categories['category'] == 'life_at_bl_general' ||
                                    $parent_categories['category'] == 'programs_photogallery'
                                     )
                                    <td width="10%">
                                        @if( !empty($items->image) )
                                            <img class="img-fluid" src="{{ config('filesystems.file_base_url') . $items->image }}" alt="">
                                        @endif
                                    </td>
                                @endif
                                <td>{{ $items->title_en }}</td>
                                <td>{{ ($items->is_active == 1) ? 'Acive' : 'Inactive' }}</td>
                                <td class="text-center" width="22%">
                                    <a href="{{ url("ecarrer-items/$parent_id/$items->id/edit") }}" role="button" class="btn btn-outline-success border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="{{ url("ecarrer-items/$parent_id/destroy/$items->id") }}" role="button" class="btn btn-outline-success border-0" onclick="return confirm('Are you sure?');"><i class="la la-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@stop


@push('page-css')
    @if($sortable)
        <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
        <style>
            #sortable tr td{
                padding-top: 5px !important;
                padding-bottom: 5px !important;
            }
        </style>
    @endif
@endpush



@push('page-js')
    @if( $sortable )
        <script>
            var auto_save_url = "{{ url('ecarrer-items-sortable') }}";
        </script>
    @endif
@endpush


