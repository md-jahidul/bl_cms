@extends('layouts.admin')
@section('title', 'Footer Child Menu')
@section('card_name', 'Footer Child Menu List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('footer-menu') }}">Footer Menu List</a></li>
    <li class="breadcrumb-item active">Footer Child Menu List</li>
@endsection
@section('action')
    <a href="{{ url("child-footer/$footerChildLists->id/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
       Add Child Menu
    </a>
@endsection
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h3 class="menu-title mb-2">Parent: {{$footerChildLists->name}}</h3>
                    <h5 class="menu-title">Dragabble Menu list : lable 1</h5>

                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <tbody id="sortable">
                        @foreach($footerChildLists['children'] as $footerChild)

                            <tr data-index="{{ $footerChild->id }}" data-position="{{ $footerChild->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $footerChild->name }}</td>
                                @if($footerChild->status == 0)
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                @else
                                    <td></td>
                                @endif
                                <td class="action" width="20%">
                                    <a href="{{ url("child-footer/$footerChild->id/edit/$footerChildLists->id") }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="border-0 btn btn-outline-danger delete_btn" data-id="{{$footerChild->id}}" title="Delete the user">
                                        <i class="la la-trash"></i>
                                    </a>

{{--                                    <form method="POST" action="{{ url("child-footer/$footerChild->id/delete/$footerChildLists->id") }}" accept-charset="UTF-8" style="display:inline">--}}
{{--                                        <button type="submit" class="border-0 btn btn-outline-danger" title="Delete the user" onclick="return confirm('Are you sure?')">--}}
{{--                                            <i class="la la-trash"></i>--}}
{{--                                        </button>--}}
{{--                                        @method('delete')--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
                                </td>
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
    h3.menu-title{
        font-weight: bold;
    }
    .table tr{
        padding : 10px;
    }
    section .card {
        background: rgba(235, 242, 255, 0.5);
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

    td.action{
        width: 20%;
        text-align: right;
    }
    .table-striped tbody tr:nth-of-type(even) {
        background-color : rgb(255, 255, 255);
    }
</style>

@push('page-js')
    <script>
        $(function(){
            $('.delete_btn').click(function () {
                var id = $(this).attr('data-id');
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
                            url: "{{ url("child-footer/$footerChildLists->id/delete") }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url("child-footer/$footerChildLists->id") }}"
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





