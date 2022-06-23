@extends('layouts.admin')
@section('title', 'Create Health Hub Partner')
@section('card_name', 'Create Health Hub Partner')

@section('action')
    <a href="{{route('health-hub-feature-partner.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
        Create Health Hub Partner
    </a>
@endsection

@section('content')

    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-header">
                </div>
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered dataTable" id="Example1">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Partner Name En</th>
                            <th>Partner Name Bn</th>
                            <th>Partner ID</th>
                            <th>Access Key</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($partners as $key => $partner)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $partner->name_en }}</td>
                                <td>{{ $partner->name_bn }}</td>
                                <td>{{ $partner->partner_id }}</td>
                                <td>{{ $partner->access_key }}</td>
                                <td>{{ $partner->status ? 'Active':'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('health-hub-feature-partner.edit', $partner->id) }}" role="button"
                                        class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                     <a href="#"
                                        class="border-0 btn btn-outline-danger delete delete_btn" data-id="{{ $partner->id }}" title="Delete the user">
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
                            url: "{{ url('health-hub-feature-partner/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('health-hub-feature-partner') }}"
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
