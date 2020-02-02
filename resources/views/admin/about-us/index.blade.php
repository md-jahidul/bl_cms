@extends('layouts.admin')
@section('title', 'About US List')
@section('card_name', 'About US List')
@section('breadcrumb')
@endsection
@section('action')
    <a href="{{ url('about-us/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add About US
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='5%'>Serial</th>
                            <th width='10%'>Platform</th>
                            <th width='10%'>Version</th>
                            <th width='10%'>Force Update</th>
                            <th width='30%'>Message</th>
                            <th width='20%'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width='5%'>{{$index}}</td>
                                <td width='10%'>{{$version->platform}}</td>
                                <td width='10%'>{{$version->current_version}}</td>
                                <td width='10%'>{{$force_update}}</td>
                                <td width='30%'>{{$version->message}}</td>
                                <td width='20%'>
                                    <div class="row justify-content-md-center no-gutters">
                                        <div class="col-md-3">
                                            <a role="button" href="{{route('about-us.edit',$version->id)}}" class="btn btn-outline-success">
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <button data-id="{{$version->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
                                        </div>
                                    </div>
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
        var auto_save_url = "{{ url('about-us-sortable') }}";
    </script>
@endpush




