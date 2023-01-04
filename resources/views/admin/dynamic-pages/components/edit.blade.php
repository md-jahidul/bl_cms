@extends('layouts.admin')
@section('title', 'Component')
@section('card_name', 'Component')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('other-components', [$pageId]) }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Edit</li>
@endsection
@section('action')
    <a href="{{ route('other-components', [$pageId]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('other_component_update',[$pageId, $component->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="content-body">
                                <div class="row">



                                    <div class="form-group col-md-4 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                        <label for="editor_en" class="required">Component Type</label>

                                        <select name="component_type" class="form-control" id="component_type"
                                                required data-validation-required-message="Please select component type">
                                            <option value="">--Select Data Type--</option>
                                            @foreach($componentTypes as $key => $type)
                                                <option data-alias="{{ $key }}" value="{{ $key }}" {{ ($component->component_type == $key) ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('editor_en'))
                                            <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-8 pb-2">
                                        <label>Component Sample Picture</label>
                                        <img src="{{ asset("component-images/$component->component_type.png") }}"
                                             class="img-thumbnail" id="componentImg" width="100%">
                                    </div>

                                    {{--Title Text and Image Component--}}
                                    <slot id="title_with_text_and_right_image" data-offer-type="title_with_text_and_right_image"
                                          class="{{ ($component->component_type ==  "title_with_text_and_right_image"  ) ? '' : "d-none" }}">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                        @include('layouts.partials.product-details.component.common-field.single-image')
                                    </slot>

                                    {{--Video Component--}}
                                    <slot id="title_with_video_and_text" data-offer-type="title_with_video_and_text"
                                          class="{{ ($component->component_type ==  "title_with_video_and_text"  ) ? '' : "d-none" }}">
                                        @include('layouts.partials.product-details.component.common-field.extra-title',
                                                [
                                                    'title_en' => "Video Title EN",
                                                    'title_bn' => "Video Title BN",
                                                ])
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                        @include('layouts.partials.product-details.component.common-field.video')
                                    </slot>

                                    {{--Table Component--}}
                                    <slot id="table_component" data-offer-type="table_component" class="{{ ($component->component_type ==  "table_component"  ) ? '' : "d-none" }}">
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
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
                                        @if(isset($component->componentMultiData))
                                            @foreach($component->componentMultiData as $key => $image)
                                                @include('layouts.partials.product-details.component.common-field.multiple-image', [$image, $key])
                                            @endforeach
                                        @endif
                                    </slot>

                                    {{--Customer Complains--}}
                                    <slot id="customer_complains" data-offer-type="customer_complains" class="{{ ($component->component_type ==  "customer_complains"  ) ? '' : "d-none" }}">
                                        @include('layouts.partials.product-details.component.common-field.other-attributes',
                                                [
                                                    'other_attributes' => [
                                                        'compl_cld_no' => 'Complaint Closed No (%)',
                                                        'compl_cld_title_en' => 'Complaint Closed Title EN',
                                                        'compl_cld_title_bn' => 'Complaint Closed Title BN',
                                                        'unreached_cust_no' => 'Unreached Customer No (%)',
                                                        'unreached_cust_title_en' => 'Unreached Customer Title EN',
                                                        'unreached_cust_title_bn' => 'Unreached Customer Title BN',
                                                    ],
                                                ])
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
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

{{--                            <div class="app-content">--}}
{{--                                <h3>Component Fields</h3><hr>--}}
{{--                                <div class="sidebar-right">--}}
{{--                                    <div class="sidebar">--}}
{{--                                        <div class="sidebar-content card d-none d-lg-block">--}}
{{--                                            <div class="card-body">--}}
{{--                                                <div class="category-title">--}}
{{--                                                    <h6><strong>Component Example Picture</strong></h6>--}}
{{--                                                </div>--}}
{{--                                                <hr>--}}
{{--                                                <div class="row">--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="content-left">--}}
{{--                                    <div class="content-wrapper">--}}


{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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

            // $(document).on('click', '#plus-image', function () {
            //     var option_count = $('.options-count');
            //     var total_option = option_count.length + 1;
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
            //     $('#multiple-image-field').append(input);
            //     //Call dropify Function
            //     dropify();
            // });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });

        })
    </script>

@endpush







