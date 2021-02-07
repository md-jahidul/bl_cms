@extends('layouts.admin')
@section('title', 'Component Create')
@section('card_name', 'Component Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('section-list', [$productDetailsId, $sectionId]) }}"> Section List</a></li>
    <li class="breadcrumb-item active"> <a href="{{ route('component-list', [$simType, $productDetailsId, $sectionId]) }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Create</li>
@endsection
@section('action')
    <a href="{{  route('component-list', [$simType, $productDetailsId, $sectionId]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('component-store', [$simType, $productDetailsId, $sectionId]) }}" method="POST" novalidate enctype="multipart/form-data">

                            <div class="content-body">
                                <div class="row">
                                    <div class="form-group col-md-4 {{ $errors->has('component_type') ? ' error' : '' }}">
                                        <label for="editor_en" class="required">Component Type</label>
                                        <select name="component_type" class="form-control required" id="component_type"
                                                required data-validation-required-message="Please select component type">
                                            <option value="">--Select Data Type--</option>
                                            @foreach($dataTypes as $key => $item)
                                                <option data-alias="{{ $key }}" value="{{ $key }}">{{ $item }}</option>
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


                                    {{--Large Title With Text--}}
                                    <slot id="large_title_with_text" data-offer-type="large_title_with_text" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-area')
                                    </slot>

                                    {{--Large Title With Text Button--}}
                                    <slot id="large_title_text_button" data-offer-type="large_title_text_button" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-area')
                                        @include('layouts.partials.product-details.component.common-field.button-field')
                                    </slot>

                                    {{--Medium Title With Text--}}
                                    <slot id="medium_title_with_text" data-offer-type="medium_title_with_text" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-area')
                                    </slot>

                                    {{--Small Title With Text--}}
                                    <slot id="small_title_with_text" data-offer-type="small_title_with_text" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-area')
                                    </slot>

                                    {{--Text And Button--}}
                                    <slot id="text_and_button" data-offer-type="text_and_button" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.text-area')
                                        @include('layouts.partials.product-details.component.common-field.button-field')
                                    </slot>

                                    {{--Table Component--}}
                                    <slot id="table_component" data-offer-type="large_title_with_text" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Text Component--}}
                                    <slot id="text_component" data-offer-type="text_component" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.text-area')
                                    </slot>

                                    {{--Features Component--}}
                                    <slot id="features_component" data-offer-type="features_component" class="{{ old("component_type") == 'features_component' ? '' : 'd-none' }}">
                                        @include('layouts.partials.product-details.component.common-field.title', ['title_en' => "Component (English)", 'title_bn' => 'Component (Bangla)'])

                                        <div class="form-group col-md-12 text-right">
                                            <label for="alt_text"></label>
                                            <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="features"><i class="la la-plus"></i></button>
                                        </div>

                                        <div class="form-group col-md-12 mb-0">
                                            <div class="alert alert-secondary">
                                                <strong>Feature 1</strong>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="alt_text">Feature Title (English)</label>
                                            <input type="text" name="multi_title_en[]" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="alt_text">Feature Title (Bangla)</label>
                                            <input type="text" name="multi_title_bn[]" class="form-control">
                                        </div>

                                        <input id="multi_item_count" type="hidden" name="multi_item_count" value="1">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="message">Feature Icon</label>
                                                <input type="file" class="dropify" name="base_image[]" data-height="80"/>
                                                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                            </div>
                                        </div>

{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label for="button_link" >Details (English)</label>--}}
{{--                                            <textarea name="details_en[]" rows="4" class="form-control" placeholder="Enter feature details in English"></textarea>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label for="button_link" >Details (Bangla)</label>--}}
{{--                                            <textarea name="details_bn[]" rows="4" class="form-control" placeholder="Enter feature details in Bangla"></textarea>--}}
{{--                                        </div>--}}

                                        <div class="form-group col-md-3">
                                            <label for="alt_text">Alt Text English</label>
                                            <input type="text" name="multi_alt_text_en[]" class="form-control" placeholder="Enter image alt text">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="alt_text">Alt Text Bangla</label>
                                            <input type="text" name="multi_alt_text_bn[]" class="form-control" placeholder="Enter image alt text">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="button_en">Image Name English</label>
                                            <input type="text" name="img_name_en[]"  class="form-control" placeholder="Enter company name bangla" value="">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="button_bn" >Image Name Bangla</label>
                                            <input type="text" name="img_name_bn[]"  class="form-control" placeholder="Enter company name bangla" value="">
                                        </div>

{{--                                        <div class="form-group col-md-3">--}}
{{--                                            <label for="button_en">Button Title (English)</label>--}}
{{--                                            <input type="text" name="other_attr[button_en-1]"  class="form-control" placeholder="Enter company name bangla" value="">--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group col-md-3">--}}
{{--                                            <label for="button_bn" >Button Title (Bangla)</label>--}}
{{--                                            <input type="text" name="multi_item[button_bn-1]"  class="form-control" placeholder="Enter company name bangla" value="">--}}
{{--                                        </div>--}}

                                    </slot>

                                    {{--Bullet Text--}}
                                    <slot id="bullet_text" data-offer-type="large_title_with_text" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Accordion Text--}}
                                    <slot id="accordion_text" data-offer-type="accordion_text" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Multiple Image--}}
                                    <slot id="multiple_image" data-offer-type="multiple_image" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.extra-title')
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.multiple-image')
                                    </slot>

                                    {{--Special Data Offer--}}
                                    <slot id="special_data_offer" data-offer-type="special_data_offer" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.related-product')
                                    </slot>

                                    {{--Bondho Sim Offer--}}
                                    <slot id="bondho_sim_offer" data-offer-type="bondho_sim_offer" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.related-product')
                                    </slot>

                                    {{--Startup offer--}}
                                    <slot id="startup_offer" data-offer-type="startup_offer" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.related-product')
                                    </slot>

                                    {{--Drop Down--}}
                                    <slot id="drop_down" data-offer-type="drop_down" class="d-none">
                                        <div class="form-group col-md-6 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                            <label for="editor_en" class="required" >Drop Down Data</label>
                                            <select name="other_attributes[dropdown_data_type]" class="form-control required">
                                                <option value="">--Select Dropdown Data Type--</option>
                                                {{--                                                            <option value="easy_payment_card">Easy Payment Card</option>--}}
                                                <option value="device_data_offer">Device Free Data Offer</option>
                                            </select>
                                            <div class="help-block"></div>
                                            @if ($errors->has('editor_en'))
                                                <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                            @endif
                                        </div>
                                    </slot>

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
        </div>
    </section>

    <style>
        form #related_product_field .select2-container {
            width: 100% !important;
        }
    </style>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <style>
        .note-editor.note-frame.fullscreen .note-editable {
            background-color: white;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')
    <script>
        var duplicateChecker = "{{ url('component-multiple-data') }}";
    </script>
    <script src="{{ asset('js/custom-js/component.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script src="{{ asset('js/custom-js/multi-image.js') }}" type="text/javascript"></script>


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

            // Multi Image Component
            // $(document).on('click', '#plus-image', function () {
            //     var option_count = $('.options-count');
            //     var total_option = option_count.length + 2;
            //
            //     var input = '<div class="col-md-6 col-xs-6 options-count option-'+total_option+'">\n' +
            //         '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
            //         '<div class="form-group">\n' +
            //         '      <label for="message">Multiple Image</label>\n' +
            //         '      <input type="file" class="dropify" name="multi_item[image_url-'+total_option+']" data-height="80"/>\n' +
            //         '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
            //         '  </div>\n' +
            //         ' </div>\n'+
            //         '<div class="form-group col-md-5 option-'+total_option+'">\n' +
            //         '    <label for="alt_text">Alt Text</label>\n' +
            //         '    <input type="text" name="multi_item[alt_text-'+total_option+']"  class="form-control">\n' +
            //         '</div>\n' +
            //         '<div class="form-group col-md-1 option-'+total_option+'">\n' +
            //         '   <label for="alt_text"></label>\n' +
            //         '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-'+total_option+'" ><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
            //         '</div>';
            //     $('#multiple_image').append(input);
            //     dropify();
            // });

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
                    '     <input type="text" name="multi_title_en[]" class="form-control">\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '     <label for="alt_text">Feature Title (Bangla)</label>\n' +
                    '     <input type="text" name="multi_title_bn[]" class="form-control">\n' +
                    ' </div>\n' +
                    ' <div class="col-md-12 col-xs-12 component-count option-'+total_option+'"">\n' +
                    '     <div class="form-group">\n' +
                    '         <label for="message">Feature Icon</label>\n' +
                    '         <input type="file" class="dropify" name="base_image[]" data-height="80"/>\n' +
                    '         <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                    '     </div>\n' +
                    ' </div>\n' +

                    // '<div class="form-group col-md-4 option-'+total_option+'">\n' +
                    // '     <label for="button_link" >Details (English)</label>\n' +
                    // '     <textarea name="multi_item[details_en-'+total_option+']" rows="5" class="form-control" placeholder="Enter feature details in English"></textarea>\n' +
                    // '</div>\n' +
                    // '<div class="form-group col-md-4 option-'+total_option+'">\n' +
                    // '     <label for="button_link" >Details (Bangla)</label>\n' +
                    // '     <textarea name="multi_item[details_bn-'+total_option+']" rows="5" class="form-control" placeholder="Enter feature details in Bangla"></textarea>\n' +
                    // '</div>\n' +

                    ' <div class="form-group col-md-3 option-'+total_option+'">\n' +
                    '     <label for="alt_text">Alt Text English</label>\n' +
                    '     <input type="text" name="multi_alt_text_en[]" placeholder="Enter image alt text" class="form-control">\n' +
                    ' </div>\n' +

                    ' <div class="form-group col-md-3 option-'+total_option+'">\n' +
                    '     <label for="alt_text">Alt Text Bangla</label>\n' +
                    '     <input type="text" name="multi_alt_text_bn[]" placeholder="Enter image alt text" class="form-control">\n' +
                    ' </div>\n' +

                    ' <div class="form-group col-md-3 option-'+total_option+'">\n' +
                    '     <label for="button_en">Image Name English</label>\n' +
                    '     <input type="text" name="img_name_en[]"  class="form-control" placeholder="Enter company name bangla" value="">\n' +
                    ' </div>\n' +

                    ' <div class="form-group col-md-3 option-'+total_option+'">\n' +
                    '     <label for="button_bn" >Image Name Bangla</label>\n' +
                    '     <input type="text" name="img_name_bn[]"  class="form-control" placeholder="Enter company name bangla" value="">\n' +
                    ' </div>\n' +


                    // ' <div class="form-group col-md-4 option-'+total_option+'">\n' +
                    // '     <label for="button_en">Button Title (English)</label>\n' +
                    // '     <input type="text" name="multi_item[button_en-'+total_option+']"  class="form-control" placeholder="Enter company name bangla" value="">\n' +
                    // ' </div>\n' +
                    // ' <div class="form-group col-md-4 option-'+total_option+'">\n' +
                    // '     <label for="button_bn" >Button Title (Bangla)</label>\n' +
                    // '     <input type="text" name="multi_item[button_bn-'+total_option+']"  class="form-control" placeholder="Enter company name bangla" value="">\n' +
                    // ' </div>\n' +


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

            // $('.dropify').dropify({
            //     messages: {
            //         'default': 'Browse for an Image File to upload',
            //         'replace': 'Click to replace',
            //         'remove': 'Remove',
            //         'error': 'Choose correct file format'
            //     }
            // });
        })
    </script>

@endpush
