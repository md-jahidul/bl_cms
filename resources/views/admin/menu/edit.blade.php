@extends('layouts.admin')
@section('title', 'Menu Edit')
@section('card_name', 'Menu Edit')
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
    <a href="{{ $menu->parent_id == 0 ? url('menu') : url("menu/$menu->parent_id/child-menu") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("menu/$menu->id") }}" method="POST" novalidate>
                            <div class="row">
                                <input type="hidden" name="parent_id" value="{{ $menu->parent_id }}">

                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">English Label</label>
                                    <input type="text" name="en_label_text"  class="form-control" placeholder="Enter english label"
                                           value="{{ $menu->en_label_text }}" required data-validation-required-message="Enter footer menu english label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('en_label_text'))
                                        <div class="help-block">  {{ $errors->first('en_label_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('bn_label_text') ? ' error' : '' }}">
                                    <label for="title" class="required">Bangla Label</label>
                                    <input type="text" name="bn_label_text"  class="form-control" placeholder="Enter label in Bangla"
                                           value="{{ $menu->bn_label_text }}" required data-validation-required-message="Enter label in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('bn_label_text'))
                                        <div class="help-block">  {{ $errors->first('bn_label_text') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }}">--}}
{{--                                    <label for="url" class="required">Redirect URL English</label>--}}
{{--                                    <input type="text" name="url"  class="form-control" placeholder="Enter URL"--}}
{{--                                           value="{{ $menu->url }}" required data-validation-required-message="Enter footer menu url">--}}
{{--                                    <p class="hints"> ( For internal link only path, e.g. /offers And for external full path e.g.  https://eshop.banglalink.net/ )</p>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('url'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('url') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('url_bn') ? ' error' : '' }}">--}}
{{--                                    <label for="url_bn">Redirect URL Bangla</label>--}}
{{--                                    <input type="text" name="url_bn" class="form-control" placeholder="Enter URL in Bangla"--}}
{{--                                           value="{{ $menu->url_bn }}">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('url_bn'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('url_bn') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }} {{ ($menu->external_site == 1) ? 'd-none' : '' }}" id="pageDynamic">
                                    <label for="code">Page URL</label>
                                    <select class="select2 form-control" name="code">
                                        <option value="">---Select Page---</option>
                                        @foreach($dynamicRoutes as $route)
                                            <option value="{{ $route->key }}" {{ ($route->key == $menu->code) ? 'selected' : '' }}>{{ $route->url }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('key'))
                                        <div class="help-block">  {{ $errors->first('key') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-2 mt-1">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="external_link">Is External Menu:</label>
                                        <input type="checkbox" name="external_site" value="1" id="external_link" {{ old("url") ? 'checked' : '' }}
                                            {{ ($menu->external_site == 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="form-group col-md-10 {{ $errors->has('url') ? ' error' : '' }} {{ ($menu->external_site == 1) ? '' : 'd-none' }}" id="externalLink">
                                    <label for="url">External URL</label>
                                    <input type="text" name="url" class="form-control slug-convert" placeholder="Enter URL"
                                           value="{{ $menu->url }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="external_site" class="mr-1">External Site</label>
                                        <input type="checkbox" name="external_site" value="1" id="external_site" @if($menu->external_site == 1) {{ 'checked' }} @endif>
                                    </div>
                                </div> -->


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="input-radio-15" @if($menu->status == 1) {{ 'checked' }} @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="input-radio-16" @if($menu->status == 0) {{ 'checked' }} @endif>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            @method('PUT')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')
    <script>
        $(function () {
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

        })
    </script>
@endpush






