<div class="form-group col-md-6 {{ $errors->has('sms_rate') ? ' error' : '' }}">
    <label for="sms_rate">SMS Rate</label>
    <input type="text" name="sms_rate" class="form-control sms_rate" placeholder="Enter SMS rate in paisa" step="0.001"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->sms_rate)) ? $product->product_core->sms_rate : old("sms_rate") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sms_rate'))
        <div class="help-block">  {{ $errors->first('sms_rate') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sms_rate_short_text_en') ? ' error' : '' }}">
    <label for="sms_rate_short_text_en">SMS rate Short Text (EN)</label>
    <input type="text" name="offer_info[sms_rate_short_text_en]"  class="form-control" placeholder="Enter call rate short text in English"
           value="{{ (!empty($product->offer_info['sms_rate_short_text_en'])) ? $product->offer_info['sms_rate_short_text_en'] : old("offer_info.sms_rate_short_text_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sms_rate_short_text_en'))
        <div class="help-block">  {{ $errors->first('sms_rate_short_text_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sms_rate_short_text_bn') ? ' error' : '' }}">
    <label for="sms_rate_short_text_bn">SMS rate Short Text (BN)</label>
    <input type="text" name="offer_info[sms_rate_short_text_bn]"  class="form-control" placeholder="Enter call rate short text in Bangla"
           value="{{ (!empty($product->offer_info['sms_rate_short_text_bn'])) ? $product->offer_info['sms_rate_short_text_bn'] : old("offer_info.sms_rate_short_text_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sms_rate_short_text_bn'))
        <div class="help-block">  {{ $errors->first('sms_rate_short_text_bn') }}</div>
    @endif
</div>
