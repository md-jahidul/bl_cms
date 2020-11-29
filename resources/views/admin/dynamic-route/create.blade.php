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
                                    <input type="text" id="code" class="form-control" name="code" placeholder="Enter front-end container name"
                                           required data-validation-required-message="Enter front-end container name">
                                    <small class="text-primary">Example: Prepaid or PrepaidDetails</small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('code'))
                                        <div class="help-block">  {{ $errors->first('code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }}">
                                    <label for="code">Key</label>
                                    <input type="text" name="key" class="form-control"
                                           required data-validation-required-message="Enter key">
                                    <small class="text-primary">Example: prepaid, prepaid_details</small>
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
        })
    </script>
@endpush






