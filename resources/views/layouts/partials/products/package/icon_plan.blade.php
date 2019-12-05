<div class="form-group col-md-6 {{ $errors->has('internet_volume_mb') ? ' error' : '' }}">
    <label for="internet_volume_mb" class="required">Internet Volume (MB)</label>
    <input type="number" name="internet_volume_mb"  class="form-control" placeholder="Enter internet volume in MB"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->internet_volume_mb)) ? $product->product_core->internet_volume_mb : old("internet_volume_mb") ?? '' }}"
           required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('internet_volume_mb'))
        <div class="help-block">  {{ $errors->first('internet_volume_mb') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_volume') ? ' error' : '' }}">
    <label for="minute_volume" class="required">Minute Volume</label>
    <input type="text" name="minute_volume"  class="form-control" placeholder="Enter minute volume"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->minute_volume)) ? $product->product_core->minute_volume : old("minute_volume") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_volume'))
        <div class="help-block">  {{ $errors->first('minute_volume') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_offer') ? ' error' : '' }}">
    <label for="minute_offer" class="required">ISD Call (Tk)</label>
    <input type="number" name="offer_info[minute_offer]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['minute_offer'])) ? $offerInfo['minute_offer'] : old("offer_info.minute_offer") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_offer'))
        <div class="help-block">  {{ $errors->first('minute_offer') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_offer') ? ' error' : '' }}">
    <label for="minute_offer" class="required">Minute Volume (Video Call)</label>
    <input type="number" name="offer_info[minute_offer]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['minute_offer'])) ? $offerInfo['minute_offer'] : old("offer_info.minute_offer") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_offer'))
        <div class="help-block">  {{ $errors->first('minute_offer') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_offer') ? ' error' : '' }}">
    <label for="minute_offer" class="required">Local (SMS)</label>
    <input type="number" name="offer_info[minute_offer]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['minute_offer'])) ? $offerInfo['minute_offer'] : old("offer_info.minute_offer") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_offer'))
        <div class="help-block">  {{ $errors->first('minute_offer') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_offer') ? ' error' : '' }}">
    <label for="minute_offer" class="required">International (SMS)</label>
    <input type="number" name="offer_info[minute_offer]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['minute_offer'])) ? $offerInfo['minute_offer'] : old("offer_info.minute_offer") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_offer'))
        <div class="help-block">  {{ $errors->first('minute_offer') }}</div>
    @endif
</div>


