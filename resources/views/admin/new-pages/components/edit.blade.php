@extends('layouts.admin')
@section('title', 'Component')
@section('card_name', 'Component')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('page-components', [$pageId]) }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Edit</li>
@endsection
@section('action')
    <a href="{{ route('page-components', [$pageId]) }}" class="btn btn-warning  btn-glow px-2"><i
            class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form"
                              action="{{ route('page-components-store-or-update',[$pageId, $component->id]) }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <input type="hidden" name="pageId" value="{{ $pageId }}">
                            <div class="content-body">
                                <div class="row">
                                    <div class="form-group col-md-9 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                        <label for="editor_en" class="required">Component Type</label>
                                        <select disabled readonly class="form-control" id="component_type"
                                                required
                                                data-validation-required-message="Please select component type">
                                            <option value="">--Select Data Type--</option>
                                            @foreach($componentTypes as $key => $type)
                                                <option data-alias="{{ $key }}"
                                                        value="{{ $key }}" {{ ($component->type == $key) ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="component_type" value="{{ $component->type }}">
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="col-md-3">
                                        <img src="{{ asset("page-component-image/$component->type.png") }}"
                                             class="img-thumbnail" id="componentImg" width="100%">
                                    </div>

                                    {{-- banner_with_button --}}
                                    @if($component->type == "banner_with_button")
                                        <slot id="banner_with_button" data-offer-type="banner_with_button">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Config"])
                                            <div class="form-group col-md-9">
                                                <label for="editor_en" class="required">Position</label>
                                                <select name="config[position]" class="form-control">
                                                    <option value="">--Select Position--</option>
                                                    <option value="right" {{ $component->config['position'] == "right" ? 'selected' : '' }}>Right</option>
                                                    <option value="bottom" {{ $component->config['position'] == "bottom" ? 'selected' : '' }}>Bottom</option>
                                                </select>
                                            </div>

                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'banner_with_button',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--hovering_card_component--}}
                                    @if($component->type == "hovering_card_component")
                                        <slot id="hovering_card_component" data-offer-type="hovering_card_component">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'hovering_card_component',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--card_with_bg_color_component--}}
                                    @if($component->type == "card_with_bg_color_component")
                                        <slot id="card_with_bg_color_component"
                                              data-offer-type="card_with_bg_color_component">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'card_with_bg_color_component',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--hiring_now_component--}}
                                    @if($component->type == "hiring_now_component")
                                        <slot id="hiring_now_component" data-offer-type="hiring_now_component">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Config"])
                                            <div class="form-group col-md-3">
                                                <label for="is_ookla">Is Ookla</label>
                                                <select name="config[is_ookla]" class="form-control">
                                                    <option value="yes" {{ $component->config['is_ookla'] == "yes" ? 'selected' : '' }}>Yes</option>
                                                    <option value="no" {{ $component->config['is_ookla'] == "no" ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Component Items"])
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @include('admin.new-pages.components.common-field.attribute.image')
                                            @include('admin.new-pages.components.common-field.attribute.image', [
                                                'label' => "Background Image",
                                                'fieldName' => "bg_img",
                                                'dataField' => "bg_image"
                                            ])
                                            @include('admin.new-pages.components.common-field.attribute.double-button')
                                            @include('admin.new-pages.components.common-field.attribute.bg-color')
                                        </slot>
                                    @endif

                                    {{--top_image_card_with_button--}}
                                    @if($component->type == "top_image_card_with_button")
                                        <slot id="top_image_card_with_button"
                                              data-offer-type="top_image_card_with_button">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Config"])
                                            <div class="form-group col-md-6">
                                                <label for="editor_en">Position</label>
                                                <select name="config[slider_action]" class="form-control">
                                                    <option value="">--Select Position--</option>
                                                    <option value="navigation" {{ $component->config['slider_action'] == "navigation" ? 'selected' : '' }}>Navigation</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="editor_en">Component Type</label>
                                                <select name="config[component_type]" class="form-control">
                                                    <option value="fixed" {{ $component->config['component_type'] == "fixed" ? 'selected' : '' }}>Fixed Card</option>
                                                    <option value="slider" {{ $component->config['component_type'] == "slider" ? 'selected' : '' }}>Slider Card</option>
                                                </select>
                                            </div>

                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'top_image_card_with_button',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--step_cards_with_hovering_effect --}}
                                    @if($component->type == "step_cards_with_hovering_effect")
                                        <slot id="step_cards_with_hovering_effect"
                                              data-offer-type="step_cards_with_hovering_effect">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @include('admin.new-pages.components.common-field.attribute.button')
                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'step_cards_with_hovering_effect',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--galley_masonry--}}
                                    @if($component->type == "galley_masonry")
                                        <slot id="galley_masonry" data-offer-type="galley_masonry">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Config"])
                                            <div class="form-group col-md-9">
                                                <label for="editor_en" class="required">Position</label>
                                                <select name="config[slider_action]" class="form-control">
                                                    <option value="">--Select Position--</option>
                                                    <option value="navigation" {{ $component->config['slider_action'] == "navigation" ? 'selected' : '' }}>Navigation</option>
                                                    <option value="pagination" {{ $component->config['slider_action'] == "pagination" ? 'selected' : '' }}>Pagination</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group mt-2">
                                                    <label for="gray_scale"></label><br>
                                                    <input type="checkbox" name="config[gray_scale]" value="1" id="gray_scale"
                                                        {{ isset($component->config['gray_scale']) && $component->config['gray_scale'] == "1" ? 'checked' : '' }}>
                                                    <label for="gray_scale" class="ml-1"> <strong>Gray Scale</strong></label><br>
                                                </div>
                                            </div>
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Top Section"])
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @include('admin.new-pages.components.common-field.attribute.button')

                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'galley_masonry',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--hero_section--}}
                                    @if($component->type == "hero_section")
                                        <slot id="hero_section" data-offer-type="hero_section">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @include('admin.new-pages.components.common-field.attribute.image')
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Breadcrumbs"])

                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)

                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'hero_section',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
{{--                                            @else--}}
{{--                                                @include('admin.new-pages.components.common-field.repeatable-item', [--}}
{{--                                                     'component_type' => 'hero_section',--}}
{{--                                                     'data' => [],--}}
{{--                                                     'key' => 0--}}
{{--                                                 ])--}}
                                            @endif
                                        </slot>
                                    @endif

                                    {{--text_component--}}
                                    @if($component->type == "text_component")
                                        <slot id="text_component" data-offer-type="text_component">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Config"])
                                            <div class="form-group col-md-2">
                                                <label for="editor_en" class="required">Is Accordion</label>
                                                <select name="config[is_accordion]" class="form-control">
                                                    <option value="yes" {{ isset($component->config['is_accordion']) ?? $component->config['is_accordion'] == "yes" ? 'selected' : '' }}>Yes</option>
                                                    <option value="no" {{ isset($component->config['is_accordion']) ?? $component->config['is_accordion'] == "no" ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Details Section"])
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => true])
                                        </slot>
                                    @endif

                                    {{--text_with_image--}}
                                    @if($component->type == "text_with_image")
                                        <slot id="text_with_image" data-offer-type="text_with_image">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Config"])
                                            <div class="form-group col-md-3">
                                                <label for="editor_en" class="required">Position</label>
                                                <select name="config[position]" class="form-control">
                                                    <option value="right" {{ $component->config['position'] == "right" ? 'selected' : '' }}>Right</option>
                                                    <option value="left" {{ $component->config['position'] == "left" ? 'selected' : '' }}>Left</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="bg_color">Background Color</label>
                                                <select name="config[bg_color]" class="form-control">
                                                    <option value="yes" {{ $component->config['bg_color'] == "yes" ? 'selected' : '' }}>Yes</option>
                                                    <option value="no" {{ $component->config['bg_color'] == "no" ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="vertical_txt_align">Vertical Text Align</label>
                                                <select name="config[vertical_txt_align]" class="form-control">
                                                    <option value="yes" {{ $component->config['bg_color'] == "yes" ? 'selected' : '' }}>Yes</option>
                                                    <option value="no" {{ $component->config['bg_color'] == "no" ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => "Config"])
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.attribute.image')
                                            @include('admin.new-pages.components.common-field.attribute.double-button')
                                        </slot>
                                    @endif

                                    {{--hero_section--}}
                                    @if($component->type == "top_image_bottom_text_component")
                                        <slot id="top_image_bottom_text_component" data-offer-type="top_image_bottom_text_component">
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'top_image_bottom_text_component',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
{{--                                            @else--}}
{{--                                                @include('admin.new-pages.components.common-field.repeatable-item', [--}}
{{--                                                     'component_type' => 'top_image_bottom_text_component',--}}
{{--                                                     'data' => [],--}}
{{--                                                     'key' => 0--}}
{{--                                                 ])--}}
                                            @endif
                                        </slot>
                                    @endif

                                    {{--icon_text_component--}}
                                    @if($component->type == "icon_text_component")
                                        <slot id="icon_text_component" data-offer-type="hero_section">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.multi-item.divider')
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'icon_text_component',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
{{--                                            @else--}}
{{--                                                @include('admin.new-pages.components.common-field.repeatable-item', [--}}
{{--                                                     'component_type' => 'icon_text_component',--}}
{{--                                                     'data' => [],--}}
{{--                                                     'key' => 0--}}
{{--                                                 ])--}}
                                            @endif
                                        </slot>
                                    @endif

                                    {{--icon_text_component--}}
                                    @if($component->type == "icon_text_with_bg_component")
                                        <slot id="icon_text_with_bg_component" data-offer-type="icon_text_with_bg_component">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.multi-item.divider')
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'icon_text_with_bg_component',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
{{--                                            @else--}}
{{--                                                @include('admin.new-pages.components.common-field.repeatable-item', [--}}
{{--                                                     'component_type' => 'icon_text_with_bg_component',--}}
{{--                                                     'data' => [],--}}
{{--                                                     'key' => 0--}}
{{--                                                 ])--}}
                                            @endif
                                        </slot>
                                    @endif

                                    {{--video_full_width_component--}}
                                    @if($component->type == "video_full_width_component")
                                        <slot id="video_full_width_component" data-offer-type="video_full_width_component">
                                            @include('admin.new-pages.components.common-field.attribute.video-url')
                                        </slot>
                                    @endif

                                    {{--text_with_image--}}
                                    @if($component->type == "video_with_text_container_component")
                                        <slot id="video_with_text_container_component" data-offer-type="video_with_text_container_component">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.attribute.video-url')
                                        </slot>
                                    @endif

                                    {{--icon_text_component--}}
                                    @if($component->type == "stories_slider")
                                        <slot id="stories_slider" data-offer-type="stories_slider">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'stories_slider',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @else
                                                @include('admin.new-pages.components.common-field.repeatable-item', [
                                                     'component_type' => 'stories_slider',
                                                     'data' => [],
                                                     'key' => 0
                                                 ])
                                            @endif
                                        </slot>
                                    @endif

                                    <!--tab_component_with_image_card_one-->
                                    @if($component->type == "tab_component_with_image_card_one")
                                        <slot id="tab_component_with_image_card_one" data-offer-type="tab_component_with_image_card_one">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'tab_component_with_image_card_one',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    <!--tab_component_with_image_card_two-->
                                    @if($component->type == "tab_component_with_image_card_two")
                                        <slot id="tab_component_with_image_card_two" data-offer-type="tab_component_with_image_card_two">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'tab_component_with_image_card_two',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    <!--tab_component_with_image_card_three-->
                                    @if($component->type == "tab_component_with_image_card_three")
                                        <slot id="tab_component_with_image_card_three" data-offer-type="tab_component_with_image_card_three">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'tab_component_with_image_card_three',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    <!--tab_component_with_image_card_four-->
                                    @if($component->type == "tab_component_with_image_card_four")
                                        <slot id="tab_component_with_image_card_four" data-offer-type="tab_component_with_image_card_four">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description')
                                            @if(isset($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'tab_component_with_image_card_four',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--explore_c--}}
                                    @if($component->type == "explore_c")
                                        <slot id="explore_c" data-offer-type="explore_c">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => 'Config'])
                                            @include('admin.new-pages.components.common-field.config.bg-image')
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => 'Component Info'])
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'explore_c',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--explore_services--}}
                                    @if($component->type == "explore_services")
                                        <slot id="explore_services" data-offer-type="explore_services">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.multi-item.divider')
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'explore_services',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--Super App--}}
                                    @if($component->type == "super_app")
                                        <slot id="super_app" data-offer-type="super_app">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => 'Config'])
                                            @include('admin.new-pages.components.common-field.config.bg-image')
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => 'Component Info'])
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.attribute.image')
                                            @include('admin.new-pages.components.common-field.attribute.play-store-link')
                                            @include('admin.new-pages.components.common-field.attribute.app-store-link')
                                        </slot>
                                    @endif

                                    {{--Amar_offer--}}
                                    @if($component->type == "amar_offer")
                                        <slot id="amar_offer" data-offer-type="amar_offer">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                        </slot>
                                    @endif

                                    {{--Loyalty Offer--}}
                                    @if($component->type == "loyalty_offer")
                                        <slot id="loyalty_offer" data-offer-type="loyalty_offer">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                        </slot>
                                    @endif

                                    {{--digital_world--}}
                                    @if($component->type == "digital_world")
                                        <slot id="digital_world" data-offer-type="digital_world">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => 'Component Heading'])
                                            @include('admin.new-pages.components.common-field.attribute.button')
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.multi-item.divider')
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'digital_world',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--bl_lab--}}
                                    @if($component->type == "bl_lab")
                                        <slot id="bl_lab" data-offer-type="bl_lab">
                                            @include('admin.new-pages.components.common-field.card-info', ['title' => 'Component Heading'])
                                            @include('admin.new-pages.components.common-field.attribute.image')
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.attribute.double-button')
                                            @include('admin.new-pages.components.common-field.multi-item.divider')
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'bl_lab',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--videos_component--}}
                                    @if($component->type == "videos_component")
                                        <slot id="videos_component" data-offer-type="videos_component">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.attribute.button')
                                            @include('admin.new-pages.components.common-field.multi-item.divider')
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'videos_component',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--icon_text_with_image--}}
                                    @if($component->type == "icon_text_with_image")
                                        <slot id="icon_text_with_image" data-offer-type="icon_text_with_image">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.attribute.description', ['is_editor' => false])
                                            @include('admin.new-pages.components.common-field.attribute.image')
                                            @include('admin.new-pages.components.common-field.multi-item.divider')
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'icon_text_with_image',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    {{--multiple_image--}}
                                    @if($component->type == "multiple_image")
                                        <slot id="multiple_image" data-offer-type="multiple_image">
                                            @include('admin.new-pages.components.common-field.attribute.title')
                                            @include('admin.new-pages.components.common-field.multi-item.divider')
                                            @if(!empty($component->component_data_mod))
                                                @foreach($component->component_data_mod as $key => $data)
                                                    @include('admin.new-pages.components.common-field.repeatable-item', [
                                                        'component_type' => 'multiple_image',
                                                        'data' => $data,
                                                        'key' => $key
                                                    ])
                                                @endforeach
                                            @endif
                                        </slot>
                                    @endif

                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label for="title" class="mr-1">Status:</label>
                                            <input type="radio" name="status" value="1"
                                                   id="active" {{ $component->status == 1 ? 'checked' : '' }}>
                                            <label for="active" class="mr-1">Active</label>
                                            <input type="radio" name="status" value="0"
                                                   id="inactive" {{ $component->status == 0 ? 'checked' : '' }}>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .type-line {
            border-top: 1px solid #06063b !important;
        }
        .item-divider {
            border-top: 1px solid #ef6d0c !important;
        }
        form #related_product_field .select2-container {
            width: 100% !important;
        }
    </style>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">

@endpush
@push('page-js')
{{--    <script src="{{ asset('js/custom-js/component.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('js/custom-js/page-component.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script>
        var componentDataDestroyUrl = "{{ url('page-components-data-destroy') . "/" . $pageId }}";
        $(function () {
            $('#component_type').on('change', function () {
                var componentType = this.value + ".png"
                var fullUrl = "{{ asset('component-images') }}/" + componentType;
                $("#componentImg").attr('src', fullUrl)
            })

            function dropify() {
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
                        ['style', ['style'], ['bold', 'italic', 'underline', 'clear']],
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
                height: 150
            })
        })
    </script>

@endpush







