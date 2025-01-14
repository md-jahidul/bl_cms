@extends('layouts.admin')
@section('title', 'Component Create')
@section('card_name', 'Component Create')
@section('breadcrumb')
{{--    <li class="breadcrumb-item active"> <a href="{{ route('section-list', [$productDetailsId, $sectionId]) }}"> Section List</a></li>--}}
{{--    <li class="breadcrumb-item active"> <a href="{{ route('component-list', [$simType, $productDetailsId, $sectionId]) }}"> Component List</a></li>--}}
{{--    <li class="breadcrumb-item active"> Component Create</li>--}}
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
                            <div class="content-body">
                                <div class="row">
                                    {{ Form::hidden('sections[section_name]', 'Title with Text Editor' ) }}
                                    {{ Form::hidden('sections[section_type]', 'title_text_editor' ) }}
                                    {{ Form::hidden('sections[tab_type]', $tab_type ) }}
                                    {{ Form::hidden('sections[category]', 'component_sections' ) }}
                                    {{ Form::hidden('component[0][component_type]', 'title_text_editor' ) }}

                                    <div class="form-group col-md-4 {{ $errors->has('component_type') ? ' error' : '' }}">
                                        <label for="editor_en" class="required">Component Type</label>
                                        <select {{--name="component_type"--}} class="form-control required" id="component_type"
                                                required data-validation-required-message="Please select component type">
                                            <option value="">--Select Data Type--</option>
                                            <option data-alias="title_text_editor" value="title_text_editor">Title with text editor</option>
                                            <option data-alias="accordion_section" value="accordion_section">Accordion</option>
                                            <option data-alias="text_with_image_right" value="text_with_image_right">Text with image right</option>
                                            <option data-alias="text_with_image_bottom" value="text_with_image_bottom">Text with image bottom</option>
                                            <option data-alias="slider_text_with_image_right" value="slider_text_with_image_right">Slider text with image right</option>
                                            <option data-alias="video_with_text_right" value="video_with_text_right">Video with text right</option>
                                            <option data-alias="multiple_image_banner" value="multiple_image_banner">Multiple image banner</option>
                                            <option data-alias="pricing_sections" value="pricing_sections">Pricing Multiple table</option>
                                            <option data-alias="static_easy_payment_card" value="static_easy_payment_card">Static Component - Easy payment card</option>
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


                                    {{--Title With Text Editor--}}
                                    <slot id="title_text_editor" data-offer-type="title_text_editor" class="d-none">
                                        @include('admin.app-service.details.section.component_modal.title_text_editor')
                                    </slot>

                                    {{--Accordion--}}
                                    <slot id="accordion_section" data-offer-type="accordion_section" class="d-none">
                                        @include('admin.app-service.details.section.component_modal.accordion.accordion')
                                    </slot>

                                    {{--Text with image right--}}
                                    <slot id="text_with_image_right" data-offer-type="text_with_image_right" class="d-none">
                                        @include('admin.app-service.details.section.component_modal.text_with_image_right')
                                    </slot>

                                    {{--Text with image bottom--}}
                                    <slot id="text_with_image_bottom" data-offer-type="text_with_image_bottom" class="d-none">
                                        @include('admin.app-service.details.section.component_modal.text_with_image_bottom')
                                    </slot>

                                    {{--Slider text with image right--}}
                                    <slot id="slider_text_with_image_right" data-offer-type="slider_text_with_image_right" class="d-none">
                                        @include('admin.app-service.details.section.component_modal.slider.slider_text_with_image_right')
                                    </slot>

                                    {{--Video with text right--}}
                                    <slot id="video_with_text_right" data-offer-type="video_with_text_right" class="d-none">
                                        @include('admin.app-service.details.section.component_modal.video_with_text_right')
                                    </slot>

                                    {{--Multiple image banner--}}
                                    <slot id="multiple_image_banner" data-offer-type="multiple_image_banner" class="d-none">
                                        @include('admin.app-service.details.section.component_modal.multi_banner.multiple_image_banner')
                                    </slot>

                                    {{--Pricing Multiple table--}}
                                    <slot id="pricing_sections" data-offer-type="pricing_sections" class="d-none">
                                        @include('admin.app-service.details.section.component_modal.pricing_sections_create')
                                    </slot>

                                    {{--static_easy_payment_card--}}
                                    <slot id="static_easy_payment_card" data-offer-type="static_easy_payment_card" class="d-none">
                                        @include('admin.app-service.details.section.component_modal.static_easy_payment_card')
                                    </slot>


                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label for="title" class="mr-1">Status:</label>
                                            <input type="radio" name="sections[status]" value="1" id="active" checked>
                                            <label for="active" class="mr-1">Active</label>

                                            <input type="radio" name="sections[status]" value="0" id="inactive">
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>

                                    {{ Form::hidden('sections[id]', null, ['class' => 'section_id'] ) }}
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
