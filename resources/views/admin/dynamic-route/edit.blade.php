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
                                    <input type="text" id="code" name="code" class="form-control" value="{{ $route->code }}">
                                    <small class="text-primary">Example: Prepaid or PrepaidDetails</small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('code'))
                                        <div class="help-block">  {{ $errors->first('code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('key') ? ' error' : '' }}">
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
        })
    </script>
@endpush






