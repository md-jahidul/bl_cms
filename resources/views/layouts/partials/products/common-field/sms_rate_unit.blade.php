<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="sms_rate_unit">SMS Rate Unit (English)</label>
    <input type="text" name="sms_rate_unit" class="form-control call_rate" placeholder="Enter call rate unit in English. e.g: Paisa/Sec"
           value="{{ (!empty($product->product_core->sms_rate_unit)) ? $product->product_core->sms_rate_unit : old("sms_rate_unit") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sms_rate_unit'))
        <div class="help-block">  {{ $errors->first('sms_rate_unit') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sms_rate_unit_bn') ? ' error' : '' }}">
    <label for="sms_rate_unit_bn">SMS Rate Unit (Bangla)</label>
    <input type="text" name="sms_rate_unit_bn" class="form-control sms_rate_unit_bn" placeholder="Enter sms rate unit in English. e.g: Paisa/SMS"
           value="{{ (!empty($product->sms_rate_unit_bn)) ? $product->sms_rate_unit_bn : old("sms_rate_unit_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sms_rate_unit_bn'))
        <div class="help-block">  {{ $errors->first('sms_rate_unit_bn') }}</div>
    @endif
</div>
