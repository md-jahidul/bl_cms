@extends('layouts.admin')
@section('title', 'Tag List')
@section('card_name', 'Menu List')
@section('breadcrumb')
    @php 
        $liHtml = '<li class="breadcrumb-item"><a href="'. url('menu') .'">Menu</a></li>';
        for($i = count($menu_items) - 1; $i >= 0; $i--){
            $liHtml .=  $i == 0 ? '<li class="breadcrumb-item active">' .  $menu_items[$i]['name']  . '</li>' : 
                                  '<li class="breadcrumb-item"><a href="'. url("menu/". $menu_items[$i]["id"] . "/child-menu") .'">' .  $menu_items[$i]['name']  . '</a></li>';
        }
    @endphp

    {!! $liHtml !!}
@endsection
@section('action')
    <a href="{{ $parent_id == 0 ? url('menu/create') : url("menu/$parent_id/child-menu/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
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
                        @foreach($menus as $menu)
                            @php($i++)
                            <tr data-index="{{ $menu->id }}" data-position="{{ $menu->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $menu->en_label_text  }} {!! $menu->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td class="action" width="20%">
                                    <a href="{{ url('menu/'.$menu->id.'/edit') }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $menu->id }}" title="Delete the user">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                               <td class="text-center" width="10%"><a href="{{ url("menu/$menu->id/child-menu") }}" class="badge bg-success">Child Menus</a></td>
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

    span.inactive{
        color: red;
        font-size: small;
    }


    /** The Magic **/
    .btn-breadcrumb .btn:not(:last-child):after {
    content: " ";
    display: block;
    width: 0;
    height: 0;
    border-top: 17px solid transparent;
    border-bottom: 17px solid transparent;
    border-left: 10px solid white;
    position: absolute;
    top: 50%;
    margin-top: -17px;
    left: 100%;
    z-index: 3;
    }
    .btn-breadcrumb .btn:not(:last-child):before {
    content: " ";
    display: block;
    width: 0;
    height: 0;
    border-top: 17px solid transparent;
    border-bottom: 17px solid transparent;
    border-left: 10px solid rgb(173, 173, 173);
    position: absolute;
    top: 50%;
    margin-top: -17px;
    margin-left: 1px;
    left: 100%;
    z-index: 3;
    }

    /** The Spacing **/
    .btn-breadcrumb .btn {
    padding:6px 12px 6px 24px;
    }
    .btn-breadcrumb .btn:first-child {
    padding:6px 6px 6px 10px;
    }
    .btn-breadcrumb .btn:last-child {
    padding:6px 18px 6px 24px;
    }

    /** Default button **/
    .btn-breadcrumb .btn.btn-default:not(:last-child):after {
    border-left: 10px solid #fff;
    }
    .btn-breadcrumb .btn.btn-default:not(:last-child):before {
    border-left: 10px solid #ccc;
    }
    .btn-breadcrumb .btn.btn-default:hover:not(:last-child):after {
    border-left: 10px solid #ebebeb;
    }
    .btn-breadcrumb .btn.btn-default:hover:not(:last-child):before {
    border-left: 10px solid #adadad;
    }

    /** Primary button **/
    .btn-breadcrumb .btn.btn-primary:not(:last-child):after {
    border-left: 10px solid #428bca;
    }
    .btn-breadcrumb .btn.btn-primary:not(:last-child):before {
    border-left: 10px solid #357ebd;
    }
    .btn-breadcrumb .btn.btn-primary:hover:not(:last-child):after {
    border-left: 10px solid #3276b1;
    }
    .btn-breadcrumb .btn.btn-primary:hover:not(:last-child):before {
    border-left: 10px solid #285e8e;
    }

    /** Success button **/
    .btn-breadcrumb .btn.btn-success:not(:last-child):after {
    border-left: 10px solid #5cb85c;
    }
    .btn-breadcrumb .btn.btn-success:not(:last-child):before {
    border-left: 10px solid #4cae4c;
    }
    .btn-breadcrumb .btn.btn-success:hover:not(:last-child):after {
    border-left: 10px solid #47a447;
    }
    .btn-breadcrumb .btn.btn-success:hover:not(:last-child):before {
    border-left: 10px solid #398439;
    }

    /** Danger button **/
    .btn-breadcrumb .btn.btn-danger:not(:last-child):after {
    border-left: 10px solid #d9534f;
    }
    .btn-breadcrumb .btn.btn-danger:not(:last-child):before {
    border-left: 10px solid #d43f3a;
    }
    .btn-breadcrumb .btn.btn-danger:hover:not(:last-child):after {
    border-left: 10px solid #d2322d;
    }
    .btn-breadcrumb .btn.btn-danger:hover:not(:last-child):before {
    border-left: 10px solid #ac2925;
    }

    /** Warning button **/
    .btn-breadcrumb .btn.btn-warning:not(:last-child):after {
    border-left: 10px solid #f0ad4e;
    }
    .btn-breadcrumb .btn.btn-warning:not(:last-child):before {
    border-left: 10px solid #eea236;
    }
    .btn-breadcrumb .btn.btn-warning:hover:not(:last-child):after {
    border-left: 10px solid #ed9c28;
    }
    .btn-breadcrumb .btn.btn-warning:hover:not(:last-child):before {
    border-left: 10px solid #d58512;
    }

    /** Info button **/
    .btn-breadcrumb .btn.btn-info:not(:last-child):after {
    border-left: 10px solid #5bc0de;
    }
    .btn-breadcrumb .btn.btn-info:not(:last-child):before {
    border-left: 10px solid #46b8da;
    }
    .btn-breadcrumb .btn.btn-info:hover:not(:last-child):after {
    border-left: 10px solid #39b3d7;
    }
    .btn-breadcrumb .btn.btn-info:hover:not(:last-child):before {
    border-left: 10px solid #269abc;
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
                            url: "{{ url("menu/$parent_id/destroy") }}/"+id,
                            methods: "get",
                            success: function (res) {
                                console.log(res);

                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url( ($parent_id == 0) ? 'menu' : "/menu/$parent_id/child-menu") }}";
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
                    url:'{{ url('menu-auto-save') }}',
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


