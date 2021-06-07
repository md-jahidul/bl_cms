@extends('layouts.admin')
@section('title', 'App Menu List')
@section('card_name', 'App Menu List')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('mybl-menu') }}">Menu</a></li>
    @if($parent_id != 0)
        <li class="breadcrumb-item active">{{ $parentMenu->title_en }}</li>
    @endif
@endsection
@section('action')
    <a href="{{ $parent_id == 0 ? url('mybl-menu/create') : url("mybl-menu/$parent_id/child-menu/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Menu
    </a>
@endsection
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">{{ $parent_id != 0 ? "Sub Categories" : 'Categories' }} List</h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <tbody id="sortable">
                        @if(count($menus) == !0)
                            @foreach($menus as $menu)
                                @php($childNumber = count($menu->children))
                                <tr data-index="{{ $menu->id }}" data-position="{{ $menu->display_order }}">
                                    <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                    @if($parent_id != 0)
                                        <td width="5%">
                                            <img class="" src="{{ asset($menu->icon) }}" alt="Icon Image"
                                                 height="50" width="50"/>
                                        </td>
                                    @endif

                                    <td>{{ $menu->title_en  }} {!! $menu->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                    <td class="action" width="5%">
                                        <a href="{{ url('mybl-menu/'.$menu->id.'/edit') }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("mybl-menu/$parent_id/destroy/$menu->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $menu->id }}" title="Delete the user">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                    @if($parent_id == 0)
                                       <td class="text-center" width="10%">
                                           <a href="{{ url("mybl-menu/$menu->id/child-menu") }}" class="btn btn-outline-success">Child Menus <span class="ml-1 badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{ $childNumber }}</span></a>
                                       </td>
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
        var auto_save_url = "{{ url('mybl-menu-auto-save') }}";
    </script>
@endpush


