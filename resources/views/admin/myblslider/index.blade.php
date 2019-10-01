@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', 'Slider')
@section('breadcrumb')
    <li class="breadcrumb-item active">Slider List</li>
@endsection
@section('action')
    <a href="{{route('myblslider.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Slider
    </a>
@endsection
@section('content')
    <section>

        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="40%">Tittle</th>
                            <th width="20%">Slider Component Type</th>
                            <th width="30%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td width="10%">{{$slider->id}}</td>
                                    <td width="40%">
                                        {{$slider->title}}
                                        <span class="badge badge-default badge-pill bg-primary float-right">{{$slider->sliderImages->count()}}</span>

                                    </td>
                                    <td width="20%">{{$slider->SliderComponentTypes->name}}</td>
                                    <td width="30%">
                                        <div class="row justify-content-md-center no-gutters">
                                            <div class="col-md-3">
                                                <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('myblslider.edit',$slider->id)}}" class="btn-pancil btn btn-outline-success" >
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a role="button" data-toggle="tooltip" data-original-title="Add Image to slider" data-placement="top" href="{{route('myblsliderImage.index',$slider->id)}}" class=" btn btn-outline-success">
                                                    <i class="la la-plus"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a role="button" data-toggle="tooltip" data-original-title="View & Edit slider" data-placement="top" href="{{route('myblsliderImage.edit',$slider->id)}}" class=" btn btn-outline-success">
                                                    <i class="la la-eye"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <button data-id="{{$slider->id}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('myblslider/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('myblslider/') }}"
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