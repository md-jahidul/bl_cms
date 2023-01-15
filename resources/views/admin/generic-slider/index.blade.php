@extends('layouts.admin')
@section('title', 'Generic Slider')
@section('card_name', 'Generic Slider')
@section('breadcrumb')
    <li class="breadcrumb-item active">Generic Slider List</li>
@endsection
@section('action')
    <a href="{{route('generic-slider.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Generic Slider
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
                            <th width="20%">Slider For</th>
                            <th width="30%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                @php
                                    $position = "<span class='text-info'>(Position: <span class='text-danger'>$slider->position</span>)</span>"
                                @endphp
                                <tr>
                                    <td width="10%">{{$slider->id}}</td>
                                    <td width="20%">{{$slider->title_en}}</td>
                                    <td width="20%">{{$slider->component_for}}</td>
                                    <td width="30%">
                                        <div class="row justify-content-md-center no-gutters">
                                            <div class="col-md-3">
                                                <a role="button" title="Edit" href="{{route('generic-slider.edit',$slider->id)}}" class="btn-pancil btn btn-outline-success" >
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a role="button" title="View Images" href="{{route('generic-slider.images.index',$slider->id)}}"
                                                   class=" btn btn-outline-success">
                                                    <i class="la la-picture-o"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <button data-id="{{$slider->id}}" title="Delete" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('generic-slider/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('generic-slider') }}"
                                }
                            }
                        })
                    }
                })
            })
        })



        $(document).ready(function () {
            $('#Example1').DataTable({
                //dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10,
            });
        });

    </script>
@endpush
