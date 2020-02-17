<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="call_rate_unit">Call Rate Unit</label>
    <input type="text" name="call_rate_unit" class="form-control call_rate" placeholder="Enter call rate unit. e.g: Paisa/Sec"
           value="{{ (!empty($product->product_core->call_rate_unit)) ? $product->product_core->call_rate_unit : old("call_rate_unit") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('call_rate_unit'))
        <div class="help-block">  {{ $errors->first('call_rate_unit') }}</div>
    @endif
</div>
