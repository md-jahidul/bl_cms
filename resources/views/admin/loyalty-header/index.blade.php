@extends('layouts.admin')
@section('title', 'Priyojon Header Settings')
@section('card_name', 'Priyojon Header Settings')
@section('breadcrumb')
    @php
        $liHtml = '<li class="breadcrumb-item"><a href="'. url('priyojon') .'">Priyojon Header Menu</a></li>';
        for($i = count($menu_items) - 1; $i >= 0; $i--){
            $liHtml .=  $i == 0 ? '<li class="breadcrumb-item active">' .  $menu_items[$i]['title_en']  . '</li>' :
                                  '<li class="breadcrumb-item"><a href="'. url("priyojon/". $menu_items[$i]["id"] . "/child-menu") .'">' .  $menu_items[$i]['title_en']  . '</a></li>';
        }
    @endphp
    {!! $liHtml !!}
@endsection
@section('action')
    @if($parent_id != 0)
        <a href="{{ url("priyojon/$parent_id/child-menu/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
            Add Menu
        </a>
    @endif
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Priyojon Header Menu List</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th>Title</th>
                            @if($parent_id == 0)
                                <th>Banner Image</th>
                            @endif
                            <th width="12%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($priyojons as $priyojon)

                                <tr data-index="{{ $priyojon->id }}" data-position="{{ $priyojon->display_order }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $priyojon->title_en }}{!! $priyojon->status == 0 ? '<span class="text-danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                    @if($parent_id == 0)
                                        <td>
                                            <img class="" src="{{ config('filesystems.file_base_url') . $priyojon->banner_image_url }}" alt="Slider Image" height="70" width="180">
                                            {!!  ($parent_id == 0) ? "<a href='".url("priyojon/$priyojon->id/child-menu")."' class='btn-sm btn-outline-secondary border float-md-right'> Child Menu</a>" : '' !!}
                                        </td>
                                    @endif
                                    <td class="action" >
                                        <a href="{{ url('priyojon/'.$priyojon->id.'/edit') }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        @if($parent_id != 0)
                                            <a href="#" remove="{{ url("priyojon/$parent_id/destroy/$priyojon->id") }}"
                                               class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $priyojon->id }}" title="Delete the user">
                                                <i class="la la-trash"></i>
                                            </a>
                                        @endif
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

@push('page-css')
    {{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')

@endpush





