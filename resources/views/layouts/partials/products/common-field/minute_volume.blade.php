<div class="col-md-12">
    <span><h4><strong>Voice</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_volume') ? ' error' : '' }}">
    <label for="minute_volume">Minute Volume</label>
    <input type="text" name="minute_volume" class="form-control minute_volume" placeholder="Enter minute volume"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->minute_volume)) ? $product->product_core->minute_volume : old("minute_volume") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('minute_volume'))
        <div class="help-block">  {{ $errors->first('minute_volume') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_short_text_en') ? ' error' : '' }}">
    <label for="minute_short_text_en">Minute Short Text (EN)</label>
    <input type="text" name="offer_info[minute_short_text_en]"  class="form-control" placeholder="Enter call rate short text in English"
           value="{{ (!empty($product->offer_info['minute_short_text_en'])) ? $product->offer_info['minute_short_text_en'] : old("offer_info.minute_short_text_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('minute_short_text_en'))
        <div class="help-block">  {{ $errors->first('minute_short_text_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_short_text_bn') ? ' error' : '' }}">
    <label for="minute_short_text_bn">Minute Short Text (BN)</label>
    <input type="text" name="offer_info[minute_short_text_bn]"  class="form-control" placeholder="Enter call rate short text in Bangla"
           value="{{ (!empty($product->offer_info['minute_short_text_bn'])) ? $product->offer_info['minute_short_text_bn'] : old("offer_info.minute_short_text_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('minute_short_text_bn'))
        <div class="help-block">  {{ $errors->first('minute_short_text_bn') }}</div>
    @endif
</div>
