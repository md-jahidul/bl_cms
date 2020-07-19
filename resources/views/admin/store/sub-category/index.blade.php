@extends('layouts.admin')
@section('title', 'Store Sub Category')
@section('card_name', 'Store Sub Category')
@section('breadcrumb')
    <li class="breadcrumb-item active">Store Sub Category List</li>
@endsection

@section('action')
    <a href="{{route('subStore.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Store Sub Category
    </a>
@endsection

@section('content')
<section>
    <div class="card card-info mt-0" style="box-shadow: 0px 0px">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <table class="table table-striped table-bordered  no-footer dataTable" id="notification_cat" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="30%">Tittle</th>
                        <th width="30%">Category</th>
                        <th width="20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($storeSubCategories as $storeSubCategory)
                            @php
                             if(isset($storeSubCategory->StoreCategory))
                               $subCat_name = $storeSubCategory->StoreCategory->name_en;
                              else $subCat_name = "";
                            @endphp
                            <tr>
                                <td>{{$storeSubCategory->id}}</td>
                                <td>{{$storeSubCategory->name_en}}</td>
                                <td>{{$subCat_name}}</td>

                                <td>
                                    <div class="row">

                                        <div class="col-md-2 m-1">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('subStore.edit',$storeSubCategory->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-2 m-1">
                                            <button data-id="{{$storeSubCategory->id}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('subStore/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('subStore') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).ready(function () {
            $('#notification_cat').DataTable({
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
