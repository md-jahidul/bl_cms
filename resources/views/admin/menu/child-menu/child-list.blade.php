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
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h3 class="menu-title">Dragabble Menu list : lable 1</h3>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <tbody id="sortable">
                        @php($i = 0)
                        @foreach($child_menus as $child_menu)
                            @php($i++)
                            <tr data-index="{{ $child_menu->id }}" data-position="{{ $child_menu->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $child_menu->en_label_text }}</td>
                                @if($child_menu->status == 0)
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                @else
                                    <td></td>
                                @endif
                                <td width="10%"><a href="{{ url('menu/'.$child_menu->id.'/edit') }}" class="mr-3"><i class="ft-edit-2"></i></a> <a href="#" ><i data-id="{{$child_menu->id}}" class="ft-trash"></i></a></td>
                                <td class="text-center" width="10%"><a href="{{ url("menu/$child_menu->id/child_menu") }}" class="badge bg-success">Show Child Menu</a></td>

                                @method('delete')
                                @csrf
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


