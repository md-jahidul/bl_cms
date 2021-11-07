@extends('layouts.admin')
@section('title', 'Component')
@section('card_name', 'Component')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{  url("app-service/details/$tab_type/$product_id") }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Edit</li>
@endsection
@section('action')
{{--    <a href="{{  route('component-list', [$simType, $productDetailsId, $sectionId]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
{{--                            @method('put')--}}

                            <div class="content-body">
                                <div class="row">
                                    <div class="form-group col-md-4 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                        <label for="editor_en" class="required">Component Type</label>
                                        <select name="component_type" class="form-control" id="component_type"
                                                {{--required data-validation-required-message="Please select component type"--}}>
                                            <option value="">--Select Data Type--</option>
                                            @foreach($componentTypes as $key => $type)
                                                <option data-alias="{{ $key }}" value="{{ $key }}" {{ ($section['sections']->section_type == $key) ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('editor_en'))
                                            <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-8 pb-2">
                                        <label>Component Sample Picture</label>
                                        <img src="{{ asset("app-assets/images/app_services"). "/" . $section['sections']->section_type.".png" }}" class="img-thumbnail" id="componentImg" width="100%">
                                    </div>


                                    {{--Title With Text Editor--}}
                                    <slot id="title_text_editor" data-offer-type="title_text_editor" class="{{ ($section['sections']->section_type ==  "title_text_editor"  ) ? '' : "d-none" }}">
                                        @include('admin.app-service.details.section.component_modal.title_text_editor')
                                    </slot>

                                    {{--Accordion--}}
                                    <slot id="accordion_section" data-offer-type="accordion_section" class="{{ ($section['sections']->section_type ==  "accordion_section"  ) ? '' : "d-none" }}">
                                        @include('admin.app-service.details.section.component_modal.accordion.accordion')
                                    </slot>

                                    {{--Text with image right--}}
                                    <slot id="text_with_image_right" data-offer-type="text_with_image_right" class="{{ ($section['sections']->section_type ==  "text_with_image_right"  ) ? '' : "d-none" }}">
                                        @include('admin.app-service.details.section.component_modal.text_with_image_right')
                                    </slot>

                                    {{--Text with image bottom--}}
                                    <slot id="text_with_image_bottom" data-offer-type="text_with_image_bottom" class="{{ ($section['sections']->section_type ==  "text_with_image_bottom"  ) ? '' : "d-none" }}">
                                        @include('admin.app-service.details.section.component_modal.text_with_image_bottom')
                                    </slot>

                                    {{--Slider text with image right--}}
                                    <slot id="slider_text_with_image_right" data-offer-type="slider_text_with_image_right" class="{{ ($section['sections']->section_type ==  "slider_text_with_image_right"  ) ? '' : "d-none" }}">
{{--                                        @include('admin.app-service.details.section.component_modal.slider.slider_text_with_image_right')--}}
{{--                                        @include('admin.app-service.details.section.component_modal.slider.edit_slider_text_with_image_right')--}}
{{--                                        @include('admin.app-service.details.section.component_modal.slider.single_item_edit_slider_text_with_image_right')--}}


                                        @if(isset($component->componentMultiData))
                                            @foreach($component->componentMultiData as $key => $image)
                                                <h3><strong>Slider {{ $key+1 }}</strong></h3>
                                                <div class="form-actions col-md-12 mt-0"></div>
                                                <div class="form-group col-md-6">
                                                    <label for="alt_text">Short Description En</label>
                                                    <input type="text" name="details_en[]" class="form-control img-data"
                                                           value="{{ isset($image['details_en']) ? $image['details_en'] : '' }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="alt_text">Short Description Bn</label>
                                                    <input type="text" name="details_bn[]" class="form-control img-data"
                                                           value="{{ isset($image['details_bn']) ? $image['details_bn'] : '' }}">
                                                </div>
                                                @include('layouts.partials.product-details.component.common-field.multiple-image', [$image, $key])
                                            @endforeach
                                        @endif
                                    </slot>

                                    {{--Multiple image--}}
                                    <slot id="multiple_image_banner" data-offer-type="multiple_image_banner" class="{{ ($section['sections']->section_type ==  "multiple_image_banner"  ) ? '' : "d-none" }}">
                                        @if(isset($component->componentMultiData))
{{--                                            {{ dd($component->componentMultiData) }}--}}
                                            @foreach($component->componentMultiData as $key => $image)
                                                @include('layouts.partials.product-details.component.common-field.multiple-image', [$image, $key])
                                            @endforeach
                                        @endif
                                    </slot>

                                    {{--Video with text right--}}
                                    <slot id="video_with_text_right" data-offer-type="video_with_text_right" class="{{ ($section['sections']->section_type ==  "video_with_text_right"  ) ? '' : "d-none" }}">
                                        @include('admin.app-service.details.section.component_modal.video_with_text_right')
                                    </slot>

                                    {{--static_easy_payment_card--}}
                                    <slot id="static_easy_payment_card" data-offer-type="static_easy_payment_card" class="{{ ($section['sections']->section_type ==  "static_easy_payment_card"  ) ? '' : "d-none" }}">
                                        @include('admin.app-service.details.section.component_modal.static_easy_payment_card')
                                    </slot>


                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label for="title" class="mr-1">Status:</label>
                                            <input type="radio" name="sections[status]" value="1" id="active" {{ $section['sections']->status == 1 ? 'checked' : '' }}>
                                            <label for="active" class="mr-1">Active</label>

                                            <input type="radio" name="sections[status]" value="0" id="inactive" {{ $section['sections']->status == 0 ? 'checked' : '' }}>
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>

{{--                                    {{ dd($section['sections']->status) }}--}}


                                    {{ Form::hidden('sections[id]', $component->section_details_id, ['class' => 'section_id'] ) }}
                                    {{ Form::hidden('component[0][id]', $component->id, ['class' => 'component_id'] ) }}

                                    <div class="form-actions col-md-12">
                                        <div class="pull-right">
                                            <input type="hidden" name="update">
                                            <button type="submit" id="save" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Update
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

    <style>
        form #related_product_field .select2-container {
            width: 100% !important;
        }
    </style>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <style>
        .note-editor.note-frame.fullscreen .note-editable {
            background-color: white;
        }
    </style>
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
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
                height: 100
            });
        })



    </script>

@endpush







