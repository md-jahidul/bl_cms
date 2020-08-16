@extends('layouts.admin')
@section('title', 'App')
@section('card_name', 'App')
@section('breadcrumb')
    <li class="breadcrumb-item active">App List</li>
@endsection

@section('action')
            <a href="{{route('appStore.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
                Create App
            </a>
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
                        <th width="12%">Title</th>
                        <th width="20%">Details</th>
                        <th width="10%">Category</th>
                        <th width="10%">status</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($appStores as $appStore)
                            <tr>
                                <td width="5%">{{$appStore->id}}</td>
                                <td width="12%">{{$appStore->title}}</td>
                                <td width="20%">{!! $appStore->description !!}</td>

                                <td width="10%">

                                    @if(isset($appStore->storeCategories->name_en))
                                        {{$appStore->storeCategories->name_en}}
                                    @else {{"N/A"}}
                                    @endif

                                    

                                </td>

                                <td width="10%">
                                    @if($appStore->is_active == "1")
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td width="15%">
                                    <div class="row">

                                        <div class="col-md-2 m-1">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information"
                                               data-placement="left" href="{{route('appStore.edit',$appStore->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>

                                        <div class="col-md-2 m-1">
                                            <a role="button" title="View Images" href="{{route('appslider.images.index',$appStore->id)}}"
                                               class=" btn btn-outline-success"> <i class="la la-picture-o"></i>
                                            </a>
                                        </div>

                                        <div class="col-md-2 m-1">
                                            <button data-id="{{$appStore->id}}" data-toggle="tooltip" data-original-title="Delete Category" data-placement="right"
                                                    class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('appStore/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your store has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('appStore') }}"
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
