@extends('layouts.admin')
@section('title', 'Store')
@section('card_name', 'Store')
@section('breadcrumb')
    <li class="breadcrumb-item active">Store List</li>
@endsection

@section('action')
        @if($category->count()==0)
            <a href="{{route('storeCategory.index')}}" class="btn btn-danger round btn-glow px-2"><i class="la la-plus"></i>
                There is no category
            </a>
        @else
            <a href="{{route('myblStore.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
                Create Store
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

                    </div>
                </div>
            </div>
            <div class="card-body card-dashboard">
                <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="store_list_mybl" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th width='5%'><i class="icon-cursor-move icons"></i></th>
                        <th width="5%">ID</th>
                        <th width="12%">Title</th>
                       {{-- <th width="20%">Details</th>--}}
                        <th width="10%">Type</th>
                        <th width="10%">Category</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($stores as $store)
                            <tr data-index="{{ $store->id }}" data-position="{{$store->display_order }}">
                                <td width="5%"><i class="icon-cursor-move icons"></i></td>
                                <td width="5%">{{$store->id}}</td>
                                <td width="12%">{{$store->title}}</td>
                               {{-- <td width="30%">{{$store->description}}</td>--}}
                                <td width="30%">{{$store->type}}</td>
                                <td width="10%">@if(isset($store->storeCategories->name_en)){{$store->storeCategories->name_en}} @else {{"N/A"}} @endif </td>
                                <td width="15%">
                                    <div class="row">

                                        <div class="col-md-2 m-1">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information"
                                               data-placement="left" href="{{route('myblStore.edit',$store->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>

                                        <div class="col-md-2 m-1">
                                            <button data-id="{{$store->id}}"  data-placement="right"  class="btn btn-outline-danger deleteBtn"><i class="la la-trash"></i></button>
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
   {{-- <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">--}}
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }
    </style>
@endpush
@push('page-js')
    {{--<script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>--}}


    <script>

        var auto_save_url = "{{ url('myblStore-sortable') }}";

      $(function () {

            $('#store_list_mybl').DataTable({
                  //dom: 'Bfrtip',
                  buttons: [],
                  paging: true,
                  searching: true,
                  "bDestroy": true,
                  "pageLength": 50,
                  "order": [[ 0, "desc" ]]
            });

            $('.deleteBtn').click(function () {
                let id = $(this).attr('data-id');

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
                            url: "{{ url('myblStore/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your store has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('myblStore') }}"
                                }
                            }
                        })
                    }
                })
            })

        });

    </script>
@endpush
