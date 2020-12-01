@extends('layouts.admin')
@section('title', 'Route Create')
@section('card_name', 'Route Create')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="">Route List</a></li>
    <li class="breadcrumb-item">Route Create</li>
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
                        <form role="form" action="{{ route("dynamic-routes.store") }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('code') ? ' error' : '' }}">
                                    <label for="code" class="required">Container Name</label>
                                    <input type="text" id="code" class="form-control" name="code" placeholder="Enter front-end container name">
                                    <small class="text-primary">Example: Prepaid or PrepaidDetails</small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('code'))
                                        <div class="help-block">  {{ $errors->first('code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }}" id="keyDynamic">
                                    <label for="code">Key</label>
                                    <input type="text" name="key" class="form-control">
                                    <small class="text-primary">Example: prepaid, prepaid_details</small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('key'))
                                        <div class="help-block">  {{ $errors->first('key') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }} d-none" id="pageDynamic">
                                    <label for="code">Pages</label>
                                    <select class="form-control" name="key">
                                        <option>---Select Page---</option>
                                        @foreach($dynamicPages as $page)
                                            <option value="{{ $page->url_slug }}">{{ $page->page_name_en }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('key'))
                                        <div class="help-block">  {{ $errors->first('key') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }}">
                                    <label for="url" class="required">English URL</label>
                                    <input type="text" name="url[]" id="en_url" class="form-control" placeholder="Enter english URL"
                                           required data-validation-required-message="Enter url">
                                    <small class="text-danger">Example plain URL: /en/prepaid </small><br>
                                    <small class="text-danger">Example pattern URL: /en/prepaid/:section </small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }}">
                                    <label for="url" class="required">Bangla URL</label>
                                    <input type="text" name="url[]" id="bn_url" class="form-control" placeholder="Enter bangla URL"
                                           required data-validation-required-message="Enter url">
                                    <small class="text-danger">Example plain URL: /bn/prepaid </small><br>
                                    <small class="text-danger">Example pattern URL: /bn/prepaid/:section </small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6 pr-0">
                                    <div class="form-group">
                                        <label for="dynamic-route" class="mr-1 cursor-pointer">Is Dynamic Route:</label>
                                        <input type="checkbox" name="is_dynamic_page" class="cursor-pointer" value="1" id="dynamic-route">
                                    </div>
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
                                                class="la la-check-square-o"></i> Save
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
    <script>
        $(function () {
            // $('#code').keyup(function (){
            //     let enURL = $(this).val()
            //     let data = toPascal(enURL)
            //     $(this).val(data)
            // })
            // Container Name
            // function toPascal(str) {
            //     return str.replace(/\w+/g,
            //         function(w){return w[0].toUpperCase() + w.slice(1).toLowerCase();});
            // }

            function convertToSlug(Text)
            {
                return Text.toLowerCase().replace(/\s/g, '');
            }
            $("#en_url").keyup(function(){
                var text = $(this).val();
                var data = convertToSlug(text);
                $(this).val(data);
            });
            $("#bn_url").keyup(function(){
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
                    code.val('DynamicPage')
                    code.attr('readonly', 'readonly')
                } else {
                    keyDynamic.removeClass('d-none')
                    pageDynamic.addClass('d-none')
                    code.val('')
                    code.removeAttr('readonly')
                }
            })
        })
    </script>
@endpush






