@extends('layouts.admin')
@section('title', 'Initiative Tab Component List')
@section('card_name', 'Initiative Tab Component List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('initiative-tab.index', $tab->section_id) }}">Initiative Tab List</a></li>
    <li class="breadcrumb-item ">Component List</li>
@endsection
@section('action')

<a href="{{ route("initiative_component.create", [$tab->id]) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>Add Component</a>

@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ $tab->title_en }} Components List</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <th width="5%">Component Type</th>
                                <th width="8%">Component Title</th>
                                <th width="12%" class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($components as $list)
                                <tr data-index="{{ $list->id }}" data-position="{{ $list->component_order }}">
                                    <td><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ ucwords(str_replace('_', ' ', $list->component_type)) }} {!! $list->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                    <td>{{ $list->component_title_en  }}</td>
                                    <td class="text-right">
                                        <a href="{{ route("initiative_component.edit", [$tab->id, $list->id]) }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ route('initiative_component.destroy', [$tab->id, $list->id]) }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $list->id }}" title="Delete">
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
@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript">
        var auto_save_url = "{{ url('corporate/cr-strategy-details-sort') }}";
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
            });
        });
    </script>
@endpush





