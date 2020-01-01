<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="view_list_btn_text_bn" class="required">Call Rate (Paisa)</label>
    <input type="text" name="call_rate" class="form-control call_rate" placeholder="Enter call rate in paisa"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->call_rate)) ? $product->product_core->call_rate : old("call_rate") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('call_rate'))
        <div class="help-block">  {{ $errors->first('call_rate') }}</div>
    @endif
</div>
