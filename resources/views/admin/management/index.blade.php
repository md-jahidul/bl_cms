@extends('layouts.admin')
@section('title', 'Management List')
@section('card_name', 'Management List')
@section('breadcrumb')
@endsection
@section('action')
    <a href="{{ url('management/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Management
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='3%'><i class="icon-cursor-move icons"></i></th>
                            <th width='15%'>Name</th>
                            <th width='15%'>Designation</th>
                           {{-- <th width='20%'>Personal Details</th>--}}
                            <th width='20%'>Profile Image</th>
                            <th width='20%'>Modal Image</th>
                            <th width='5%'>Status</th>
                            <th width='10%'>Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @php $index = 0; @endphp
                        @foreach ($management as $manage)
                            @php  if($manage->is_active == 1) {
                                    $status = "Active";
                                   } else{
                                      $status = "Inactive";
                                   }
                            @endphp

                        <tr>
                            <tr data-index="{{ $manage->id }}" data-position="{{ $manage->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <td width='15%'>{{$manage->name}}</td>
                            <td width='15%'>{{$manage->designation}}</td>
                            {{--<td width='20%'>{{strip_tags($manage->personal_details)}}</td>--}}
                            <td width='20%'>
                                <img style="height:120px;width:180px; padding: 5px;"
                                     src="{{ config('filesystems.file_base_url') . $manage->profile_image }}" id="profile_image_Display">
                            </td>
                            <td width='20%'>
                                <img style="height:120px;width:200px; padding: 5px;"
                                     src="{{ config('filesystems.file_base_url') . $manage->banner_image }}" id="imgDisplay">
                            </td>
                            <td width='5%'>{{$status}}</td>
                            <td width='15%'>
                                <div class="row justify-content-md-center no-gutters">
                                    <div class="col-md-3">
                                        <a role="button" href="{{route('management.edit',$manage->id)}}" class="btn btn-outline-success">
                                            <i class="la la-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <button data-id="{{$manage->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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

        table.dataTable {
            border-spacing: 1px;
        }
    </style>
@endpush

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style></style>
@endpush

@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>

    <script>
        var auto_save_url = "{{ url('management-sortable') }}";
    </script>

    <script>
        $(function () {
            $('.delete').click(function () {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('management/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('management/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "pageLength": 10,
                "bDestroy": true,
            });
        });

    </script>
@endpush



