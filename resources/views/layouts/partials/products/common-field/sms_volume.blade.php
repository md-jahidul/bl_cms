<div class="form-group col-md-6 {{ $errors->has('sms_volume') ? ' error' : '' }}">
    <label for="sms_volume">SMS Volume</label>
    <input type="text" name="sms_volume" class="form-control sms_volume" placeholder="Enter SMS volume"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->sms_volume)) ? $product->product_core->sms_volume : old("sms_volume") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sms_volume'))
        <div class="help-block">  {{ $errors->first('sms_volume') }}</div>
    @endif
</div>

