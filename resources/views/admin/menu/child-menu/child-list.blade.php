@extends('layouts.master-layout')

@section('main-content')
    <section class="content py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{--<div class="col-md-12">--}}
                        <h3 class="card-title float-left">Child List</h3>
                        <a href="{{ url("menu/$parent_id/child_menu_create") }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add Child</a>
                        {{--</div>--}}

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-hover">
                            <thead>
                            <tr>
                                <!-- <th>#</th> -->
                                <th>Name</th>
                                <th>Parent</th>
                                <th>URL</th>
                                <th></th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 0)
                            @foreach($child_menus as $child_menu)
                                @php($i++)
                                <tr>
                                    <!-- <td>{{ $i }}</td> -->
                                    <td>{{ $child_menu->name }}</td>
                                    <td>{{ $child_menu->parent['name'] }}</td>
                                    <td>{{ $child_menu->url }}</td>
                                    <td class="text-center"><a href="{{ url("menu/$child_menu->id/child_sub_menu") }}" class="btn btn-outline-success">Show Child Menu</a></td>
                                    @if($child_menu->status == 1)
                                        <td><span class="badge bg-success">Active</span></td>
                                    @else
                                        <td><span class="badge bg-danger">Inactive</span></td>
                                    @endif
                                    <td><a href="{{ url('menu/'.$child_menu->id.'/child_edit') }}" class="mr-3"><i class="fas fa-edit text-primary"></i></a> <a href="#" ><i data-id="{{$child_menu->id}}" class="fas fa-trash text-danger delete_btn"></i></a></td>
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
                            url: "{{ url('menu/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url("menu/$parent_id/child_menu") }}"
                                }
                            }
                        })
                    }
                })
            })
        })

    </script>
@endpush