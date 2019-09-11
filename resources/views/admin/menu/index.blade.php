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
                    <h4 class="menu-title">Dragabble and auto save items</h4>
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
                                    <a href="#" remove="{{ url("menu/$parent_id/destroy/$menu->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $menu->id }}" title="Delete the user">
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
    h4.menu-title{
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

    .breadcrumb-wrapper ol.breadcrumb{
        margin-left : 20px;
    }

    .breadcrumb-wrapper li, .breadcrumb-wrapper a{
        font-weight : bold;
        font-size : 15px;
    }

</style>

@push('page-js')
    <script>
        $(function(){           

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


