@php($key ?? 0)

{{--    @if(isset($key) && $key == 0)--}}
{{--  --}}
{{--    @endif--}}
<div class="form-group col-md-12">
    <label for="alt_text"></label>
    <button type="button" class="btn-sm btn-outline-secondary block" id="plus-image"><i class="la la-plus"></i>Add More</button>
</div>

<slot class="page_component_multi_item">
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

    @elseif(isset($component_type) && $component_type == "tab_component_with_image_card_one"
        || $component_type == "tab_component_with_image_card_two"
        || $component_type == "tab_component_with_image_card_three"
        || $component_type == "tab_component_with_image_card_four"
    )
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Tab', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.title', ['is_tab' => false])
        @if($component_type == "tab_component_with_image_card_four")
            <div class="form-group col-md-4">
                <label for="editor_en">Content Type</label>
                <select name="componentData[0][content_type][value_en]" class="form-control tab_content_type" disabled>
                    <option value="static" {{ isset($data) && $data['content_type']['value_en'] == "static"  ? "selected" : ""}}>Static</option>
                    <option value="dynamic" {{ isset($data) && $data['content_type']['value_en'] == "dynamic"  ? "selected" : ""}}>Dynamic</option>
                </select>
                <input type="hidden" name="componentData[0][title][is_tab]" value="1">
            </div>
            @if($data['content_type']['value_en'] == "static")
                <div class="form-group col-md-4 dynamic_or_static" >
                    <label for="static_component">Static Component</label>
                    <select name="componentData[0][static_component][value_en]" class="form-control" disabled>
                        <option value="find_store" selected>Find a Store</option>
                    </select>
                </div>
            @endif
        @endif
        <div class="col-md-11 ml-5">
            <div class="row tab-item">
                @if(isset($data['data']))
                    @foreach($data['data'] as $tabIndex => $tabItemData)
                        <slot class="tab_item_count">
                            @if($tabIndex == 0)
                                <div class="form-group col-md-12">
                                    <label for="alt_text"></label>
                                    <button type="button" class="btn-sm btn-outline-warning block add-tab-item" ><i class="la la-plus"></i> Add More</button>
                                </div>
                            @endif
                        </slot>
                        <slot class="tab_item_count" data-tab-id="{{ $key }}">

                            @if($component_type == "tab_component_with_image_card_three")
                                @include('admin.new-pages.components.common-field.multi-item.feedback', ['is_tab' => true])

                            @elseif($component_type == "tab_component_with_image_card_four")
                                @include('admin.new-pages.components.common-field.multi-item.image', ['is_tab' => true, 'tabIndex' => $tabIndex])
                                @include('admin.new-pages.components.common-field.multi-item.button', ['is_tab' => true, 'tabIndex' => $tabIndex])
                            @else
                                @include('admin.new-pages.components.common-field.multi-item.title', ['is_tab' => true, 'tabIndex' => $tabIndex])
                                @include('admin.new-pages.components.common-field.multi-item.description', ['is_tab' => true, 'tabIndex' => $tabIndex, 'is_editor' => true])
                                @include('admin.new-pages.components.common-field.multi-item.button', ['is_tab' => true, 'tabIndex' => $tabIndex])
                                @include('admin.new-pages.components.common-field.multi-item.image', ['is_tab' => true, 'tabIndex' => $tabIndex])
                            @endif
                                @if(isset($tabItemData['title']['parent_id']) || isset($tabItemData['button_name']['parent_id']))
                                    @php($comId = $tabItemData['title']['id'] ?? $tabItemData['button_name']['id'])
                                    @php($parentId = $tabItemData['title']['parent_id'] ?? $tabItemData['button_name']['parent_id'])
                                    @php($parentGroup= $tabItemData['title']['group'] ?? $tabItemData['button_name']['group'])

                                    <div class="form-group col-md-1">
                                        <label for="alt_text"></label>
                                        <i class="la la-trash remove-image btn-sm btn-danger" data-com-id="{{ $comId }}" data-tab="1"
                                           data-parent="{{ $parentId }}" data-group="{{ $parentGroup }}"></i>
                                    </div>
                                @else
                                    <div class="form-group col-md-1 ">
                                        <label for="alt_text"></label>
                                        <i class="la la-trash remove-image btn-sm btn-danger" data-com-id="{{ $tabItemData['feedback']['id'] }}" data-tab="1"
                                           data-parent="{{ $tabItemData['feedback']['parent_id'] }}" data-group="{{ $tabItemData['feedback']['group'] }}"></i>
                                    </div>
                                @endif
                            @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => '', 'index' => ""])
                        </slot>
                    @endforeach
                @else
                    @if(isset($data['content_type']['value_en']) && $data['content_type']['value_en'] != "static")
                        <slot class="tab_item_count">
                            <div class="form-group col-md-12">
                                <label for="alt_text"></label>
                                <button type="button" class="btn-sm btn-outline-warning block add-tab-item" ><i class="la la-plus"></i> Add More</button>
                            </div>
                        </slot>
                    @endif
                @endif
            </div>
        </div>
    @elseif(isset($component_type) && $component_type == "explore_services")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.redirect-link')

    @elseif(isset($component_type) && $component_type == "explore_c")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.button')

    @elseif(isset($component_type) && $component_type == "banner_with_button")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.button')

    @elseif(isset($component_type) && $component_type == "digital_world")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.button')
        @include('admin.new-pages.components.common-field.multi-item.free-text', ['fieldName' => 'date_txt', 'label' => 'Date'])

    @elseif(isset($component_type) && $component_type == "bl_lab")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image-two', ['fieldName' => 'image_icon', 'label' => 'Icon Image'])
        @include('admin.new-pages.components.common-field.multi-item.image-two', ['fieldName' => 'image_card', 'label' => 'Card Image'])
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.double-button')

    @elseif(isset($component_type) && $component_type == "videos_component")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.video')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')

    @elseif(isset($component_type) && $component_type == "icon_text_with_image")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image-two', ['fieldName' => 'image_icon', 'label' => 'Icon Image'])
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')

    @elseif(isset($component_type) && $component_type == "multiple_image")
        @include('admin.new-pages.components.common-field.multi-item.line-count', ['title' => 'Item', 'index' => $key + 1])
        @include('admin.new-pages.components.common-field.multi-item.image')
    @else

    @endif

    <!--Remove Item-->
    <div class="form-group col-md-1">
        <label for="alt_text"></label>
        @if(isset($data['title']['group']))
            <i class="la la-trash remove-image btn-sm btn-danger" data-com-id="{{ $component->id }}" data-parent="0" data-tab="0"
               data-group="{{ isset($data['title']['group']) ? $data['title']['group'] : '' }}"></i>
        @else
            <i class="la la-trash remove-image btn-sm btn-danger" data-com-id="{{ $component->id }}" data-parent="0" data-tab="0"
               data-group="{{ isset($data['image']['group']) ? $data['image']['group'] : '' }}"></i>
        @endif
    </div>
</slot>
