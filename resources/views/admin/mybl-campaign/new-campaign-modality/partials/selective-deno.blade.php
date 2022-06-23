@php
    $index = isset($key) ?  $key : 0;
@endphp

<div class="col-md-4">
    <label for="cash_back_amount">Enter Fixed/Percentage amount of Cashback</label>
    <input type="number" name="campaign_details[{{$index}}][cash_back_amount]" id="cash_back_amount" class="form-control"
           placeholder="Enter The Fixed/Percentage of Cashback"
           value="{{ isset($product->cash_back_amount) ? $product->cash_back_amount : '' }}">
</div>

<div class="form-group col-md-4 }}">
    <label for="recharge_amount">Recharge Amount</label>
    <div class='input-group'>
        <input type='number' class="form-control" name="campaign_details[{{$index}}][recharge_amount]"
               placeholder="Please select recharge amount" autocomplete="off"
               value="{{ isset($product->recharge_amount) ? $product->recharge_amount : '' }}"/>
    </div>
</div>

<div class="form-group col-md-4 number_of_apply_times_for_product">
    <label for="number_of_apply_times">No of apply times</label>
    <input type="number" name="campaign_details[{{$index}}][number_of_apply_times]"
           class="form-control" placeholder="Please Enter Max Amount"
           value="{{ isset($product->number_of_apply_times) ? $product->number_of_apply_times : '' }}">
</div>
