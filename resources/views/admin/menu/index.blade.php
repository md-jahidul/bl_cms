@extends('layouts.admin')
@section('title', 'Header Menu List')
@section('card_name', 'Header Menu List')
@section('breadcrumb')
    @php
        $liHtml = '<li class="breadcrumb-item"><a href="'. url('menu') .'">Menu</a></li>';
        for($i = count($menu_items) - 1; $i >= 0; $i--){
            $liHtml .=  $i == 0 ? '<li class="breadcrumb-item active">' .  $menu_items[$i]['en_label_text']  . '</li>' :
                                  '<li class="breadcrumb-item"><a href="'. url("menu/". $menu_items[$i]["id"] . "/child-menu") .'">' .  $menu_items[$i]['en_label_text']  . '</a></li>';
        }
    @endphp
    {!! $liHtml !!}
@endsection
@section('action')
    <a href="{{ $parent_id == 0 ? url('menu/create') : url("menu/$parent_id/child-menu/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Header Menu
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
                                @php($childNumber = count($menu->children))
                                <tr data-index="{{ $menu->id }}" data-position="{{ $menu->display_order }}">
                                    <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ $menu->en_label_text  }} {!! $menu->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                    <td class="action" width="20%">
                                        <a href="{{ url('menu/'.$menu->id.'/edit') }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("menu/$parent_id/destroy/$menu->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $menu->id }}" title="Delete the user">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                   <td class="text-center" width="10%"><a href="{{ url("menu/$menu->id/child-menu") }}" class="btn btn-outline-success">Child Menus <span class="ml-1 badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{ $childNumber }}</span></a></td>
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

    @if($parent_id == 0)
        <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Ad Tech</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('adtech.store') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('img_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Ad Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="img_url" data-height="90" class="dropify"
                                               data-default-file="{{ isset($adTech->img_url) ? config('filesystems.file_base_url') . $adTech->img_url : '' }}">
                                    </div>
                                    {{--                                    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
                                    <div class="help-block"></div>
                                    @if ($errors->has('img_url'))
                                        <div class="help-block">  {{ $errors->first('img_url') }}</div>
                                    @endif
                                </div>

                                {{-- <div class="form-group col-md-12 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
                                {{--     <label for="alt_text">Alt Text</label>--}}
                                {{--     <input type="text" name="items[alt_text_en]" id="alt_text" class="form-control"--}}
                                {{--            placeholder="Enter alt text" value="{{ isset($adTech->items['alt_text_en']) ? $adTech->items['alt_text_en'] : '' }}">--}}
                                {{--     <div class="help-block"></div>--}}
                                {{--     @if ($errors->has('alt_text'))--}}
                                {{--         <div class="help-block">{{ $errors->first('alt_text') }}</div>--}}
                                {{--     @endif--}}
                                {{-- </div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }} {{ ($menu->external_site == 1) ? 'd-none' : '' }}" id="pageDynamic">--}}
{{--                                    <label for="code">Page URL</label>--}}
{{--                                    <select class="select2 form-control" name="code">--}}
{{--                                        <option value="">---Select Page---</option>--}}
{{--                                        @foreach($dynamicRoutes as $route)--}}
{{--                                            <option value="{{ $route->key }}" {{ ($route->key == $menu->code) ? 'selected' : '' }}>{{ $route->url }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('key'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('key') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }} {{ (isset($adTech) && $adTech->is_external_url == 0) ? '' : (!isset($adTech) ? '' : 'd-none') }}" id="pageDynamic">
                                    <label for="url">Redirect URL</label>
                                    <input type="text" name="redirect_url_en" class="form-control slug-convert" placeholder="Enter URL"
                                           value="{{ isset($adTech) ? $adTech->redirect_url_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }} {{ (isset($adTech) && $adTech->is_external_url == 1) ? '' : 'd-none' }}" id="externalLink">
                                    <label for="url">External URL</label>
                                    <input type="text" name="external_url" class="form-control" placeholder="Enter URL"
                                           value="{{ isset($adTech) ? $adTech->external_url : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6 mt-1">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="external_link">Is External Menu:</label>
                                        <input type="checkbox" name="is_external_url" value="1" id="external_link" {{ old("is_external_url") ? 'checked' : '' }}
                                            {{ (isset($adTech) && $adTech->is_external_url == 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
{{--                                    {{ dd($adTech->status) }}--}}
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>
                                        <input type="radio" id="active" name="status" value="1" {{ isset($adTech->status) && $adTech->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" id="inactive" name="status" value="0" {{ isset($adTech->status) && $adTech->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        var auto_save_url = "{{ url('menu-auto-save') }}";

        var externalLink = $('#externalLink');
        var pageDynamic = $('#pageDynamic');

        $('#external_link').click(function () {
            if($(this).prop("checked") == true){
                externalLink.removeClass('d-none');
                pageDynamic.addClass('d-none');
            }else{
                pageDynamic.removeClass('d-none')
                externalLink.addClass('d-none')
            }
        })

        // Image Dropify
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
            });
        });
    </script>
@endpush


