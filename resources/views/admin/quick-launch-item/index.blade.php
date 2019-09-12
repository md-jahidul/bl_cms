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
                    <table class="table table-striped table-bordered"
                             style="">
                        <thead>
                        <tr>
{{--                            <th>SL</th>--}}
                            <th width="6%" class="text-center">Image</th>
                            <th>English</th>
                            <th>Bangla</th>
                            <th>Alt Text</th>
                            <th>Link</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach ($quickLaunchItems as $key=>$quickLaunchItem)
                            <tr data-index="{{ $quickLaunchItem->id }}" data-position="{{ $quickLaunchItem->display_order }}">
{{--                                <td>{{ ++$key }}</td>--}}
                                <td width="6%" class="text-center"><img src="{{ $quickLaunchItem->image_url }}" alt="image" height="30" width="30"></td>
                                <td>{{$quickLaunchItem->en_title}}</td>
                                <td>{{$quickLaunchItem->bn_title}}</td>
                                <td>{{$quickLaunchItem->alt_text}}</td>
                                <td>{{$quickLaunchItem->link}}</td>

                                <td class="action" width="8%">
                                    <a href="{{ url("quick-launch/$quickLaunchItem->id/edit") }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("quick-launch/destroy/$quickLaunchItem->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $quickLaunchItem->id }}" title="Delete the user">
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
        var auto_save_url = "{{ url('quick-launch-sortable') }}";
    </script>
@endpush




