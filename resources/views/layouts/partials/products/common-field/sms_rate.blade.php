<div class="form-group col-md-6 {{ $errors->has('sms_rate') ? ' error' : '' }}">
    <label for="sms_rate" class="required">SMS Rate (Paisa)</label>
    <input type="text" name="sms_rate" class="form-control sms_rate" placeholder="Enter SMS rate in paisa" step="0.001"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->sms_rate)) ? $product->product_core->sms_rate : old("sms_rate") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sms_rate'))
        <div class="help-block">  {{ $errors->first('sms_rate') }}</div>
    @endif
</div>
