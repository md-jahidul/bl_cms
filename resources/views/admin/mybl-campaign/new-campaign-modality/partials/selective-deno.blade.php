@php
    $index = isset($key) ?  $key : 0;
@endphp

<div class="form-group col-md-4">
    <label for="recharge_amount">Min Recharge Amount</label>
    <div class='input-group'>
        <input type='number' class="form-control" name="campaign_details[{{$index}}][recharge_amount]"
               placeholder="Please select min recharge amount" autocomplete="off"
               value="{{ isset($product->recharge_amount) ? $product->recharge_amount : '' }}"/>
    </div>
</div>

<div class="form-group col-md-4">
    <label for="max_recharge_amount">Max Recharge Amount</label>
    <div class='input-group'>
        <input type='number' class="form-control" name="campaign_details[{{$index}}][max_recharge_amount]"
               placeholder="Please select recharge amount" autocomplete="off"
               value="{{ isset($product->max_recharge_amount) ? $product->max_recharge_amount : '' }}"/>
    </div>
</div>

<div class="form-group col-md-4 number_of_apply_times_for_product">
    <label for="number_of_apply_times">No of apply times</label>
    <input type="number" name="campaign_details[{{$index}}][number_of_apply_times]"
           class="form-control" placeholder="Please Enter Max Amount"
           value="{{ isset($product->number_of_apply_times) ? $product->number_of_apply_times : '' }}">
</div>
{{--<div class="form-group col-md-4">--}}
{{--    <label for="numbers_of_get_bonus">No of Get Bonus Product</label>--}}
{{--    <input type="number" name="campaign_details[{{ $index }}][numbers_of_get_bonus]" class="form-control"--}}
{{--           placeholder="Please Select numbers of get bonus product" value="{{ isset($product->numbers_of_get_bonus) ? $product->numbers_of_get_bonus : '' }}">--}}
{{--</div>--}}

{{--@php--}}
{{--    $productType = '<span class="text-success">(Prepaid) </span>'--}}
{{--@endphp--}}
{{--<div class="form-group col-md-4 product_code" id="cta_action">--}}
{{--    <label for="bonus_product_code" class="required">Bonus Product Code</label>--}}
{{--    <select id="bonus_product_code" name="campaign_details[{{ $index }}][bonus_product_code]" class=" custom-select product-list">--}}
{{--        <option value="">Select Product</option>--}}
{{--        @foreach ($products as $key => $value)--}}
{{--            <option value="{{ $value->product_code }}"{{ isset($product->bonus_product_code) && $product->bonus_product_code == $value->product_code ? 'selected' : '' }}--}}
{{--            >{!! ($value->sim_type == 1 ? $productType : "(Postpaid) ") . $value->commercial_name_en . " / " . $value->product_code  !!}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--    <div class="help-block"></div>--}}
{{--</div>--}}
