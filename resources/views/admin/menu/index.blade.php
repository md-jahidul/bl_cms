@extends('layouts.master-layout')

@section('main-content')
    <section class="content py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{--<div class="col-md-12">--}}
                        <h3 class="card-title float-left">Menu List</h3>
                        <a href="{{ url('menu/create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add Menu</a>
                        {{--</div>--}}

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th></th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="sortable">
                            @php($i = 0)
                            @foreach($menus as $menu)
                                @php($i++)
                                <tr data-index="{{ $menu->id }}" data-position="{{ $menu->display_order }}">
                                    <td class="list">{{ $i }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->url }}</td>
                                    <td class="text-center"><a href="{{ url("menu/$menu->id/child_menu") }}" class="btn btn-outline-success">Show Child Menu</a></td>
                                    @if($menu->status == 1)
                                        <td><span class="badge bg-success">Active</span></td>
                                    @else
                                        <td><span class="badge bg-danger">Inactive</span></td>
                                    @endif
                                    <td><a href="{{ url('menu/'.$menu->id.'/edit') }}" class="mr-3"><i class="fas fa-edit text-primary"></i></a> <a href="#" ><i data-id="{{$menu->id}}" class="fas fa-trash text-danger delete_btn"></i></a></td>
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
        $(function(){
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
                                    window.location.href = "{{ url('menu') }}"
                                }
                            }
                        })
                    }
                })
            })

            $("#sortable" ).sortable({
                update: function( event, ui ) {
                    $(this).children().each(function (index) {
                        // console.log(index+1)
                        if ($(this).attr('data-position') != (index+1)){
                            $(this).attr('data-position', (index+1)).addClass('update')
                        }
                    });
                    saveNewPositions()

                    $('.list').each(function (index) {
                        $(this).text(index+1)
                    })
                }
            });

            function saveNewPositions() {
                var positions = [];
                $('.update').each(function () {
                    positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                })
                $.ajax({
                    methods: "POST",
                    url:'{{ url('menu/parent_menu_sort') }}',
                    data: {
                        update: 1,
                        position: positions
                    },
                    success:function(data){ console.log(data) },
                    error : function() {
                        alert('Some problems..');
                    }
                });
            }
        });
    </script>
@endpush