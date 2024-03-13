@extends('layouts.admin')
@section('title', 'Component List')
@section('card_name', 'Component List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('pages') }}">Page List</a></li>
    <li class="breadcrumb-item ">Component List</li>
@endsection
@section('action')

<a href="{{ route("page-components-create", $pageId) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>Add Component</a>

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Components List</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="5%">Component Type</th>
                            <th width="8%">Title</th>
                            <th width="12%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($components as $item)
                            @php
                                $componentType = "";
                                if (isset($item->type)){
                                    $componentType = $item->type;
                                } else {
                                    $componentType = $item->component_type;
                                }
                            @endphp
                            <tr data-index="{{ $item->id }}" data-position="{{ $item->component_order }}">
                                <td><i class="icon-cursor-move icons"></i></td>
                                <td>{{ ucwords(str_replace('_', ' ', $componentType)) }} {!! $item->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td>{{ $item->attribute['title']['en'] ?? null }}</td>
                                <td class="text-right">
                                    <a href="{{ url("page-components/$pageId/edit/$item->id") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("page-components/$pageId/destroy") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $item->id }}" title="Delete">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        var auto_save_url = "{{ url('page-components-save-sorted') . "/" . $pageId }}";
        $(function () {

            //show dropify for  photo
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for File/Photo',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        });
    </script>
@endpush





