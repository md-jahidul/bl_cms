@extends('layouts.admin')
@section('title', 'Footer Menu Edit')
@section('card_name', 'Footer Menu Edit')
@section('breadcrumb')
    @php
        $liHtml = '<li class="breadcrumb-item"><a href="'. url('footer-menu') .'">Footer Menu</a></li>';
        for($i = count($footer_menu_items) - 1; $i >= 0; $i--){
            $liHtml .=  $i == 0 ? '<li class="breadcrumb-item active">' .  $footer_menu_items[$i]['en_label_text']  . '</li>' :
                                  '<li class="breadcrumb-item"><a href="'. url("menu/". $footer_menu_items[$i]["id"] . "/child-footer") .'">' .  $footer_menu_items[$i]['en_label_text']  . '</a></li>';
        }
    @endphp
    {!! $liHtml !!}
@endsection
@section('action')
    <a href="{{ $footerMenu->parent_id == 0 ? url('footer-menu') : url("footer-menu/$footerMenu->parent_id/child-footer") }}" class="btn btn-warning  btn-glow px-2 mb-1"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("footer-menu/$footerMenu->id") }}" method="POST" novalidate>
                            <div class="row">
                                <input type="hidden" name="parent_id" value="{{ $footerMenu->parent_id }}">
                                <input type="hidden" name="id" value="{{ $footerMenu->id }}">
                                <div class="form-group col-md-12 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Page name</label>
                                    <input type="text" name="code"  class="form-control" placeholder="Enter title" readonly
                                           value="{{ $footerMenu->code }}" required data-validation-required-message="Enter footer menu title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">English Label</label>
                                    <input type="text" name="en_label_text"  class="form-control" placeholder="Enter english label"
                                           value="{{ $footerMenu->en_label_text }}" required data-validation-required-message="Enter footer menu english label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('en_label_text'))
                                        <div class="help-block">  {{ $errors->first('en_label_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('bn_label_text') ? ' error' : '' }}">
                                    <label for="title" class="required">Bangla Label</label>
                                    <input type="text" name="bn_label_text"  class="form-control" placeholder="Enter bangla label"
                                           value="{{ $footerMenu->bn_label_text }}" required data-validation-required-message="Enter footer menu bangla label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('bn_label_text'))
                                        <div class="help-block">  {{ $errors->first('bn_label_text') }}</div>
                                    @endif
                                </div>

                                <!-- <div class="form-group col-md-12 {{ $errors->has('url') ? ' error' : '' }}">
                                    <label for="url" class="required">URL</label>
                                    <input type="text" name="url"  class="form-control" placeholder="Enter URL"
                                           value="{{ $footerMenu->url }}" required data-validation-required-message="Enter footer menu url">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="external_site" class="mr-1">External Site</label>
                                        <input type="checkbox" name="external_site" value="1" id="external_site" @if($footerMenu->external_site == 1) {{ 'checked' }} @endif>
                                    </div>
                                </div> -->
                                @if($footerMenu->parent_id > 0)
                                    <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }}">
                                        <label for="url" class="required">URL</label>
                                        <input type="text" name="url"  class="form-control" placeholder="Enter URL"
                                               value="{{ $footerMenu->url }}" required data-validation-required-message="Enter footer menu url">
                                        <p class="hints"> ( For internal link only path, e.g. /offers And for external full path e.g.  https://eshop.banglalink.net/ )</p>
                                        <div class="help-block"></div>
                                        @if ($errors->has('url'))
                                            <div class="help-block">  {{ $errors->first('url') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-2 mt-1">
                                        <label></label>
                                        <div class="form-group">
                                            <label for="is_dynamic_page" class="mr-1">Is Dynamic Page:</label>
                                            <input type="checkbox" name="is_dynamic_page" value="1" id="is_dynamic_page"
                                                {{ $footerMenu->is_dynamic_page ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <div class="col-md-4 {{ $footerMenu->is_dynamic_page ? '' : 'd-none' }}" id="dynamic_page_dropdown">
                                        <label>Page Select</label>
                                        <div class="form-group">
                                            <select class="form-control" name="dynamic_page_slug">
                                                <option value="">--Select Page--</option>
                                                @foreach($dynamicPages as $dynamicPage)
                                                    <option value="{{ $dynamicPage->url_slug }}"
                                                        {{ $dynamicPage->url_slug == $footerMenu->dynamic_page_slug ? "selected" : '' }}
                                                    >{{ $dynamicPage->page_name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="input-radio-15" @if($footerMenu->status == 1) {{ 'checked' }} @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="input-radio-16" @if($footerMenu->status == 0) {{ 'checked' }} @endif>
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
            var dynamicPage = $('#dynamic_page_dropdown');
            $('#is_dynamic_page').click(function () {
                if($(this).prop("checked") == true){
                    dynamicPage.removeClass('d-none');
                }else{
                    dynamicPage.addClass('d-none')
                }
            })
        })
    </script>
@endpush






