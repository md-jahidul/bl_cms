<div class="form-group col-md-6 {{ $errors->has('internet_offer_mb') ? ' error' : '' }}">
    <label for="internet_offer_mb" class="required">Internet Volume (MB)</label>
    <input type="number" name="offer_info[internet_offer_mb]"  class="form-control" placeholder="Enter internet offer in MB"
           value="{{ (!empty($offerInfo['internet_offer_mb'])) ? $offerInfo['internet_offer_mb'] : old("offer_info.internet_offer_mb") ?? '' }}"
           required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('internet_offer_mb'))
        <div class="help-block">  {{ $errors->first('internet_offer_mb') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_offer') ? ' error' : '' }}">
    <label for="minute_offer" class="required">Minute Volume Offer</label>
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


