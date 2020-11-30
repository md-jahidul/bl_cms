@extends('layouts.admin')
@section('title', 'Footer Menu Create')
@section('card_name', 'Footer Menu Create')
@section('breadcrumb')
    @php
        $liHtml = '<li class="breadcrumb-item"><a href="'. url('footer-menu') .'">Footer Menu</a></li>';
        for($i = count($footer_menu_items) - 1; $i >= 0; $i--){
            $liHtml .=  $i == 0 ? '<li class="breadcrumb-item active">' .  $footer_menu_items[$i]['en_label_text']  . '</li>' :
                                  '<li class="breadcrumb-item"><a href="'. url("footer-menu/". $footer_menu_items[$i]["id"] . "/child-footer") .'">' .  $footer_menu_items[$i]['en_label_text']  . '</a></li>';
        }
    @endphp

    {!! $liHtml !!}
@endsection
@section('action')
    <a href="{{ url('footer-menu') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('footer-menu.store') }}" method="POST" novalidate>
                            <div class="row">
                                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                <input type="hidden" name="code" value="DynamicPage">
{{--                                <div class="form-group col-md-12 {{ $errors->has('code') ? ' error' : '' }}">--}}
{{--                                    <label for="code" class="required">Title</label>--}}
{{--                                    <input type="text" name="code"  class="form-control" placeholder="Enter code" readonly--}}
{{--                                           value="DynamicPage" required data-validation-required-message="Enter footer menu title">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('code'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('code') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
                                <div class="form-group col-md-6 {{ $errors->has('en_label_text') ? ' error' : '' }}">
                                    <label for="title" class="required">English Label</label>
                                    <input type="text" name="en_label_text"  class="form-control" placeholder="Enter english label"
                                           value="{{ old("en_label_text") ? old("en_label_text") : '' }}" required data-validation-required-message="Enter footer menu english label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('en_label_text'))
                                        <div class="help-block">  {{ $errors->first('en_label_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('bn_label_text') ? ' error' : '' }}">
                                    <label for="title" class="required">Bangla Label</label>
                                    <input type="text" name="bn_label_text"  class="form-control" placeholder="Enter bangla label"
                                           value="{{ old("bn_label_text") ? old("bn_label_text") : '' }}" required data-validation-required-message="Enter footer menu bangla label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('bn_label_text'))
                                        <div class="help-block">  {{ $errors->first('bn_label_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }}" id="pageDynamic">
                                    <label for="code">Pages</label>
                                    <select class="form-control" name="code">
                                        <option>---Select Page---</option>
                                        @foreach($dynamicRoutes as $route)
                                            <option value="{{ $route->key }}">{{ $route->url }}</option>
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
                                        <input type="checkbox" name="is_dynamic_page" value="1" id="external_link">
                                    </div>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('external_site') ? ' error' : '' }} d-none" id="externalLink">
                                    <label for="url" class="required">External URL</label>
                                    <input type="text" name="external_site" class="form-control slug-convert" placeholder="Enter URL"
                                           value="{{ old("external_site") ? old("external_site") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('external_site'))
                                        <div class="help-block">  {{ $errors->first('external_site') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6 mt-2">
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="input-radio-15" checked>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="input-radio-16">
                                        <label for="input-radio-16">Inactive</label>

                                        @if ($errors->has('status'))
                                            <div class="help-block">  {{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>




                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
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
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            var externalLink = $('#externalLink');
            $('#external_link').click(function () {
                if($(this).prop("checked") == true){
                    externalLink.removeClass('d-none');
                }else{
                    externalLink.addClass('d-none')
                }
            })
        })
    </script>
@endpush






