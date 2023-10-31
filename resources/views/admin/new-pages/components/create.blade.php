@extends('layouts.admin')
@section('title', 'Component Create')
@section('card_name', 'Component Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('pages') }}"> Page List</a></li>
    <li class="breadcrumb-item active"> <a href="{{ route('page-components', [$pageId]) }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Create</li>
@endsection
@section('action')
{{--    <a href="{{  route('component-list', [$simType, $productDetailsId, $sectionId]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form role="form" id="product_form" action="{{ route('page-components-store-or-update', $pageId) }}" method="POST" novalidate enctype="multipart/form-data">
                            <input type="hidden" name="pageId" value="{{ $pageId }}">

                            <div class="content-body">
                                <div class="row">
                                    <div class="form-group col-md-4 {{ $errors->has('component_type') ? ' error' : '' }}">
                                        <label for="editor_en" class="required">Component Type</label>
                                        <select name="component_type" class="form-control required" id="component_type"
                                                required data-validation-required-message="Please select component type">
                                            <option value="">--Select Component Type--</option>
                                            @foreach($componentTypes as $key => $item)
                                                <option data-alias="{{ $key }}" value="{{ $key }}">{{ $item['title'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('component_type'))
                                            <div class="help-block">{{ $errors->first('component_type') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-8 pb-2">
                                        <label>Component Sample Picture</label>
                                        <img class="img-thumbnail" id="componentImg" width="100%">
                                    </div>
                                </div>
                                <div class="row">
                                    <slot id="component_data"></slot>
                                </div>

                                    {{--Table Component--}}
{{--                                    <slot id="table_component" data-offer-type="large_title_with_text" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                    </slot>--}}

{{--                                     Title Text and Image Component --}}
{{--                                    <slot id="banner_with_button" data-offer-type="banner_with_button" class="{{ old("component_type") == 'banner_with_button' ? '' : 'd-none' }}">--}}
{{--                                        @include('admin.new-pages.components.common-field.title')--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                        @include('admin.new-pages.components.common-field.single-image')--}}
{{--                                    </slot>--}}

{{--                                    hovering_card_component--}}
{{--                                    <slot id="hovering_card_component" data-offer-type="hovering_card_component" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.title')--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                        @include('admin.new-pages.components.common-field.multiple-image', [--}}
{{--                                            'component_type' => 'hovering_card_component',--}}
{{--                                            'key' => 0--}}
{{--                                        ])--}}
{{--                                    </slot>--}}

{{--                                    card_with_bg_color_component--}}
{{--                                    <slot id="card_with_bg_color_component" data-offer-type="card_with_bg_color_component" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.title')--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                        @include('admin.new-pages.components.common-field.multiple-image', [--}}
{{--                                            'component_type' => 'card_with_bg_color_component',--}}
{{--                                            'key' => 0--}}
{{--                                        ])--}}
{{--                                    </slot>--}}

{{--                                    hiring_now_component--}}
{{--                                    <slot id="hiring_now_component" data-offer-type="hiring_now_component" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.title')--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                        @include('admin.new-pages.components.common-field.single-image')--}}
{{--                                        @include('admin.new-pages.components.common-field.button-field')--}}
{{--                                    </slot>--}}

{{--                                    top_image_card_with_button--}}
{{--                                    <slot id="top_image_card_with_button" data-offer-type="top_image_card_with_button" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.title')--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                        @include('admin.new-pages.components.common-field.multiple-image', ['component_type' => 'top_image_card_with_button', 'key' => 0])--}}
{{--                                    </slot>--}}

{{--                                    galley_masonry--}}
{{--                                    <slot id="galley_masonry" data-offer-type="galley_masonry" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.title')--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                        @include('admin.new-pages.components.common-field.multiple-image', ['component_type' => 'galley_masonry', 'key' => 0])--}}
{{--                                    </slot>--}}











                                    {{--Video Component--}}
{{--                                    <slot id="title_with_video_and_text" data-offer-type="title_with_video_and_text" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.extra-title',--}}
{{--                                                [--}}
{{--                                                    'title_en' => "Video Title EN",--}}
{{--                                                    'title_bn' => "Video Title BN",--}}
{{--                                                ])--}}
{{--                                        @include('admin.new-pages.components.common-field.title')--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                        @include('admin.new-pages.components.common-field.video')--}}
{{--                                    </slot>--}}

{{--                                    --}}{{--Bullet Text--}}
{{--                                    <slot id="bullet_text" data-offer-type="large_title_with_text" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.title')--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                    </slot>--}}

{{--                                    --}}{{--Accordion Text--}}
{{--                                    <slot id="accordion_text" data-offer-type="accordion_text" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.title')--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                    </slot>--}}
{{--                                    --}}

{{--                                    --}}{{--Customer Complains--}}
{{--                                    <slot id="customer_complaint" data-offer-type="customer_complaint" class="d-none">--}}
{{--                                        @include('admin.new-pages.components.common-field.other-attributes',--}}
{{--                                                [--}}
{{--                                                    'other_attributes' => [--}}
{{--                                                        'compl_cld_no' => 'Complaint Closed No (%)',--}}
{{--                                                        'compl_cld_title_en' => 'Complaint Closed Title EN',--}}
{{--                                                        'compl_cld_title_bn' => 'Complaint Closed Title BN',--}}
{{--                                                        'unreached_cust_no' => 'Unreached Customer No (%)',--}}
{{--                                                        'unreached_cust_title_en' => 'Unreached Customer Title EN',--}}
{{--                                                        'unreached_cust_title_bn' => 'Unreached Customer Title BN',--}}
{{--                                                    ],--}}
{{--                                                ])--}}
{{--                                        @include('admin.new-pages.components.common-field.text-editor')--}}
{{--                                    </slot>--}}
{{--                                    --}}{{--button_component--}}
{{--                                    <slot id="button_component" data-offer-type="button_component" class="d-none">--}}

{{--                                        @include('admin.new-pages.components.common-field.title')--}}

{{--                                        @include('admin.new-pages.components.common-field.other-attributes',--}}
{{--                                                [--}}
{{--                                                    'other_attributes' => [--}}
{{--                                                        /*'url_en' => 'Url EN',--}}
{{--                                                        'url_bn' => 'Url BN',*/--}}
{{--                                                    ],--}}
{{--                                                ])--}}



{{--                                        <div class="form-group col-md-6 {{ $errors->has('redirect_url_en') ? ' error' : '' }} {{ (isset($component) && $component->other_attributes['is_external_url'] ?? 0 == 0) ? '' : (!isset($component) ? '' : 'd-none') }}" id="pageDynamicEn">--}}
{{--                                            <label for="redirect_url_en">Redirect URL EN</label>--}}
{{--                                            <input type="text" name="other_attr[redirect_url_en]" class="form-control" placeholder="Enter URL"--}}
{{--                                                value="{{ isset($component) ? $component->other_attributes['redirect_url_en'] : '' }}">--}}
{{--                                            <div class="help-block"></div>--}}
{{--                                            @if ($errors->has('redirect_url_en'))--}}
{{--                                                <div class="help-block">  {{ $errors->first('redirect_url_en') }}</div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-6 {{ $errors->has('redirect_url_bn') ? ' error' : '' }} {{ (isset($component) && $component->other_attributes['is_external_url'] ?? 0 == 0) ? '' : (!isset($component) ? '' : 'd-none') }}" id="pageDynamicBn">--}}
{{--                                            <label for="redirect_url_bn">Redirect URL BN</label>--}}
{{--                                            <input type="text" name="other_attr[redirect_url_bn]" class="form-control" placeholder="Enter URL"--}}
{{--                                                value="{{ isset($component) ? $component->other_attributes['redirect_url_bn'] : '' }}">--}}
{{--                                            <div class="help-block"></div>--}}
{{--                                            @if ($errors->has('redirect_url_bn'))--}}
{{--                                                <div class="help-block">  {{ $errors->first('redirect_url_bn') }}</div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}



{{--                                        <div class="form-group col-md-6 {{ $errors->has('external_url') ? ' error' : '' }} {{ (isset($component) && $component->other_attributes['is_external_url'] ?? 1 == 1) ? '' : 'd-none' }}" id="externalLink">--}}
{{--                                            <label for="external_url">External URL</label>--}}
{{--                                            <input type="text" name="other_attr[external_url]" class="form-control" placeholder="Enter URL"--}}
{{--                                                value="{{ isset($component) ? $component->other_attributes['external_url'] : '' }}">--}}
{{--                                            <div class="help-block"></div>--}}
{{--                                            @if ($errors->has('external_url'))--}}
{{--                                                <div class="help-block">  {{ $errors->first('external_url') }}</div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6 mt-1">--}}
{{--                                            <label></label>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="external_link">Is External Link:</label>--}}
{{--                                                <input type="checkbox" name="other_attr[is_external_url]" value="1" id="external_link"--}}
{{--                                                    {{ (isset($component) && $component->other_attributes['is_external_url'] ?? 1 == 1) ? 'checked' : (old("is_external_url") ? 'checked' : '') }}>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


{{--                                    </slot>--}}
                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label for="title" class="mr-1">Status:</label>
                                            <input type="radio" name="status" value="1" id="active" checked>
                                            <label for="active" class="mr-1">Active</label>

                                            <input type="radio" name="status" value="0" id="inactive">
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>

                                    <div class="form-actions col-md-12">
                                        <div class="pull-right">
                                            <button type="submit" id="save" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        form #related_product_field .select2-container {
            width: 100% !important;
        }

        .type-line {
            border-top: 1px solid #0a0e45 !important;
        }
    </style>
@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote-lite.min.css') }}">--}}

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">



@endpush
@push('page-js')
{{--    <script src="{{ asset('js/custom-js/component.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('js/custom-js/page-component.js') }}" type="text/javascript"></script>
{{--    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>--}}
{{--    <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>--}}

    <script src="{{ asset('app-assets/vendors/js/editors/summernote_0.8.18/summernote-lite.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote_0.8.18/summernote-table-headers.js') }}" type="text/javascript"></script>

{{--    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

{{--    <script src="{{ asset('js/custom-js/page-multi-item.js') }}" type="text/javascript"></script>--}}


    <script>
        $(function () {
            $('#component_type').on('change', function () {
                var componentType = this.value + ".png"
                var fullUrl = "{{ asset('component-images') }}/" + componentType;
                $("#componentImg").attr('src', fullUrl)
            })

            function dropify(){
                $('.dropify').dropify({
                    messages: {
                        'default': 'Browse for an Image File to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct file format'
                    }
                });
            }
            dropify();

            $("textarea#details").summernote({
                popover: {
                    toolbar: [
                        ['style', ['style'],['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['table', ['table']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen', 'codeview']]
                    ],

                    table: [
                        ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                        ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                        ['custom', ['tableHeaders']]
                    ],
                },
                height:150
            })

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });

            // Multi Feature Component
            $(document).on('click', '#features', function () {
                var option_count = $('.component-count');
                var total_option = option_count.length + 2;

                var FeatureInput = '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
                    ' <div class="form-group col-md-12 mb-0 option-'+total_option+'">\n' +
                    '     <div class="alert alert-secondary">\n' +
                    '         <strong>Feature '+total_option+'</strong>\n' +
                    '     </div>\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '     <label for="alt_text">Feature Title (English)</label>\n' +
                    '     <input type="text" name="multi_item[feature_title_en-'+total_option+']" class="form-control">\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '     <label for="alt_text">Feature Title (Bangla)</label>\n' +
                    '     <input type="text" name="multi_item[feature_title_bn-'+total_option+']" class="form-control">\n' +
                    ' </div>\n' +
                    ' <div class="col-md-12 col-xs-12 component-count option-'+total_option+'"">\n' +
                    '     <div class="form-group">\n' +
                    '         <label for="message">Feature Icon</label>\n' +
                    '         <input type="file" class="dropify" name="multi_item[image_url-'+total_option+']" data-height="80"/>\n' +
                    '         <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                    '     </div>\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-4 option-'+total_option+'">\n' +
                    '     <label for="alt_text">Alt Text</label>\n' +
                    '     <input type="text" name="multi_item[alt_text-'+total_option+']" placeholder="Enter image alt text" class="form-control">\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-4 option-'+total_option+'">\n' +
                    '     <label for="button_en">Button Title (English)</label>\n' +
                    '     <input type="text" name="multi_item[button_en-'+total_option+']"  class="form-control" placeholder="Enter company name bangla" value="">\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-4 option-'+total_option+'">\n' +
                    '     <label for="button_bn" >Button Title (Bangla)</label>\n' +
                    '     <input type="text" name="multi_item[button_bn-'+total_option+']"  class="form-control" placeholder="Enter company name bangla" value="">\n' +
                    ' </div>\n' +
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '     <label for="button_link" >Details (English)</label>\n' +
                    '     <textarea name="multi_item[details_en-'+total_option+']" rows="5" class="form-control" placeholder="Enter feature details in English"></textarea>\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '     <label for="button_link" >Details (Bangla)</label>\n' +
                    '     <textarea name="multi_item[details_bn-'+total_option+']" rows="5" class="form-control" placeholder="Enter feature details in Bangla"></textarea>\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-1 option-'+total_option+'">\n' +
                    '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-'+total_option+'" ><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
                    '</div>';
                $('#features_component').append(FeatureInput);
                dropify();
            });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            //External Link
            $('#external_link').click(function () {
                var externalLink = $('#externalLink');
                var pageDynamicEn = $('#pageDynamicEn');
                var pageDynamicBn = $('#pageDynamicBn');

                if($(this).prop("checked") == true){
                    externalLink.removeClass('d-none');
                    pageDynamicEn.addClass('d-none');
                    pageDynamicBn.addClass('d-none');
                }else{
                    pageDynamicEn.removeClass('d-none');
                    pageDynamicBn.removeClass('d-none');
                    externalLink.addClass('d-none');
                }
            });




        })
    </script>

@endpush







