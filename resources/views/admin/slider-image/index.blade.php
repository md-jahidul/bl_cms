@extends('layouts.admin')
@section('title', 'Slider Image List')
@section('card_name', 'Slider Image List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Slider Image List</strong></li>
@endsection
@section('action')
    <a href="{{ url("slider/$sliderId/$type/image/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Slider Image
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ ucwords($sliderTitle." ". "slider images") }}</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th>Image</th>
                            <th width="25%">Title</th>
{{--                            <th>Description</th>--}}
                            <th>Alt Text</th>
{{--                            <th>Button Label</th>--}}
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($slider_images as $index=>$slider_image)
                            <tr data-index="{{ $slider_image->id }}" data-position="{{ $slider_image->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td><img class="" src="{{ $slider_image->image_url }}" alt="Slider Image" height="50" width="50" /></td>
                                <td>{{ $slider_image->title_en }} {!! $slider_image->is_active == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
{{--                                <td>{{ $slider_image->description }}</td>--}}
                                <td>{{ $slider_image->alt_text }}</td>
{{--                                <td>{{ $slider_image->url_btn_label }}</td>--}}
                                <td class="action" width="8%">
                                    <a href="{{ route('slider_image_edit', [ $slider_image->slider_id, $type, $slider_image->id ] ) }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("slider/$slider_image->slider_id/$type/image/destroy/$slider_image->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $slider_image->id }}" title="Delete the user">
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
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf', "charset": "utf-8",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>

    <script>
        var auto_save_url = "{{ url('slider-image-sortable') }}";
    </script>
@endpush





