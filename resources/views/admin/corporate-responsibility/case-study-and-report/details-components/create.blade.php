@extends('layouts.admin')
@section('title', 'Component Create')
@section('card_name', 'Component Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('case-study-details.index', [$sectionComId]) }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Create</li>
@endsection
@section('action')
    <a href="{{  route('case-study-details.index', [$sectionComId]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form role="form" id="product_form" action="{{ route('case-study-details.store', [$sectionComId]) }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="content-body">
                                <div class="row">
                                    <div class="form-group col-md-4 {{ $errors->has('component_type') ? ' error' : '' }}">
                                        <label for="editor_en" class="required">Component Type</label>
                                        <select name="component_type" class="form-control required" id="component_type"
                                                required data-validation-required-message="Please select component type">
                                            <option value="">--Select Component Type--</option>
                                            @foreach($componentTypes as $key => $item)
                                                <option data-alias="{{ $key }}" value="{{ $key }}" {{ old("component_type") == $key ? 'selected' : '' }}>{{ $item }}</option>
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

                                    {{--Text Component--}}
                                    <slot id="text_component" data-offer-type="text_component" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Order List--}}
                                    <slot id="order_list" data-offer-type="order_list" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>


                                    {{--Card Component--}}
                                    <slot id="card_component" data-offer-type="card_component" class="d-none">
                                        <input id="multi_item_count" type="hidden" name="multi_item_count" value="1">
                                        <div class="form-group col-md-12 mb-0">
                                            <h3 class="text-primary"><strong>Card 1</strong></h3>
                                            <hr class="mt-0">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="top_text">Top Text En</label>
                                            <input type="text" name="multi_item[top_text_en-1]" class="form-control">
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="top_text">Top Text Bn</label>
                                            <input type="text" name="multi_item[top_text_bn-1]" class="form-control">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <label></label>
                                            <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="middle_text">Middle Text En</label>
                                            <input type="text" name="multi_item[middle_text_en-1]" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="middle_text">Middle Text Bn</label>
                                            <input type="text" name="multi_item[middle_text_bn-1]" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="bottom_text">Bottom Text En</label>
                                            <input type="text" name="multi_item[bottom_text_en-1]" class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="bottom_text">Bottom Text Bn</label>
                                            <input type="text" name="multi_item[bottom_text_bn-1]" class="form-control">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="bottom_text">Card Color</label>
                                            <input type="color" name="multi_item[card_color-1]" class="form-control">
                                        </div>
                                    </slot>

                                    {{--Large Title And Image With Text Button--}}
                                    <slot id="large_title_and_image_with_text" data-offer-type="large_title_and_image_with_text"
                                          class="{{ old("component_type") == 'large_title_and_image_with_text' ? '' : 'd-none' }}">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.single-image')
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Medium Title With Text--}}
                                    <slot id="medium_title_with_text" data-offer-type="medium_title_with_text" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Small Title With Text--}}
                                    <slot id="small_title_with_text" data-offer-type="small_title_with_text" class="d-none">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
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
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote-lite.min.css') }}">--}}

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">



@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/component.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
{{--    <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>--}}

    <script src="{{ asset('app-assets/vendors/js/editors/summernote_0.8.18/summernote-lite.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote_0.8.18/summernote-table-headers.js') }}" type="text/javascript"></script>




    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


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


            // Basic TineMCE


            // Multi Image Component
            $(document).on('click', '#plus-image', function () {
                var option_count = $('.options-count');
                var total_option = option_count.length + 2;

                var input =
                    '<div class="form-group options-count col-md-12 mb-0 option-'+total_option+'">\n' +
                    '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
                    ' <h3 class="text-primary"><strong>Card '+total_option+'</strong></h3>\n' +
                    '  <hr class="mt-0">\n' +
                    '</div>\n'+


                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="top_text">Top Text En</label>\n' +
                    '    <input type="text" name="multi_item[top_text_en-'+total_option+']" class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-5 option-'+total_option+'">\n' +
                    '    <label for="top_text">Top Text Bn</label>\n' +
                    '    <input type="text" name="multi_item[top_text_bn-'+total_option+']" class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-1 option-'+total_option+'">\n' +
                    '   <label></label>\n' +
                    '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-'+total_option+'" ><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
                    '</div>\n' +

                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="middle_text">Middle Text En</label>\n' +
                    '    <input type="text" name="multi_item[middle_text_en-'+total_option+']" class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="middle_text">Middle Text Bn</label>\n' +
                    '    <input type="text" name="multi_item[middle_text_bn-'+total_option+']" class="form-control">\n' +
                    '</div>\n' +

                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="bottom_text">Bottom Text En</label>\n' +
                    '    <input type="text" name="multi_item[bottom_text_en-'+total_option+']" class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="bottom_text">Bottom Text Bn</label>\n' +
                    '    <input type="text" name="multi_item[bottom_text_bn-'+total_option+']" class="form-control">\n' +
                    '</div>\n'+

                    '<div class="form-group col-md-12 option-'+total_option+'">\n' +
                    '    <label for="bottom_text">Card Color</label>\n' +
                    '    <input type="color" name="multi_item[card_color-'+total_option+']" class="form-control">\n' +
                    '</div>\n'
                ;
                $('#card_component').append(input);
                dropify();
            });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
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
        })
    </script>

@endpush







