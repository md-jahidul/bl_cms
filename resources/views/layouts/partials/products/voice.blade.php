<div class="form-group col-md-6 {{ $errors->has('minute_volume') ? ' error' : '' }}">
    <label for="minute_volume" class="required">Minute Volume</label>
    <input type="text" name="offer_info[minute_volume]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['minute_volume'])) ? $offerInfo['minute_volume'] : old("offer_info.minute_volume") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_volume'))
        <div class="help-block">  {{ $errors->first('minute_volume') }}</div>
    @endif
</div>
<div class="form-group col-md-6 {{ $errors->has('validity_days') ? ' error' : '' }}">
    <label for="validity_days" class="required">Validity Days</label>
    <input type="text" name="offer_info[validity_days]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['validity_days'])) ? $offerInfo['validity_days'] : old("offer_info.validity_days") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('validity_days'))
        <div class="help-block">  {{ $errors->first('validity_days') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('inspiration_quote_en') ? ' error' : '' }}">
    <label for="inspiration_quote_en" class="required">Inspiration Quote English</label>
    <input type="text" name="offer_info[inspiration_quote_en]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['inspiration_quote_en'])) ? $offerInfo['inspiration_quote_en'] : old("offer_info.inspiration_quote_en") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('inspiration_quote_en'))
        <div class="help-block">  {{ $errors->first('inspiration_quote_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('inspiration_quote_bn') ? ' error' : '' }}">
    <label for="inspiration_quote_bn" class="required">Inspiration Quote Bangla</label>
    <input type="text" name="offer_info[inspiration_quote_bn]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['inspiration_quote_bn'])) ? $offerInfo['inspiration_quote_bn'] : old("offer_info.inspiration_quote_bn") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('inspiration_quote_bn'))
        <div class="help-block">  {{ $errors->first('inspiration_quote_bn') }}</div>
    @endif
</div>
