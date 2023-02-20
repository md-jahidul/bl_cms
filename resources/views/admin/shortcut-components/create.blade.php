@extends('layouts.admin')
@section('title', 'Shortcut Component')
@section('card_name',"Shortcut Component" )
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ route('shortcut-components') }}">Shortcut List</a>
    </li>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Campaign Create Form</strong></h5>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form id="feed-form" novalidate class="form row"
                              action="{{ (isset($component)) ? route('shortcut-component.update', $component->id) : route('shortcut-component.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @if(isset($component))
                                @method('put')
                            @else
                                @method('post')
                            @endif
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title_en" class="required">Title EN</label>
                                        <input
                                               value="{{ isset($component) ? $component->title_en : old('title') }}" id="title_en"
                                               type="text" class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Title EN" name="title_en" required>
                                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title_en" class="required">Title BN</label>
                                        <input
                                            value="{{ isset($component) ? $component->title_bn : old('title') }}" id="title"
                                            type="text" class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Title BN" name="title_bn" required>
                                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div id="image-input" class="form-group col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="image_url">Thumbnail Image</label>
                                            <input type="file"
                                                   id="image_url"
                                                   name="icon"
                                                   class="dropify_image"
                                                   data-default-file="{{ isset($component) ? asset($component->icon) : ''}}"
                                                   data-allowed-file-extensions="png jpg jpeg gif"/>
                                            <div class="help-block"></div>
                                            <small
                                                class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                            <small id="massage"></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="title_en" >Deeplink URL</label>
                                        <input
                                            value="{{ isset($component) ? $component->deeplink_url : old('deeplink_url') }}" id="deeplink_url"
                                            type="text" class="form-control @error('deeplink_url') is-invalid @enderror"
                                            placeholder="Deeplink URL" name="deeplink_url">
                                        <small class="text-danger"> @error('deeplink_url') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="status_input">Customer Type: </label>
                                        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                            <input type="radio" name="customer_type" value="prepaid" id="input-radio-15"
                                                {{ (isset($component->customer_type) && $component->customer_type == 'prepaid') ? 'checked' : '' }}>
                                            <label for="input-radio-15" class="mr-3">Prepaid</label>

                                            <input type="radio" name="customer_type" value="postpaid" id="input-radio-15"
                                                {{ (isset($component->customer_type) && $component->customer_type == 'postpaid') ? 'checked' : '' }}>
                                            <label for="input-radio-15" class="mr-3">Postpaid</label>

                                            <input type="radio" name="customer_type" value="all" id="input-radio-16"
                                                {{ (isset($component->customer_type) && $component->customer_type == 'all') ? 'checked' : '' }}
                                                {{ !isset($component->customer_type) ? "checked" : "" }}>
                                            <label for="input-radio-16" class="mr-3">ALL</label>
                                            @if ($errors->has('status'))
                                                <div class="help-block">  {{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="status_input">Status: </label>
                                        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                            <input type="radio" name="status" value="1" id="input-radio-15"
                                                {{ (isset($component->status) && $component->status == 1) ? 'checked' : '' }}>
                                            <label for="input-radio-15" class="mr-3">Active</label>
                                            <input type="radio" name="status" value="0" id="input-radio-16"
                                                {{ (isset($component->status) && $component->status == 0) ? 'checked' : '' }}
                                                {{ !isset($component->status) ? "checked" : "" }}>
                                            <label for="input-radio-16" class="mr-3">Inactive</label>
                                            @if ($errors->has('status'))
                                                <div class="help-block">  {{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-actions col-md-12">
                                        <div class="pull-right">
                                            <button id="save" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')

@endpush
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.dropify_image').dropify({
                messages: {
                    'default': 'Browse for an Image to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });

            $(".product-list").select2()
            $('.report-repeater').repeater();

            let campaignStart = $('#start_date');
            let campaignEnd = $('#end_date');
            let productStart = $('.product_start_date');
            let productEnd = $('.product_end_date');

            function dateTime(element){
                var date = new Date();
                date.setDate(date.getDate());
                element.datetimepicker({
                    format : 'YYYY-MM-DD HH:mm:ss',
                    showClose: true,
                });
            }

            $('#repeater-button').click(function (){
                $('.dropify_image').dropify({
                    messages: {
                        'default': 'Browse for an Image to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct Image file'
                    },
                    error: {
                        'imageFormat': 'The image must be valid format'
                    }
                });

                $('.dropify_image').prop('data-default-file', "")

                $(".product-list").select2()
                var date = new Date();
                date.setDate(date.getDate());
                $('.product_start_date').datetimepicker({
                    format : 'YYYY-MM-DD HH:mm:ss',
                    showClose: true,
                });
                $('.product_end_date').datetimepicker({
                    format : 'YYYY-MM-DD HH:mm:ss',
                    showClose: true,
                });
            })

            dateTime(campaignStart)
            dateTime(campaignEnd)
            dateTime(productStart)
            dateTime(productEnd)

            // $('.product_code').selectize({
            //      create: true,
            //  });

        });
    </script>

@endpush
