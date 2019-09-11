@extends('layouts.admin')
@section('title', 'Menu List')
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
                        @if(count($menus) == !0)
                            @foreach($menus as $menu)
                                @php($childCount = count($menu->children))
                                <tr data-index="{{ $menu->id }}" data-position="{{ $menu->display_order }}">
                                    <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ $menu->en_label_text  }} {!! $menu->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                    <td class="action" width="20%">
                                        <a href="{{ url('menu/'.$menu->id.'/edit') }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("menu/$parent_id/destroy/$menu->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $menu->id }}" title="Delete the user">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                   <td class="text-center" width="10%"><a href="{{ url("menu/$menu->id/child-menu") }}" class="btn btn-outline-success">Child Menus <spen class="text-danger">({{ $childCount }})</spen></a></td>
                                </tr>
                            @endforeach
                        @else
                            <div class="text-center mt-5">
                                <spen>No data available in table</spen>
                            </div>
                        @endif


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('menu-auto-save') }}";
    </script>
@endpush


