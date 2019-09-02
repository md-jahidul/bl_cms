@extends('layouts.admin')
@section('title', 'Footer Menu List')
@section('card_name', 'Footer Menu List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Footer Menu List</li>
@endsection
@section('action')
    <a href="{{ url('menu/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Menu
    </a>
@endsection
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h3 class="menu-title">Dragabble Footer Menu list : label 1</h3>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <tbody id="sortable">
                        @php($i = 0)
                        @foreach($footerMenus as $footerMenu)
                            <tr data-index="{{ $footerMenu->id }}" data-position="{{ $footerMenu->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $footerMenu->en_label_text }}</td>
{{--                                @if($footerMenu->status == 0)--}}
{{--                                    <td><span class="badge bg-danger">Inactive</span></td>--}}
{{--                                @else--}}
{{--                                    <td></td>--}}
{{--                                @endif--}}
                                <td width="10%"><a href="{{ url('menu/'.$footerMenu->id.'/edit') }}" class="mr-3"><i class="ft-edit-2"></i></a> <a href="#" ><i data-id="{{$footerMenu->id}}" class="ft-trash"></i></a></td>
                                <td class="text-center" width="10%"><a href="{{ url("child-footer/$footerMenu->id") }}" class="badge bg-success">Show Child Menu</a></td>

                            <!-- <td class="">
                                    <span class="dropdown">
                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false" class="btn btn-info dropdown-toggle"><i
                                            class="la la-cog"></i></button>
                                      <span aria-labelledby="btnSearchDrop2"
                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="{{ url('menu/'.$footerMenu->id.'/edit') }}"
                                           class="dropdown-item"><i class="ft-edit-2"></i> Edit </a>
                                        <div class="dropdown-divider"></div>
                                          <form method="POST"
                                                action="{{ url('/menu', ['id' => $footerMenu->id]) }}"
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
                      </td> -->

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </section>

@stop


<style>
    h3 .menu-title{
        font-weight: bold;
    }
    .table tr{
        padding : 10px;
    }
    .card .table th,.card .table td {
        padding: 10px;
        vertical-align: middle;
    }
    .card .table-bordered th,.card .table-bordered td{
        border : 0px;
    }

    .card .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(206, 208, 212, 0.5);
    }

    /* .table-striped tbody tr:nth-of-type(even) {
        // background-color: rgba(206, 208, 212, 0.5);
    } */
</style>

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
    </script>
@endpush


