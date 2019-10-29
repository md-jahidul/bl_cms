<div class="form-group col-md-6 {{ $errors->has('callrate_offer') ? ' error' : '' }}">
    <label for="callrate_offer" class="required">Call Rate</label>
    <input type="text" name="offer_info[callrate_offer]"  class="form-control" placeholder="Enter view list button label bangla "
           value="{{ (!empty($offerInfo['callrate_offer'])) ? $offerInfo['callrate_offer'] : old("offer_info.callrate_offer") ?? '' }}"
           required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('callrate_offer'))
        <div class="help-block">  {{ $errors->first('callrate_offer') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('internet_offer_mb') ? ' error' : '' }}">
    <label for="internet_offer_mb" class="required">Internet Offer MB</label>
    <input type="text" name="offer_info[internet_offer_mb]"  class="form-control" placeholder="Enter view list button label bangla "
           value="{{ (!empty($offerInfo['internet_offer_mb'])) ? $offerInfo['internet_offer_mb'] : old("offer_info.internet_offer_mb") ?? '' }}"
           required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('internet_offer_mb'))
        <div class="help-block">  {{ $errors->first('internet_offer_mb') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_offer') ? ' error' : '' }}">
    <label for="minute_offer" class="required">Minute Offer</label>
    <input type="text" name="offer_info[minute_offer]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['minute_offer'])) ? $offerInfo['minute_offer'] : old("offer_info.minute_offer") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_offer'))
        <div class="help-block">  {{ $errors->first('minute_offer') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sms_offer') ? ' error' : '' }}">
    <label for="sms_offer" class="required">SMS Offer</label>
    <input type="text" name="offer_info[sms_offer]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['sms_offer'])) ? $offerInfo['sms_offer'] : old("offer_info.sms_offer") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('sms_offer'))
        <div class="help-block">  {{ $errors->first('sms_offer') }}</div>
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

<div class="form-group col-md-6 {{ $errors->has('callrate_short_note_en') ? ' error' : '' }}">
    <label for="callrate_short_note_en" class="required">Call Rate Short Note English</label>
    <input type="text" name="offer_info[callrate_short_note_en]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['callrate_short_note_en'])) ? $offerInfo['callrate_short_note_en'] : old("offer_info.callrate_short_note_en") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('callrate_short_note_en'))
        <div class="help-block">  {{ $errors->first('callrate_short_note_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('callrate_short_note_bn') ? ' error' : '' }}">
    <label for="callrate_short_note_bn" class="required">Call Rate Short Note Bangla</label>
    <input type="text" name="offer_info[callrate_short_note_bn]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['callrate_short_note_bn'])) ? $offerInfo['callrate_short_note_bn'] : old("offer_info.callrate_short_note_bn") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('callrate_short_note_bn'))
        <div class="help-block">  {{ $errors->first('callrate_short_note_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('gb_short_note_en') ? ' error' : '' }}">
    <label for="gb_short_note_en" class="required">Call GB Short Note English</label>
    <input type="text" name="offer_info[gb_short_note_en]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['gb_short_note_en'])) ? $offerInfo['gb_short_note_en'] : old("offer_info.gb_short_note_en") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('gb_short_note_en'))
        <div class="help-block">  {{ $errors->first('gb_short_note_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('gb_short_note_bn') ? ' error' : '' }}">
    <label for="gb_short_note_bn" class="required">Call GB Short Note Bangla</label>
    <input type="text" name="offer_info[gb_short_note_bn]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($offerInfo['gb_short_note_bn'])) ? $offerInfo['gb_short_note_bn'] : old("offer_info.gb_short_note_bn") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('gb_short_note_bn'))
        <div class="help-block">  {{ $errors->first('gb_short_note_bn') }}</div>
    @endif
</div>
