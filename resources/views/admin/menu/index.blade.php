@extends('layouts.admin')
@section('title', 'Tag List')
@section('card_name', 'Menu List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Menu List</li>
@endsection
@section('action')
    <a href="{{ url('menu/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Menu
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
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
{{--                                <td><a href="{{ url('menu/'.$menu->id.'/edit') }}" class="mr-3"><i class="fas fa-edit text-primary"></i></a> <a href="#" ><i data-id="{{$menu->id}}" class="fas fa-trash text-danger delete_btn"></i></a></td>--}}

                                <td class="">
                                    <span class="dropdown">
                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false" class="btn btn-info dropdown-toggle"><i
                                            class="la la-cog"></i></button>
                                      <span aria-labelledby="btnSearchDrop2"
                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="{{ url('menu/'.$menu->id.'/edit') }}"
                                           class="dropdown-item"><i class="ft-edit-2"></i> Edit </a>
                                        <div class="dropdown-divider"></div>
                                          <form method="POST"
                                                action="{{ url('/menu', ['id' => $menu->id]) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                          <button type="submit" class="dropdown-item danger"
                                                  title="Delete the user"
                                                  onclick="return confirm('Are you sure?')"><i
                                                  class="ft-trash"></i> Delete</button>
                                               @method('delete')
                                              @csrf
                                          </form>
                                      </span>
                                    </span>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </section>

@stop

@push('page-js')
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


        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf', "charset": "utf-8",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>
@endpush



