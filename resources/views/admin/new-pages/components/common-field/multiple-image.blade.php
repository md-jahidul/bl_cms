@php($key ?? 0)
<slot class="page_component_multi_item">
    @if(isset($component_type) && $component_type == "hovering_card_component")
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.image-two')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.redirect-link')
    @elseif(isset($component_type) && $component_type == "card_with_bg_color_component")
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.button')
    @elseif(isset($component_type) && $component_type == "top_image_card_with_button")
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.button')
    @elseif(isset($component_type) && $component_type == "step_cards_with_hovering_effect")
        @include('admin.new-pages.components.common-field.multi-item.image')
        @include('admin.new-pages.components.common-field.multi-item.image-two')
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.title-two')
        @include('admin.new-pages.components.common-field.multi-item.description-two')
    @elseif(isset($component_type) && $component_type == "step_cards_with_hovering_effect")
        @include('admin.new-pages.components.common-field.multi-item.image')
    @else

    @endif

    {{--    @dd($data)--}}
    @if(isset($key) && $key == 0)
            <div class="form-group col-md-12">
                <label for="alt_text"></label>
                <button type="button" class="btn-sm btn-outline-secondary block" id="plus-image"><i class="la la-plus">Add More</i></button>
            </div>
    @else
        @php($key+1)
        <div class="form-group col-md-1">
            <label for="alt_text"></label>
            <i class="la la-trash remove-image btn-sm btn-danger" data-com-id="{{ $component->id }}"
               data-group="{{ $data['image']['group'] }}"></i>
        </div>
    @endif
</slot>
