@extends('layouts.admin')
@section('title', 'Quick Launch List')
@section('card_name', 'Quick Launch List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Quick Launch List</strong></li>
@endsection
@section('action')
    <a href="{{ url('quick-launch/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Quick Launch
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th>Slider Name</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Alt Text</th>
                            <th>Button Label</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($slider_images as $index=>$slider_image)
                            <tr>
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $slider_image->slider['title'] }}</td>
                                <td>{{ $slider_image->title }}</td>
                                <td><img class="" src="{{ asset("slider-images/".$slider_image->image_url) }}" alt="Slider Image" height="50" width="50" /></td>
                                <td>{{ $slider_image->description }}</td>
                                <td>{{ $slider_image->alt_text }}</td>
                                <td>{{ $slider_image->url_btn_label }}</td>
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
        var auto_save_url = "{{ url('quick-launch-sortable') }}";
    </script>
@endpush





