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
        <option value="">Select Status</option>
        <option class="text-success" value="1" {{ isset($product) && $product->status == 1 ? 'selected' : '' }}>Enable</option>
        <option class="text-danger" value="0" {{ isset($product) && $product->status == 0 ? 'selected' : '' }}>Disable</option>
    </select>
    <div class="help-block"></div>
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
