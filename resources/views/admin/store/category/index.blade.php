@extends('layouts.admin')
@section('title', 'Store Category')
@section('card_name', 'Store Category')
@section('breadcrumb')
    <li class="breadcrumb-item active">Store Category List</li>
@endsection

@section('action')
    <a href="{{route('storeCategory.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Store Category
    </a>
@endsection

@section('content')
<section>
    <div class="card card-info mt-0" style="box-shadow: 0px 0px">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <table class="table table-striped table-bordered  no-footer dataTable" id="store_category" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th width='5%'><i class="icon-cursor-move icons"></i></th>
                        <th width="10%">ID</th>
                        <th width="60%">Tittle</th>
                        <th width="30%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($storeCategories as $storeCategory)
                            <tr data-index="{{ $storeCategory->id }}" data-position="{{$storeCategory->display_order }}">
                                <td width="5%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{$storeCategory->id}}</td>
                                <td>{{$storeCategory->name_en}}<span class="badge badge-default badge-pill bg-primary float-right"></span></td>
                                <td>
                                    <div class="row">

                                        <div class="col-md-2 m-1">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Category Information" data-placement="left"
                                               href="{{route('storeCategory.edit',$storeCategory->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                       {{-- <div class="col-md-2 m-1">
                                            <button data-id="{{$storeCategory->id}}" data-toggle="tooltip" data-original-title="Delete Category" data-placement="right"
                                                    class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
                                        </div>--}}

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


@endsection


@push('style')
   {{-- <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">--}}

    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
    </style>
@endpush
@push('page-js')
   {{-- <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>--}}
    <script>

        var auto_save_url = "{{ url('myblCategory-sortable') }}";

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
                            url: "{{ url('storeCategory/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('storeCategory') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).ready(function () {
            $('#store_category').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: false,
                searching: false,
                "bDestroy": true,
                "pageLength": 15
            });
        });

    </script>
@endpush
