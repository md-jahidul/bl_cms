<div class="col-md-12">
    <span><h4><strong>SMS</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

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

<div class="form-group col-md-6 {{ $errors->has('sms_short_text_en') ? ' error' : '' }}">
    <label for="sms_short_text_en">SMS Short Text (EN)</label>
    <input type="text" name="offer_info[sms_short_text_en]"  class="form-control" placeholder="Enter call rate short text in English"
           value="{{ (!empty($product->offer_info['sms_short_text_en'])) ? $product->offer_info['sms_short_text_en'] : old("offer_info.sms_short_text_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sms_short_text_en'))
        <div class="help-block">  {{ $errors->first('sms_short_text_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sms_short_text_bn') ? ' error' : '' }}">
    <label for="sms_short_text_bn">SMS Short Text (BN)</label>
    <input type="text" name="offer_info[sms_short_text_bn]"  class="form-control" placeholder="Enter call rate short text in Bangla"
           value="{{ (!empty($product->offer_info['sms_short_text_bn'])) ? $product->offer_info['sms_short_text_bn'] : old("offer_info.sms_short_text_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sms_short_text_bn'))
        <div class="help-block">  {{ $errors->first('sms_short_text_bn') }}</div>
    @endif
</div>
