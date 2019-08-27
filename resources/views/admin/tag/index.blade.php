@extends('layouts.master-layout')

@section('main-content')

    {{--@if (session('error'))--}}
        {{--<div class="alert alert-danger">{{ session('error') }}</div>--}}
    {{--@endif--}}
    
    <div class="container-fluid pt-4">

    <div class="card">
        <div class="card-header">
            <h5 class="float-left"><b>Tag List</b></h5>
            <a href="#" data-toggle="modal" data-target="#tag_add" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add Tag</a>
        </div>
        <div class="card-body">
            <table id="tag_data" class="display table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Tag</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $key=>$tag)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{$tag->title}}</td>
                            <td>{{$tag->slug}}</td>
                            <td>
                                <a href="{{ url('tag/'.$tag->id.'/edit') }}" role="button" class="btn btn-outline-info border-0"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="#" class="border-0 btn btn-outline-danger delete_btn" data-id="{{$tag->id}}"><i data-id="{{$tag->id}}" class="fas fa-trash " aria-hidden="true"></i></a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    {{--Tag Model--}}
    <div class="modal fade" id="tag_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-info text-light">
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i>Tag </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <form id="updateForm" role="form" action="{{ route('tag.store') }}" method="POST">
                    <div class="modal-body">
                        <!-- general form elements -->
                        <div class="card">
                            <!-- form start -->
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">Tag</label>
                                    <input value="" type="text" class="form-control" name="title" id="username" placeholder="Enter tag name">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@push('scripts')
    <script>
        $(function () {
            $('.delete_btn').click(function (event) {
                var id = $(event.target).attr('data-id');

                console.log(id);

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
                            url: "{{ url('tag/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('tag') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush



