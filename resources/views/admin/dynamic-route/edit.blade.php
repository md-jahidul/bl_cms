@extends('layouts.admin')
@section('title', 'Route Edit')
@section('card_name', 'Route Edit')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="">Route List</a></li>
    <li class="breadcrumb-item">Route Edit</li>
@endsection
@section('action')
    <a href="{{ route("dynamic-routes.index") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("dynamic-routes.update", $route->id) }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('code') ? ' error' : '' }}">
                                    <label for="code">Container Name</label>
                                    <input type="text" id="code" name="code" class="form-control" value="{{ $route->code }}"
                                           placeholder="Enter front-end container name"
                                        {{ ($route->is_dynamic_page == 0) ? '' : 'readonly' }}>
                                    <small class="text-primary">Example: Prepaid or PrepaidDetails</small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('code'))
                                        <div class="help-block">  {{ $errors->first('code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }} {{ ($route->is_dynamic_page == 0) ? '' : 'd-none' }}"
                                     id="keyDynamic">
                                    <label for="code">Key</label>
                                    <input type="text" name="key" class="form-control" value="{{ $route->key }}"
                                           required data-validation-required-message="Enter key"
                                           placeholder="Enter key">
                                    <small class="text-primary">Example: prepaid, prepaid_details</small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('key'))
                                        <div class="help-block">  {{ $errors->first('key') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }}
                                    {{ ($route->is_dynamic_page == 1) ? '' : 'd-none' }}" id="pageDynamic">
                                    <label for="code">Pages</label>
                                    <select class="form-control" name="dynamic_page_key">
                                        <option>---Select Page---</option>
                                        @foreach($dynamicPages as $page)
                                            <option value="{{ $page->url_slug }}" {{ ($route->key == $page->url_slug) ? 'selected' : '' }}>{{ $page->page_name_en }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('key'))
                                        <div class="help-block">  {{ $errors->first('key') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }}">
                                    <label for="url" class="required">URL</label>
                                    <input type="text" name="url" id="url" class="form-control" placeholder="Enter URL"
                                           value="{{ $route->url }}" required data-validation-required-message="Enter url">
                                    <small class="text-danger">Example plain URL: /en/prepaid </small><br>
                                    <small class="text-danger">Example pattern URL: /en/prepaid/:section </small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6 pr-0 mt-2">
                                    <div class="form-group">
                                        <label for="dynamic-route" class="mr-1 cursor-pointer">Is Dynamic Page Route:</label>
                                        <input type="checkbox" name="is_dynamic_page" class="cursor-pointer" value="1" id="dynamic-route"
                                            {{ ($route->is_dynamic_page == 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="input-radio-15" @if($route->status == 1) {{ 'checked' }} @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="input-radio-16" @if($route->status == 0) {{ 'checked' }} @endif>
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
            // $('#code').keyup(function (){
            //     let enURL = $(this).val()
            //     let data = toPascal(enURL)
            //     $(this).val(data)
            // })
            // // Container Name
            // function toPascal(str) {
            //     return str.replace(/\w+/g,
            //         function(w){return w[0].toUpperCase() + w.slice(1).toLowerCase();});
            // }

            function convertToSlug(Text)
            {
                return Text.toLowerCase().replace(/\s/g, '');
            }
            $("#url").keyup(function(){
                var text = $(this).val();
                var data = convertToSlug(text);
                $(this).val(data);
            });

            let checkDynamic = $('#dynamic-route');
            let keyDynamic = $('#keyDynamic');
            let pageDynamic = $('#pageDynamic');
            let code = $('#code');
            $(checkDynamic).click(function () {
                if ($(checkDynamic).prop("checked")) {
                    pageDynamic.removeClass('d-none')
                    keyDynamic.addClass('d-none')
                    code.val('DynamicPages')
                    code.attr('readonly', 'readonly')
                } else {
                    keyDynamic.removeClass('d-none')
                    keyDynamic.children('input').val('')
                    pageDynamic.addClass('d-none')
                    code.val('')
                    code.removeAttr('readonly')
                }
            })
        })
    </script>
@endpush






