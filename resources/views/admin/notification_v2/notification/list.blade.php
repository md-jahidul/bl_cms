@extends('layouts.admin')
@section('title', 'Notification V2')
@section('card_name', 'Notification v2')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification Report v2</li>
@endsection

@section('content')

    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">

                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">User</th>
                            <th width="12%">Title</th>
                            <th width="30%">Message</th>
                            <th width="10%">Category</th>
                            <th width="10%">Status</th>
                            {{--<th width="15%">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td width="5%">{{$notification['id']}}</td>
                                <td width="10%">{{$notification['mobile']}}</td>
                                <td width="12%">{{$notification['title']}}</td>
                                <td width="30%">{{$notification['body']}}</td>
                                <td width="10%">{{$notification['category_name']}}</td>
                                <td width="10%">{{$notification['status']}}</td>

                                {{--<td width="15%">
                                    <div class="row">
                                        <div class="col-md-2 m-1">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('notification.edit',$notification->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </section>

@endsection




@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
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
                            url: "{{ url('notification-v2/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('notification-v2') }}"
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
                "bDestroy": true,
                "pageLength": 10
            });
        });

    </script>
@endpush
