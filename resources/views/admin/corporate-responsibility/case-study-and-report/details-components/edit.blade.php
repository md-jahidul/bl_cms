@extends('layouts.admin')
@section('title', 'Case Study Detail Component')
@section('card_name', 'Case Study Detail Component')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('case-study-details.index', $sectionComId) }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Edit</li>
@endsection
@section('action')
    <a href="{{ route('case-study-details.index', $sectionComId) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('case-study-details.update',[$sectionComId, $component->id]) }}" method="POST" novalidate enctype="multipart/form-data">
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

                                    {{--Card Component--}}
                                    <slot id="card_component" data-offer-type="card_component" class="{{ ($component->component_type ==  "card_component"  ) ? '' : "d-none" }}">
                                        @php( $i = 0 )
                                        @if(isset($multipleItems))
                                            @foreach($multipleItems as $key => $item)
                                                @php($i++)

                                                <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$i}}">
                                                <div class="form-group col-md-12 mb-0 option-{{ $i }} options-count">
                                                    <h3 class="text-primary"><strong>Card {{$i}}</strong></h3>
                                                    <hr class="mt-0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="top_text">Top Text En</label>
                                                    <input type="text" name="multi_item[top_text_en-{{ $i }}]" value="{{ isset($item['top_text_en']) ? $item['top_text_en'] : '' }}"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label for="top_text">Top Text Bn</label>
                                                    <input type="text" name="multi_item[top_text_bn-{{ $i }}]" class="form-control"
                                                           value="{{ isset($item['top_text_bn']) ? $item['top_text_bn'] : '' }}">
                                                </div>

                                                @if($i == 1)
                                                    <div class="form-group col-md-1">
                                                        <label for="alt_text"></label>
                                                        <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
                                                    </div>
                                                    {{-- @else--}}
                                                    {{--     <div class="form-group col-md-1 option-{{ $i }}">--}}
                                                    {{--         <label for="alt_text"></label>--}}
                                                    {{--         <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-{{ $i }}" ><i data-id="option-{{ $i }}" class="la la-trash"></i></button>--}}
                                                    {{-- </div>--}}
                                                @endif

                                                <div class="form-group col-md-6">
                                                    <label for="middle_text">Middle Text En</label>
                                                    <input type="text" name="multi_item[middle_text_en-{{ $i }}]" class="form-control"
                                                           value="{{ isset($item['middle_text_en']) ? $item['middle_text_en'] : '' }}">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="middle_text">Middle Text Bn</label>
                                                    <input type="text" name="multi_item[middle_text_bn-{{ $i }}]" class="form-control"
                                                           value="{{ isset($item['middle_text_bn']) ? $item['middle_text_bn'] : '' }}">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="bottom_text">Bottom Text En</label>
                                                    <input type="text" name="multi_item[bottom_text_en-{{ $i }}]" class="form-control"
                                                           value="{{ isset($item['bottom_text_en']) ? $item['bottom_text_en'] : '' }}">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="bottom_text">Bottom Text Bn</label>
                                                    <input type="text" name="multi_item[bottom_text_bn-{{ $i }}]" class="form-control"
                                                           value="{{ isset($item['bottom_text_bn']) ? $item['bottom_text_bn'] : '' }}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="bottom_text">Card Color</label>
                                                    <input type="color" name="multi_item[card_color-{{ $i }}]" class="form-control"
                                                           value="{{ isset($item['card_color']) ? $item['card_color'] : '' }}">
                                                </div>
                                            @endforeach
                                        @endif
                                    </slot>

                                    {{--Order List--}}
                                    <slot id="order_list" data-offer-type="order_list"
                                          class="{{ ($component->component_type ==  "order_list"  ) ? '' : "d-none" }}">
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Text Component--}}
                                    <slot id="text_component" data-offer-type="text_component"
                                          class="{{ ($component->component_type ==  "text_component"  ) ? '' : "d-none" }}">
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Large Title And Image With Text Button--}}
                                    <slot id="large_title_and_image_with_text" data-offer-type="large_title_and_image_with_text"
                                          class="{{ ($component->component_type ==  "large_title_and_image_with_text"  ) ? '' : "d-none" }}">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.single-image')
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Medium Title With Text--}}
                                    <slot id="medium_title_with_text" data-offer-type="medium_title_with_text"
                                          class="{{ ($component->component_type == "medium_title_with_text"  ) ? '' : "d-none" }}">
                                        @include('layouts.partials.product-details.component.common-field.title')
                                        @include('layouts.partials.product-details.component.common-field.text-editor')
                                    </slot>

                                    {{--Small Title With Text--}}
                                    <slot id="small_title_with_text" data-offer-type="small_title_with_text"
                                          class="{{ ($component->component_type ==  "small_title_with_text"  ) ? '' : "d-none" }}">
                                        @include('layouts.partials.product-details.component.common-field.title')
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

            // Multi Card Component
            $(document).on('click', '#plus-image', function () {
                var option_count = $('.options-count');
                var total_option = option_count.length + 1;

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

        })
    </script>

@endpush







