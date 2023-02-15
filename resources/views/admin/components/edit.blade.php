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
                                                required data-validation-required-message="Please select component type" disabled>
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

                                    {{-- Need to work here. we use the condition here because of duplicate field replaced the field's value for explore C's component  --}}

                                    @if (isset($component) && $component->page_type != 'explore_c' || isset($pageType) && $pageType != 'explore_c')

                                        <!--Top image with caption-->
                                        <slot id="top_image_with_caption" data-offer-type="top_image_with_caption" class="{{ isset($component) && $component->component_type == "top_image_with_caption" ? "" : "d-none" }}">
                                            @include('admin.components.partial.top_image_with_caption', $component ?? [])
                                        </slot>
                                        <!--Top image with Title, caption and Desc-->
                                        <slot id="top_image_with_title_caption_desc" data-offer-type="top_image_with_title_caption_desc" class="{{ isset($component) && $component->component_type == "top_image_with_title_caption_desc" ? "" : "d-none" }}">
                                            @include('admin.components.partial.top_image_with_title_caption_desc', $component ?? [])
                                        </slot>

                                        <!--Top image with Desc-->
                                        <slot id="top_image_with_desc" data-offer-type="top_image_with_desc" class="{{ isset($component) && $component->component_type == "top_image_with_desc" ? "" : "d-none" }}">
                                            @include('admin.components.partial.top_image_with_desc', $component ?? [])
                                        </slot>

                                        <!--Left Image with Title, Desc, btn-->
                                        <slot id="left_image_with_title_desc_btn" data-offer-type="left_image_with_title_desc_btn" class="{{ isset($component) && $component->component_type == "left_image_with_title_desc_btn" ? "" : "d-none" }}">
                                            @include('admin.components.partial.left_image_with_title_desc_btn', $component ?? [])
                                        </slot>

                                        @if($component->component_type == "right_image_with_title_desc_btn")
                                            <!--Right Image with Title, Desc, btn-->
                                            <slot id="right_image_with_title_desc_btn" data-offer-type="right_image_with_title_desc_btn" class="{{ isset($component) && $component->component_type == "right_image_with_title_desc_btn" ? "" : "d-none" }}">
                                                @include('admin.components.partial.right_image_with_title_desc_btn', $component ?? [])
                                            </slot>
                                        @endif

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

                                    @endif

                                    @if (isset($component) && $component->page_type == 'other_dynamic_page' || isset($pageType) && $pageType == 'other_dynamic_page')

                                        <!--Multi Column For Video-->
                                        <slot id="multi_col_for_video" data-offer-type="multi_col_for_video" class="{{ isset($component) && $component->component_type == "multi_col_for_video" ? "" : "d-none" }}">
                                            @include('admin.components.partial.multi_col_for_video', $component ?? [])
                                        </slot>
                                        <!--Multi Column For Video middle-->
                                        <slot id="multi_col_for_video_middle" data-offer-type="multi_col_for_video_middle" class="{{ isset($component) && $component->component_type == "multi_col_for_video_middle" ? "" : "d-none" }}">
                                            @include('admin.components.partial.multi_col_for_video_middle', $component ?? [])
                                        </slot>
                                        <!--Multi Column With title, desc and Icon -->
                                        <slot id="multi_col_with_title_desc_icon" data-offer-type="multi_col_with_title_desc_icon" class="{{ isset($component) && $component->component_type == "multi_col_with_title_desc_icon" ? "" : "d-none" }}">
                                            @include('admin.components.partial.multi_col_with_title_desc_icon', $component ?? [])
                                        </slot>
                                        <!--Multi card With title, desc and Icon -->
                                        <slot id="multi_card_with_title_desc_icon" data-offer-type="multi_card_with_title_desc_icon" class="{{ isset($component) && $component->component_type == "multi_card_with_title_desc_icon" ? "" : "d-none" }}">
                                            @include('admin.components.partial.multi_card_with_title_desc_icon', $component ?? [])
                                        </slot>
                                        <!--Customer Complains-->
                                        <slot id="customer_complaint" data-offer-type="customer_complaint" class="{{ isset($component) && $component->component_type == "customer_complaint" ? "" : "d-none" }}">
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
                                        <!--button_component-->
                                        <slot id="button_component" data-offer-type="button_component" class="{{ isset($component) && $component->component_type == "button_component" ? "" : "d-none" }}">

                                            @include('layouts.partials.product-details.component.common-field.title')

                                            @include('layouts.partials.product-details.component.common-field.other-attributes',
                                                    [
                                                        'other_attributes' => [
                                                            /*'url_en' => 'Url EN',
                                                            'url_bn' => 'Url BN',*/
                                                        ],
                                                    ])

                                            <div class="form-group col-md-6 {{ $errors->has('redirect_url_en') ? ' error' : '' }} {{ (isset($component) && optional($component->other_attributes)['is_external_url']  == 0) ? '' : (!isset($component) ? '' : 'd-none') }}" id="pageDynamicEn">
                                                <label for="redirect_url_en">Redirect URL EN</label>
                                                <input type="text" name="other_attr[redirect_url_en]" class="form-control" placeholder="Enter URL"
                                                       value="{{ isset($component) ? optional($component->other_attributes)['redirect_url_en'] : '' }}">
                                                <div class="help-block"></div>
                                                @if ($errors->has('redirect_url_en'))
                                                    <div class="help-block">  {{ $errors->first('redirect_url_en') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6 {{ $errors->has('redirect_url_bn') ? ' error' : '' }} {{ (isset($component) && optional($component->other_attributes)['is_external_url'] == 0) ? '' : (!isset($component) ? '' : 'd-none') }}" id="pageDynamicBn">
                                                <label for="redirect_url_bn">Redirect URL BN</label>
                                                <input type="text" name="other_attr[redirect_url_bn]" class="form-control" placeholder="Enter URL"
                                                       value="{{ isset($component) ? optional($component->other_attributes)['redirect_url_bn'] : '' }}">
                                                <div class="help-block"></div>
                                                @if ($errors->has('redirect_url_bn'))
                                                    <div class="help-block">  {{ $errors->first('redirect_url_bn') }}</div>
                                                @endif
                                            </div>



                                            <div class="form-group col-md-6 {{ $errors->has('external_url') ? ' error' : '' }} {{ (isset($component) && optional($component->other_attributes)['is_external_url'] == 1) ? '' : 'd-none' }}" id="externalLink">
                                                <label for="external_url">External URL</label>
                                                <input type="text" name="other_attr[external_url]" class="form-control" placeholder="Enter URL"
                                                       value="{{ isset($component) ? optional($component->other_attributes)['external_url'] : '' }}">
                                                <div class="help-block"></div>
                                                @if ($errors->has('external_url'))
                                                    <div class="help-block">  {{ $errors->first('external_url') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-md-6 mt-1">
                                                <label></label>
                                                <div class="form-group">
                                                    <label for="external_link">Is External Link:</label>
                                                    <input type="checkbox" name="other_attr[is_external_url]" value="1" id="external_link"
                                                        {{ (isset($component) && optional($component->other_attributes)['is_external_url']  == 1) ? 'checked' : (old("other_attr.is_external_url") ? 'checked' : '') }}>
                                                </div>
                                            </div>


                                        </slot>

                                        <!--Multiple Image-->
                                        <slot id="multiple_image" data-offer-type="multiple_image" class="{{ isset($component) && $component->component_type == "multiple_image" ? "" : "d-none" }}">
                                            @include('layouts.partials.product-details.component.common-field.extra-title')
                                            @include('layouts.partials.product-details.component.common-field.title')


                                            @include('admin.components.partial.multiple_image', $component ?? [])
                                        </slot>

                                        <!--Video Component-->
                                        <slot id="title_with_video_and_text" data-offer-type="title_with_video_and_text" class="{{ isset($component) && $component->component_type == "title_with_video_and_text" ? "" : "d-none" }}">
                                            @include('layouts.partials.product-details.component.common-field.extra-title',
                                                    [
                                                        'title_en' => "Video Title EN",
                                                        'title_bn' => "Video Title BN",
                                                    ])
                                            @include('layouts.partials.product-details.component.common-field.title')
                                            @include('layouts.partials.product-details.component.common-field.text-editor')
                                            @include('layouts.partials.product-details.component.common-field.video')
                                        </slot>
                                    @endif


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
            /*$('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
                height: 100
            });
            */

            $('#component_type').on('change', function () {
                var componentType = this.value + ".png"
                var fullUrl = "{{ asset('app-assets/images/app_services') }}/" + componentType;
                $("#componentImg").attr('src', fullUrl)
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
