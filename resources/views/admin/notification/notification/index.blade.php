@extends('layouts.admin')
@section('title', 'Notification')
@section('card_name', 'Notification')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification List</li>
@endsection

@section('action')
    @if($category->count()==0)
        <a href="{{route('notificationCategory.index')}}" class="btn btn-danger round btn-glow px-2"><i class="la la-plus"></i>
            There is no category
        </a>
    @else
        <a href="{{route('notification.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
            Create Notification
        </a>
    @endif

@endsection

@section('content')

    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <li><small style="color: red">N.B. : Sorted according to recently base upload</small></li>
                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered dataTable" id="Example1">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="12%">Title</th>
                            <th width="25%">Body</th>
                            <th width="10%">Category</th>
                            <th>Schedule</th>
                            <th>Start Date</th>
                            <th>Expire Date</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($notifications as $notification)
                            @php
                                $schedule = $notification->schedule;
                            @endphp
                            <tr>
                                <td width="5%">{{$notification->id}}</td>
                                <td width="12%">{{$notification->title}}</td>
                                <td width="30%">{{$notification->body}}</td>
                                <td width="10%">{{$notification->NotificationCategory->name}}</td>
                                <td>{{ $schedule ? ucwords($schedule->status) : 'None' }}</td>
                                <td>{{ $schedule->start ?? ''}}</td>
                                <td>{{ $schedule->end ?? ''}}</td>
                                <td width="20%">
                                    <div class="row" style="padding-right: 5px;">

                                        <div class="col-md-2 m-1">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('notification.edit',$notification->id)}}" class="btn-pancil btn btn-outline-success btn-sm" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        {{-- <div class="col-md-2 m-1">
                                             <button data-id="{{$notification->id}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
                                         </div>--}}

                                        <div class="col-md-2 m-1">
                                            <a  role="button"
                                                data-id=""
                                                href="{{route('notification.show',$notification->id)}}"
                                                data-placement="right"
                                                class="showButton btn btn-outline-info btn-sm"
                                                onclick=""><i class="la la-paper-plane"></i></a>
                                        </div>

                                        <div class="col-md-2 m-1">
                                            <a  role="button"
                                                data-id=""
                                                href="{{route('notification.show-all',$notification->id)}}"
                                                data-placement="right"
                                                class="showButton btn btn-outline-info btn-sm"
                                                onclick=""><i class="la la-adn"></i></a>
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
        <div id="sendUser" class="modal fade bd-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-2">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="">

                                <div class="form-body">
                                    <button type="button" class="close mt-1" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="form-section">
                                        <i class="la la-key"></i>
                                        Send Notification
                                    </h4>

                                    <div class="row">
                                        <div class="col-6">
                                            <h4>
                                                Notification title :<span id="title"></span>
                                            </h4>
                                        </div>
                                        <div class="col-6">
                                            <h4>
                                                Notification Category :<span id="category"></span>
                                            </h4>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4>
                                                        Notification Discription :
                                                    </h4>
                                                </div>
                                                <div class="col-12">
                                                    <span id="discription"></span>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-12" >
                                            <div class="form-group float-right" style="margin-top:26px;">
                                                <button class="btn btn-primary" style="width:100%;padding:7.5px 12px" type="submit">Submit</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
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
                            url: "{{ url('notification/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('notification') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
        // $(".showButton").click(function(){
        //     $('#sendUser').modal()
        //     $('#title').html($(this).attr('data-original-title'))
        //     $('#category').html($(this).attr('data-original-category'))
        //     $('#discription').html($(this).attr('data-original-discription'))
        // })
        $(document).ready(function () {
            $('#Example1').DataTable({
                //dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10,
                "order": [],
            });
        });
    </script>
@endpush