@php($key ?? 0)
<slot class="page_component_multi_item">
    @if(isset($key) && $key == 0)
        <div class="form-group col-md-12">
            <label for="alt_text"></label>
            <button type="button" class="btn-sm btn-outline-secondary block" id="plus-image"><i class="la la-plus"></i>Add More</button>
        </div>
    @endif


    @if(isset($component_type) && $component_type == "hovering_card_component")
        @include('admin.new-pages.components.common-field.multi-item.divider')
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.image-two')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.redirect-link')

    @elseif(isset($component_type) && $component_type == "card_with_bg_color_component")
        @include('admin.new-pages.components.common-field.multi-item.divider')
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.button')

    @elseif(isset($component_type) && $component_type == "top_image_card_with_button")
        @include('admin.new-pages.components.common-field.multi-item.divider')
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.button')

    @elseif(isset($component_type) && $component_type == "step_cards_with_hovering_effect")
        @include('admin.new-pages.components.common-field.multi-item.divider')
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.image-two')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.title-two')
        @include('admin.new-pages.components.common-field.multi-item.description-two')

    @elseif(isset($component_type) && $component_type == "galley_masonry")
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')

    @elseif(isset($component_type) && $component_type == "hero_section")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.url')

    @elseif(isset($component_type) && $component_type == "top_image_bottom_text_component")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')

    @elseif(isset($component_type) && $component_type == "icon_text_component")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')

    @elseif(isset($component_type) && $component_type == "icon_text_with_bg_component")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
    @elseif(isset($component_type) && $component_type == "stories_slider")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.feedback', ['is_tab' => false])
    @elseif(isset($component_type) && $component_type == "tab_component_with_image_card_one")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Tab', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.title', ['is_tab' => false])
            <div class="col-md-11 ml-5">
                <div class="row tab-item">
                    @foreach($data['data'] as $tabIndex => $data)
                        <slot class="tab_item_count" data-tab-id="{{ $key }}">
                            @if($tabIndex == 0)
                                <div class="form-group col-md-12">
                                    <label for="alt_text"></label>
                                    <button type="button" class="btn-sm btn-outline-warning block add-tab-item" ><i class="la la-plus"></i> Add More</button>
                                </div>
                            @endif

                            @include('admin.new-pages.components.common-field.multi-item.title', ['is_tab' => true, 'tabIndex' => $tabIndex])
                            @include('admin.new-pages.components.common-field.multi-item.description', ['is_tab' => true, 'tabIndex' => $tabIndex])
                            @include('admin.new-pages.components.common-field.multi-item.image', ['is_tab' => true, 'tabIndex' => $tabIndex])

                            @if($tabIndex != 0)
                                <div class="form-group col-md-1 ">
                                    <label for="alt_text"></label>
                                    <i class="la la-trash remove-image btn-sm btn-danger" data-com-id="{{ $data['title']['id'] }}" data-tab="1"
                                       data-parent="{{ $data['title']['parent_id'] ?? 0 }}" data-group="{{ isset($data['title']['group']) ? $data['title']['group'] : '' }}"></i>
                                </div>
                            @endif
                            @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => '', 'index' => ""])
                        </slot>
                    @endforeach
                </div>
            </div>
        @else
    @endif

{{--    @if(isset($key) && $key != 0)--}}
        <div class="form-group col-md-1">
            <label for="alt_text"></label>
            <i class="la la-trash remove-image btn-sm btn-danger" data-com-id="{{ $component->id }}" data-parent="0" data-tab="0"
               data-group="{{ isset($data['title']['group']) ? $data['title']['group'] : '' }}"></i>
        </div>
{{--    @endif--}}
</slot>
