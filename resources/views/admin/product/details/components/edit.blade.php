@extends('layouts.admin')
@section('title', 'Component')
@section('card_name', 'Component')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{  route('component-list', [$simType, $productDetailsId, $sectionId]) }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Edit</li>
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
                        <form role="form" id="product_form" action="{{ route('component-update',[$simType, $productDetailsId, $sectionId, $component->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="app-content">
                                <h3>Component Fields</h3><hr>
                                <div class="sidebar-right">
                                    <div class="sidebar">
                                        <div class="sidebar-content card d-none d-lg-block">
                                            <div class="card-body">
                                                <div class="category-title">
                                                    <h6><strong>Component Example Picture</strong></h6>
                                                </div>
                                                <hr>
                                                <div class="row">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-left">
                                    <div class="content-wrapper">

                                        <div class="content-body">
                                            <div class="row">

                                                <div class="form-group col-md-12 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                                    <label for="editor_en" class="required">Component Type</label>

                                                    <select name="component_type" class="form-control" id="component_type"
                                                            required data-validation-required-message="Please select component type">
                                                        <option value="">--Select Data Type--</option>
                                                        @foreach($dataTypes as $key => $type)
                                                            <option data-alias="{{ $key }}" value="{{ $key }}" {{ ($component->component_type == $key) ? 'selected' : '' }}>{{ $type }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('editor_en'))
                                                        <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                                    @endif
                                                </div>


                                                {{--Large Title With Text--}}
                                                <slot id="large_title_with_text" data-offer-type="large_title_with_text" class="{{ ($component->component_type ==  "large_title_with_text") ?  ''  : 'd-none' }}">
                                                    @include('layouts.partials.product-details.component.common-field.title')
                                                    @include('layouts.partials.product-details.component.common-field.text-area')
                                                </slot>

                                                {{--Large Title With Text Button--}}
                                                <slot id="large_title_text_button" data-offer-type="large_title_text_button" class="{{ ($component->component_type ==  "large_title_text_button"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.title')
                                                    @include('layouts.partials.product-details.component.common-field.text-area')
                                                    @include('layouts.partials.product-details.component.common-field.button-field')
                                                </slot>

                                                {{--Medium Title With Text--}}
                                                <slot id="medium_title_with_text" data-offer-type="medium_title_with_text" class="{{ ($component->component_type ==  "medium_title_with_text"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.title')
                                                    @include('layouts.partials.product-details.component.common-field.text-area')
                                                </slot>

                                                {{--Small Title With Text--}}
                                                <slot id="small_title_with_text" data-offer-type="small_title_with_text" class="{{ ($component->component_type ==  "small_title_with_text"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.title')
                                                    @include('layouts.partials.product-details.component.common-field.text-area')
                                                </slot>

                                                {{--Text And Button--}}
                                                <slot id="text_and_button" data-offer-type="text_and_button" class="{{ ($component->component_type ==  "text_and_button"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.text-area')
                                                    @include('layouts.partials.product-details.component.common-field.button-field')
                                                </slot>

                                                {{--Table Component--}}
                                                <slot id="table_component" data-offer-type="large_title_with_text" class="{{ ($component->component_type ==  "table_component"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.text-editor')
                                                </slot>

                                                {{--Text Component--}}
                                                <slot id="text_component" data-offer-type="text_component" class="{{ ($component->component_type ==  "text_component"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.text-area')
                                                </slot>

                                                {{--Features Component--}}
                                                <slot id="features_component" data-offer-type="features_component" class="{{ ($component->component_type ==  "features_component"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.title', ['title_en' => "Component (English)", 'title_bn' => 'Component (Bangla)'])
                                                    <div class="form-group col-md-12 text-right">
                                                        <label for="alt_text"></label>
                                                        <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="features"><i class="la la-plus"></i></button>
                                                    </div>
                                                @php( $i = 0 )
                                                @if(isset($multipleImage))
                                                    @foreach($multipleImage as $key => $image)
                                                        @php($i++)

                                                        <div class="form-group col-md-12 mb-0">
                                                            <div class="alert alert-secondary">
                                                                <strong>Feature {{$i}}</strong>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6 component_count">
                                                            <label for="alt_text">Feature Title (English)</label>
                                                            <input type="text" name="multi_item[feature_title_en-{{$i}}]" class="form-control" value="{{ isset($image['feature_title_en']) ? $image['feature_title_en'] : null }}">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="alt_text">Feature Title (Bangla)</label>
                                                            <input type="text" name="multi_item[feature_title_bn-{{$i}}]" class="form-control" value="{{ isset($image['feature_title_bn']) ? $image['feature_title_bn'] : null }}">
                                                        </div>

                                                        <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$i}}">

                                                        <div class="col-md-12 col-xs-12 option-{{ $i }}">
                                                            <div class="form-group">
                                                                <label for="message">Multiple Image</label>
                                                                <input type="file" class="dropify" name="multi_item[image_url-{{ $i }}]"
                                                                       data-default-file="{{ config('filesystems.file_base_url') . $image['image_url'] }}"
                                                                       data-height="80"/>
                                                                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6 option-{{ $i }}">
                                                            <label for="alt_text">Alt Text</label>
                                                            <input type="text" name="multi_item[alt_text-{{ $i }}]" value="{{ $image['alt_text'] }}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="button_en">Button Title (English)</label>
                                                            <input type="text" name="multi_item[button_en-{{ $i }}]"  class="form-control" placeholder="Enter company name bangla" value="{{ $image['button_en'] }}">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="button_bn" >Button Title (Bangla)</label>
                                                            <input type="text" name="multi_item[button_bn-{{ $i }}]"  class="form-control" placeholder="Enter company name bangla" value="{{ $image['button_bn'] }}">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="button_link" >Button URL</label>
                                                            <input type="text" name="multi_item[button_link-{{ $i }}]"  class="form-control" placeholder="Enter company name bangla" value="{{ $image['button_link'] }}">
                                                        </div>

{{--                                                        @if($i == 1)--}}
{{--                                                            <div class="form-group col-md-1">--}}
{{--                                                                <label for="alt_text"></label>--}}
{{--                                                                <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>--}}
{{--                                                            </div>--}}
{{--                                                            --}}{{-- @else--}}
{{--                                                            --}}{{-- <div class="form-group col-md-1 option-{{ $i }}">--}}
{{--                                                            --}}{{--     <label for="alt_text"></label>--}}
{{--                                                            --}}{{--     <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-{{ $i }}" ><i data-id="option-{{ $i }}" class="la la-trash"></i></button>--}}
{{--                                                            --}}{{-- </div>--}}
{{--                                                        @endif--}}
                                                    @endforeach
                                                @endif
                                                </slot>

                                                {{--Bullet Text--}}
                                                <slot id="bullet_text" data-offer-type="large_title_with_text" class="{{ ($component->component_type ==  "bullet_text"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.title')
                                                    @include('layouts.partials.product-details.component.common-field.text-editor')
                                                </slot>

                                                {{--Accordion Text--}}
                                                <slot id="accordion_text" data-offer-type="accordion_text" class="{{ ($component->component_type ==  "accordion_text"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.title')
                                                    @include('layouts.partials.product-details.component.common-field.text-editor')
                                                </slot>

                                                {{--Multiple Image--}}
                                                <slot id="multiple_image" data-offer-type="multiple_image" class="{{ ($component->component_type ==  "multiple_image"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.extra-title')
                                                    @include('layouts.partials.product-details.component.common-field.title')
                                                    @php( $i = 0 )
                                                    @if(isset($multipleImage))
                                                            @foreach($multipleImage as $key => $image)
                                                                @php($i++)
                                                            <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$i}}">
                                                            <div class="col-md-6 col-xs-6 option-{{ $i }} options-count">
                                                                <div class="form-group">
                                                                    <label for="message">Multiple Image</label>
                                                                    <input type="file" class="dropify" name="multi_item[image_url-{{ $i }}]"
                                                                           data-default-file="{{ config('filesystems.file_base_url') . $image['image_url'] }}"
                                                                           data-height="80"/>
                                                                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-5 option-{{ $i }}">
                                                                <label for="alt_text">Alt Text</label>
                                                                <input type="text" name="multi_item[alt_text-{{ $i }}]" value="{{ $image['alt_text'] }}" class="form-control">
                                                            </div>

                                                            @if($i == 1)
                                                                <div class="form-group col-md-1">
                                                                    <label for="alt_text"></label>
                                                                    <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
                                                                </div>
{{--                                                            @else--}}
{{--                                                                <div class="form-group col-md-1 option-{{ $i }}">--}}
{{--                                                                    <label for="alt_text"></label>--}}
{{--                                                                    <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-{{ $i }}" ><i data-id="option-{{ $i }}" class="la la-trash"></i></button>--}}
{{--                                                                </div>--}}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </slot>

                                                {{--Special Data Offer--}}
                                                <slot id="special_data_offer" data-offer-type="special_data_offer" class="{{ ($component->component_type ==  "special_data_offer"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.title')
                                                    @include('layouts.partials.product-details.component.common-field.related-product')
                                                </slot>

                                                {{--Bondho Sim Offer--}}
                                                <slot id="bondho_sim_offer" data-offer-type="bondho_sim_offer" class="{{ ($component->component_type ==  "bondho_sim_offer"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.related-product')
                                                </slot>

                                                {{--Startup offer--}}
                                                <slot id="startup_offer" data-offer-type="startup_offer" class="{{ ($component->component_type ==  "startup_offer"  ) ? '' : "d-none" }}">
                                                    @include('layouts.partials.product-details.component.common-field.related-product')
                                                </slot>

                                                <slot id="drop_down" data-offer-type="drop_down" class="{{ ($component->component_type ==  "drop_down"  ) ? '' : "d-none" }}">
                                                    <div class="form-group col-md-6">
                                                        <label for="editor_bn" class="text-success">Drop Down Sample Picture</label>
                                                        <img class=" img-fluid" src="{{ asset('sample-images/drop_down.png') }}" alt="Image description">
                                                    </div>

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
                                                        <input type="radio" name="status" value="1" id="active" {{ $component->status == 1 ? 'checked' : '' }}>
                                                        <label for="active" class="mr-1">Active</label>

                                                        <input type="radio" name="status" value="0" id="inactive" {{ $component->status == 0 ? 'checked' : '' }}>
                                                        <label for="inactive">Inactive</label>
                                                    </div>
                                                </div>

                                                <div class="form-actions col-md-12">
                                                    <div class="pull-right">
                                                        <button type="submit" id="save" class="btn btn-primary"><i
                                                                class="la la-check-square-o"></i> Update
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
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

<style>
    form #related_product_field .select2-container {
        width: 100% !important;
    }
</style>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">



@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/component.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script>
        $(function () {

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
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    // ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                height:200
            })

            $(document).on('click', '#plus-image', function () {
                var option_count = $('.options-count');
                var total_option = option_count.length + 1;

                var input = '<div class="col-md-6 col-xs-6 options-count option-'+total_option+'">\n' +
                    '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
                    '<div class="form-group">\n' +
                    '      <label for="message">Multiple Image</label>\n' +
                    '      <input type="file" class="dropify" name="multi_item[image_url-'+total_option+']" data-height="80"/>\n' +
                    '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                    '  </div>\n' +
                    ' </div>\n'+
                    '<div class="form-group col-md-5 option-'+total_option+'">\n' +
                    '    <label for="alt_text">Alt Text</label>\n' +
                    '    <input type="text" name="multi_item[alt_text-'+total_option+']"  class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-1 option-'+total_option+'">\n' +
                    '   <label for="alt_text"></label>\n' +
                    '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-'+total_option+'" ><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
                    '</div>';
                $('#multiple-image-field').append(input);
                //Call dropify Function
                dropify();
            });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });

            // Multi Feature Component
            $(document).on('click', '#features', function () {
                var option_count = $('.component_count');
                var total_option = option_count.length + 1;

                var FeatureInput = '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
                    ' <div class="form-group col-md-12 mb-0 option-'+total_option+'">\n' +
                    '     <div class="alert alert-secondary">\n' +
                    '         <strong>Feature '+total_option+'</strong>\n' +
                    '     </div>\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-6 component_count option-'+total_option+'">\n' +
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
                    ' <div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '     <label for="alt_text">Alt Text</label>\n' +
                    '     <input type="text" name="multi_item[alt_text-'+total_option+']" class="form-control">\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '     <label for="button_en">Button Title (English)</label>\n' +
                    '     <input type="text" name="multi_item[button_en-'+total_option+']"  class="form-control" placeholder="Enter company name bangla" value="">\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '     <label for="button_bn" >Button Title (Bangla)</label>\n' +
                    '     <input type="text" name="multi_item[button_bn-'+total_option+']"  class="form-control" placeholder="Enter company name bangla" value="">\n' +
                    ' </div>\n' +
                    ' <div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '     <label for="button_link" >Button URL</label>\n' +
                    '     <input type="text" name="multi_item[button_link-'+total_option+']"  class="form-control" placeholder="Enter company name bangla" value="">\n' +
                    ' </div>\n' +
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

        })
    </script>

@endpush







