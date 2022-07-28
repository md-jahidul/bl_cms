@php
    $index = isset($key) ? $key : 0;
@endphp
<input type="hidden" name="campaign_details[{{ $index }}][campaign_details_id]" value="{{ isset($product->id) ? $product->id : 0 }}">
<div class="form-group col-md-4 {{ $errors->has('start_date') ? ' error' : '' }}">
    <label for="start_date">Start Date</label>
    <div class='input-group'>
        <input type='text' class="form-control product_start_date" name="campaign_details[{{ $index }}][start_date]"
               placeholder="Please select start date"
               autocomplete="off"
        value="{{ isset($product->start_date) ? $product->start_date : '' }}"/>
    </div>
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4 {{ $errors->has('end_date') ? ' error' : '' }}">
    <label for="end_date">End Date</label>
    <input type="text" name="campaign_details[{{ $index }}][end_date]" class="form-control product_start_date"
           placeholder="Please select end date"
           value="{{ isset($product->end_date) ? $product->end_date : '' }}" autocomplete="off">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4 mb-2" id="cta_action">
    <label for="redirect_url">Status</label>
    <select id="navigate_action" name="campaign_details[{{ $index }}][status]"
            class="browser-default custom-select">
        <option class="text-success" value="1" {{ isset($product) && $product->status == 1 ? 'selected' : '' }}>Enable</option>
        <option class="text-danger" value="0" {{ isset($product) && $product->status == 0 ? 'selected' : '' }}>Disable</option>
    </select>
    <div class="help-block"></div>
</div>
<div class="col-md-4 icheck_minimal skin mt-2">
    <fieldset>
        <input type="checkbox" id="show_in_home" value="1"
               name="campaign_details[{{ $index }}][show_in_home]" {{ isset($product->show_in_home) && $product->show_in_home ? 'checked' : '' }}>
        <label for="show_in_home">Show in Home</label>
    </fieldset>
</div>
<div class="form-group col-md-4">
    <label for="reward_getting_type">Show product as</label>
    <select id="navigate_action" name="campaign_details[{{ $index }}][show_product_as]" class="browser-default custom-select">
        <option value="bottom_sheet" {{ isset($product->show_product_as) && $product->show_product_as == "bottom_sheet" ? 'selected' : '' }}>Bottom Sheet</option>
        <option value="pop_up" {{ isset($product->show_product_as) && $product->show_product_as == "pop_up" ? 'selected' : '' }}>Pop-up</option>
        <option value="campaign_only" {{ isset($product->show_product_as) && $product->show_product_as == "campaign_only" ? 'selected' : '' }}>Campaign Section only</option>
    </select>
</div>
<div class="form-group col-md-4 mb-0">
    <label for="desc_en" class="required">Description En</label>
    <textarea rows="3" id="desc_en" name="campaign_details[{{ $index }}][desc_en]" class="form-control"
              placeholder="Enter description in English">{{ isset($product->desc_en) ? $product->desc_en : '' }}</textarea>
</div>

<div class="form-group col-md-4">
    <label for="desc_bn" class="required">Description Bn</label>.
    <textarea rows="3" id="desc_bn" name="campaign_details[{{ $index }}][desc_bn]"
              class="form-control"
              placeholder="Enter description in Bangla">{{ isset($product->desc_bn) ? $product->desc_bn : '' }}</textarea>
</div>

@if(!isset($product) && $key != 0)
    <!-- Product Row Delete -->
    <div class="form-group col-md-12">
        <label for="redirect_url"></label>
         <button type="button"
                 class="btn-sm btn-danger cursor-pointer float-right item-delete">
             <i class="la la-trash"></i>
         </button>
    </div>
@endif
