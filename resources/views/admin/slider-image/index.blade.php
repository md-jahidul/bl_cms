@extends('layouts.master-layout')

@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        {{--<div class="col-md-12">--}}
                        <h3 class="card-title float-left">Slider Image List</h3>
                        <a href="{{ url('slider_image/create') }}" class="btn btn-success float-right" >Add Slider</a>
                        {{--</div>--}}

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th># S.L</th>
                                <th>Slider Name</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Button Label</th>
                                <th>URL</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 0)
                                @foreach($slider_images as $slider_image)
                                    @php($i++)
                                    <tr>
                                        <td class="pt-4">{{ $i }}</td>
                                        <td class="pt-4">{{ $slider_image->slider['title'] }}</td>
                                        <td class="pt-4">{{ $slider_image->title }}</td>
                                        <td><img class="img-thumbnail" src="{{ asset($slider_image->image_url) }}" alt="Slider Image" height="100" width="120" /></td>
                                        <td class="pt-4">{{ $slider_image->description }}</td>
                                        <td class="pt-4">{{ $slider_image->url_btn_label }}</td>
                                        <td class="pt-4">{{ $slider_image->url }}</td>
                                        <td class="pt-4">
                                            <a href="{{ url("slider_image/$slider_image->id/edit") }}" class="btn btn-outline-info border-0"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                            <button href="#" data-toggle="#danger" role="button" data-placement="right" data-id="{{ $slider_image->id }}" title="Delete" class="border-0 btn btn-outline-danger delete_btn"><i class="fas fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    {{--User Create Modal--}}
    <div class="modal fade" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-danger text-light">
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i>Delete</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <form id="deleteForm" action="" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="modal-text" class="text-center font-weight-bold "></p>
                        <input name="id" id="deleteID" type="hidden" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info pull-left" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-outline-danger pull-left">Delete</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modal -->
@stop

@push('scripts')
<script>

    $(function () {
        $('.delete_btn').click(function () {
            var id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                html: jQuery('.delete_btn').html(),
                showCancelButton: true,
                confirmButtonColor: '#f51c31',
                cancelButtonColor: '#1fdd4b',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('slider_image/destroy') }}/"+id,
                        methods: "get",
                        success: function (res) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success',
                            );
                            setTimeout(redirect, 2000)
                            function redirect() {
                                window.location.href = "{{ url('slider_image') }}"
                            }
                        }
                    })
                }
            })
        })
    })

</script>
@endpush