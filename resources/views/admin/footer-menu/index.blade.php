@extends('layouts.admin')
@section('title', 'Footer Menu List')
@section('card_name', 'Footer Menu List')
@section('breadcrumb')
    @php

        $liHtml = '<li class="breadcrumb-item"><a href="'. url('footer-menu') .'">Footer Menu</a></li>';
        for($i = count($footer_menu_items) - 1; $i >= 0; $i--){
            $liHtml .=  $i == 0 ? '<li class="breadcrumb-item active">' .  $footer_menu_items[$i]['name']  . '</li>' :
                                  '<li class="breadcrumb-item"><a href="'. url("footer-menu/". $footer_menu_items[$i]["id"] . "/child-footer") .'">' .  $footer_menu_items[$i]['name']  . '</a></li>';
        }
    @endphp
    {!! $liHtml !!}
@endsection
@section('action')

@if($parent_id != 0)
    <a href="{{ url("footer-menu/$parent_id/child-footer/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Footer Menu
    </a>
@endif

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

                        @if(count($footerMenus) == !0)
                            @foreach($footerMenus as $footerMenu)
                                @php($childNumber = count($footerMenu->children))
                                <tr data-index="{{ $footerMenu->id }}" data-position="{{ $footerMenu->display_order }}">
                                    <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ $footerMenu->en_label_text  }} {!! $footerMenu->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                    <td class="action" width="20%">
                                        <a href="{{ url('footer-menu/'.$footerMenu->id.'/edit') }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <!-- <a href="#" remove="{{ url("footer-menu/$parent_id/destroy/$footerMenu->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $footerMenu->id }}" title="Delete the user">
                                            <i class="la la-trash"></i>
                                        </a> -->
                                    </td>
                                    @if($parent_id == 0)
                                        <td class="text-center" width="10%"><a href="{{ url("footer-menu/$footerMenu->id/child-footer") }}" class="btn btn-outline-success">Child Menus <span class="ml-1 badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{ $childNumber }}</span></a></td>
                                    @endif
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
        var auto_save_url = "{{ url('sort-autosave/parent-footer-sort') }}";
    </script>
@endpush





