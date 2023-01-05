@php
    $list_d = ['about-page', 'priyojon'];
    $store_d = 'about-page.component.store';
    $update_d = 'about-page.component.update';
    $action = [
        'list' => isset($listAction) ? $listAction : $list_d,
        'store' => isset($storeAction) ? $storeAction : $store_d,
        'update' => isset($updateAction) ? $updateAction : $update_d,
    ];
    if(isset($component) && $component->page_type == 'explore_c' || isset($pageType) && $pageType == 'explore_c'){

        $list = route('explore-c-component.list', ['explore_c_id' => isset($component) ? $component->section_details_id : request()->section_id]);

    }else if($action['list'][1] == 'priyojon'){

        $list =  route('about-page', 'priyojon');

    }else{

        $list = route($action['list'], [isset($component) ? $component->page_type : $pageType.'_id' => isset($component) ? $component->section_details_id : request()->section_id]);
    }

@endphp
@extends('layouts.admin')
@section('title', 'Component Create')
@section('card_name', 'Component Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ $list }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Create</li>
@endsection
@section('action')
    <a href="{{ $list }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" method="POST" novalidate enctype="multipart/form-data"
                              action="{{ isset($component) ? route($action['update'], $component->id) : route($action['store']) }}">
                            @csrf
                            <div class="content-body">
                                <div class="row">
                                    <div class="form-group col-md-4 {{ $errors->has('component_type') ? ' error' : '' }}">
                                        <label for="component_type" class="required">Component Type</label>
                                        <select name="component_type" class="form-control required" id="component_type"
                                                required data-validation-required-message="Please select component type">
                                            <option value="">--Select Data Type--</option>
                                            @foreach($componentList as $key => $data)
                                                <option data-alias="{{ $key }}" value="{{ $key }}"
                                                        {{ (isset($component) && $component->component_type == $key) ? "selected" : "" }}>{{ $data }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('component_type'))
                                            <div class="help-block">{{ $errors->first('component_type') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('component_type') ? ' error' : '' }}">
                                        <label>Component Sample Picture</label>
                                        <img class="img-thumbnail" id="componentImg" width="90%"
                                             src="{{ isset($component) ? asset('app-assets/images/app_services/'. $component->component_type . ".png") : '' }}">
                                        <div class="col-md-8">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label for="title" class="mr-1">Status:</label>
                                            <input type="radio" name="status" value="1" id="active" {{ isset($component) && $component->status == 1 ? 'checked' : '' }}>
                                            <label for="active" class="mr-1">Active</label>

                                            <input type="radio" name="status" value="0" id="inactive" {{ isset($component) && $component->status == 0 ? 'checked' : '' }}>
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>

                                    {{--Title With Text Editor--}}
                                    <slot id="title_text_editor" data-offer-type="title_text_editor"
                                          class="{{ isset($component) && $component->component_type == "title_text_editor" ? "" : "d-none" }}">
                                        @include('admin.components.partial.title_text_editor', $component ?? [])
                                    </slot>

                                    <!--Table Component-->
                                    <slot id="table_component" data-offer-type="table_component"
                                          class="{{ isset($component) && $component->component_type == "table_component" ? "" : "d-none" }}">
                                        @include('admin.components.partial.title_text_editor', $component ?? [])
                                    </slot>

                                    <!--Accordion-->
                                    <slot id="accordion_section" data-offer-type="accordion_section"
                                          class="{{ isset($component) && $component->component_type == "accordion_section" ? "" : "d-none" }}">
                                        @include('admin.components.partial.title_text_editor', $component ?? [])
                                    </slot>

                                    <!--Text Editor-->
                                    <slot id="text_editor" data-offer-type="text_editor"
                                          class="{{ isset($component) && $component->component_type == "text_editor" ? "" : "d-none" }}">
                                        @include('admin.components.partial.editor_only', $component ?? [])
                                    </slot>

                                    <!--Single Image-->
                                    <slot id="single_image" data-offer-type="single_image"
                                          class="{{ isset($component) && $component->component_type == "single_image" ? "" : "d-none" }}">
                                        @include('admin.components.partial.single_image', $component ?? [])
                                    </slot>

                                    <!--Box Content-->
                                    <slot id="box_content" data-offer-type="box_content"
                                          class="{{ isset($component) && $component->component_type == "box_content" ? "" : "d-none" }}">
                                        @include('admin.components.partial.editor_only', $component ?? [])
                                    </slot>

                                    <!--Text with image left (Box)-->
                                    <slot id="text_with_image_left_box" data-offer-type="text_with_image_left_box" class="{{ isset($component) && $component->component_type == "text_with_image_left_box" ? "" : "d-none" }}">
                                        @include('admin.components.partial.text_with_image_left_box', $component ?? [])
                                    </slot>

                                    <!--Text with image left-->
                                    <slot id="text_with_image_left" data-offer-type="text_with_image_left" class="{{ isset($component) && $component->component_type == "text_with_image_left" ? "" : "d-none" }}">
                                        @include('admin.components.partial.text_with_image_left', $component ?? [])
                                    </slot>

                                    <!--Text with image right-->
                                    <slot id="text_with_image_right" data-offer-type="text_with_image_right" class="{{ isset($component) && $component->component_type == "text_with_image_right" ? "" : "d-none" }}">
                                        @include('admin.components.partial.text_with_image_right', $component ?? [])
                                    </slot>

                                    <!--Text with image bottom-->
                                    <slot id="text_with_image_bottom" data-offer-type="text_with_image_bottom" class="{{ isset($component) && $component->component_type == "text_with_image_bottom" ? "" : "d-none" }}">
                                        @include('admin.components.partial.text_with_image_bottom', $component ?? [])
                                    </slot>

                                    <!--Multiple Text with image bottom-->
                                    <slot id="multi_text_with_image_bottom" data-offer-type="multi_text_with_image_bottom" class="{{ isset($component) && $component->component_type == "multi_text_with_image_bottom" ? "" : "d-none" }}">
                                        @include('admin.components.partial.multi_text_with_image_bottom', $component ?? [])
                                    </slot>

                                    <!--Top image with Desc-->
                                    <slot id="top_image_with_desc" data-offer-type="top_image_with_desc" class="{{ isset($component) && $component->component_type == "top_image_with_desc" ? "" : "d-none" }}">
                                        @include('admin.components.partial.top_image_with_desc', $component ?? [])
                                    </slot>

                                    <!--Left Image with Title, Desc, btn-->
                                    <slot id="left_image_with_title_desc_btn" data-offer-type="left_image_with_title_desc_btn" class="{{ isset($component) && $component->component_type == "left_image_with_title_desc_btn" ? "" : "d-none" }}">
                                        @include('admin.components.partial.left_image_with_title_desc_btn', $component ?? [])
                                    </slot>

                                    <!--masonry_1_2_image_layout_col-->
                                    <slot id="masonry_1_2_image_layout_col" data-offer-type="masonry_1_2_image_layout_col" class="{{ isset($component) && $component->component_type == "masonry_1_2_image_layout_col" ? "" : "d-none" }}">
                                        @include('admin.components.partial.masonry_1_2_image_layout_col', $component ?? [])
                                    </slot>

                                    <slot id="masonry_3_2_image_layout_row" data-offer-type="masonry_3_2_image_layout_row" class="{{ isset($component) && $component->component_type == "masonry_3_2_image_layout_row" ? "" : "d-none" }}">
                                        @include('admin.components.partial.masonry_3_2_image_layout_row', $component ?? [])
                                    </slot>

                                    <!--Multi Column With title and desc-->
                                    <slot id="multi_col_with_title_desc" data-offer-type="multi_col_with_title_desc" class="{{ isset($component) && $component->component_type == "multi_col_with_title_desc" ? "" : "d-none" }}">
                                        @include('admin.components.partial.multi_col_with_title_desc', $component ?? [])
                                    </slot>

                                    <!--Multi Column With title, desc and Image -->
                                    <slot id="multi_col_with_title_desc_image" data-offer-type="multi_col_with_title_desc_image" class="{{ isset($component) && $component->component_type == "multi_col_with_title_desc_image" ? "" : "d-none" }}">
                                        @include('admin.components.partial.multi_col_with_title_desc_image', $component ?? [])
                                    </slot>

{{--                                    --}}{{--Slider text with image right--}}
{{--                                    <slot id="slider_text_with_image_right" data-offer-type="slider_text_with_image_right" class="{{ isset($component) && $component->component_type == "accordion_section" ? "" : "d-none" }}">--}}
{{--                                        @include('admin.app-service.details.section.component_modal.slider.slider_text_with_image_right')--}}
{{--                                    </slot>--}}

{{--                                    --}}{{--Video with text right--}}
{{--                                    <slot id="video_with_text_right" data-offer-type="video_with_text_right" class="{{ isset($component) && $component->component_type == "accordion_section" ? "" : "d-none" }}">--}}
{{--                                        @include('admin.app-service.details.section.component_modal.video_with_text_right')--}}
{{--                                    </slot>--}}

{{--                                    --}}{{--Multiple image banner--}}
{{--                                    <slot id="multiple_image_banner" data-offer-type="multiple_image_banner" class="{{ isset($component) && $component->component_type == "accordion_section" ? "" : "d-none" }}">--}}
{{--                                        @include('admin.app-service.details.section.component_modal.multi_banner.multiple_image_banner')--}}
{{--                                    </slot>--}}

{{--                                    --}}{{--Pricing Multiple table--}}
{{--                                    <slot id="pricing_sections" data-offer-type="pricing_sections" class="{{ isset($component) && $component->component_type == "accordion_section" ? "" : "d-none" }}">--}}
{{--                                        @include('admin.app-service.details.section.component_modal.pricing_sections_create')--}}
{{--                                    </slot>--}}

{{--                                    --}}{{--static_easy_payment_card--}}
{{--                                    <slot id="static_easy_payment_card" data-offer-type="static_easy_payment_card" class="{{ isset($component) && $component->component_type == "accordion_section" ? "" : "d-none" }}">--}}
{{--                                        @include('admin.app-service.details.section.component_modal.static_easy_payment_card')--}}
{{--                                    </slot>--}}




                                    {{ Form::hidden('sections[id]', isset($component) ? $component->section_details_id : request()->section_id ?? null, ['class' => 'section_id'] ) }}
                                    {{ Form::hidden('component[0][id]', null, ['class' => 'component_id'] ) }}

                                    <div class="form-actions col-md-12">
                                        <div class="pull-right">
                                            <input type="hidden" name="save">
                                            <button type="submit" id="save" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> Save
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
    <style>
        .note-editor.note-frame.fullscreen .note-editable {
            background-color: white;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/component.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

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


            $('#component_type').on('change', function () {
                var componentType = this.value + ".png"
                var fullUrl = "{{ asset('app-assets/images/app_services') }}/" + componentType;
                $("#componentImg").attr('src', fullUrl)
            })

        })
    </script>
@endpush
