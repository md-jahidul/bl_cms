@extends('layouts.admin')
@section('title', 'Management List')
@section('card_name', 'Management List')
@section('breadcrumb')
@endsection
@section('action')
    <a href="{{ url('management/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
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
                            <th width="3%" class="text-center">Image</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach ($management as $key=>$manage)
                            <tr data-index="{{ $manage->id }}" data-position="{{ $manage->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td width="6%" class="text-center"><img src="{{ config('filesystems.file_base_url') . $manage->image_url }}" alt="image" height="30" width="30"></td>
                                <td width="20%">{{$manage->title_en}} {!! $manage->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td>{{$manage->link}}</td>
                                <td class="action" width="8%">
                                    <a href="{{ url("management/$manage->id/edit") }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("management/destroy/$manage->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $manage->id }}" title="Delete the user">
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
            padding-top: 0 !important;
            padding-bottom: 0 !important;
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
        var auto_save_url = "{{ url('management-sortable') }}";
    </script>
@endpush




