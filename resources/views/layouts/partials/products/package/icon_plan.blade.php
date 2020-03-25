<div class="form-group col-md-6 {{ $errors->has('internet_volume_mb') ? ' error' : '' }}">
    <label for="internet_volume_mb" class="required">Internet Volume (MB)</label>
    <input type="number" name="internet_volume_mb"  class="form-control" placeholder="Enter internet volume in MB"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->internet_volume_mb)) ? $product->product_core->internet_volume_mb : old("internet_volume_mb") ?? '' }}"
           required data-validation-required-message="Enter view list button label in Bangla ">
    <div class="help-block"></div>
    @if ($errors->has('internet_volume_mb'))
        <div class="help-block">  {{ $errors->first('internet_volume_mb') }}</div>
    @endif
</div>

@include('layouts.partials.products.common-field.minute_volume')

<div class="form-group col-md-6 {{ $errors->has('isd_call_tk') ? ' error' : '' }}">
    <label for="isd_call_tk" class="required">ISD Call (Tk)</label>
    <input type="number" name="offer_info[isd_call_tk]"  class="form-control" placeholder="Enter ISD call in Tk"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['isd_call_tk'])) ? $offerInfo['isd_call_tk'] : old("offer_info.isd_call_tk") ?? '' }}"
           required data-validation-required-message="Enter ISD call in Tk">
    <div class="help-block"></div>
    @if ($errors->has('isd_call_tk'))
        <div class="help-block">  {{ $errors->first('isd_call_tk') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('isd_short_text') ? ' error' : '' }}">
    <label for="isd_short_text" class="required">ISD Short Text</label>
    <input type="text" name="offer_info[isd_short_text]"  class="form-control" placeholder="Enter ISD short text"
           value="{{ (!empty($offerInfo['isd_short_text'])) ? $offerInfo['isd_short_text'] : old("offer_info.isd_short_text") ?? '' }}" required>
            <span class="text-warning">Example: Tk. 1000 ISD Call</span>
    <div class="help-block"></div>
    @if ($errors->has('isd_short_text'))
        <div class="help-block">  {{ $errors->first('isd_short_text') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_volume_video_call') ? ' error' : '' }}">
    <label for="minute_volume_video_call" class="required">Minute Volume (Video Call)</label>
    <input type="number" name="offer_info[minute_volume_video_call]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['minute_volume_video_call'])) ? $offerInfo['minute_volume_video_call'] : old("offer_info.minute_volume_video_call") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_volume_video_call'))
        <div class="help-block">  {{ $errors->first('minute_volume_video_call') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_volume_short_text') ? ' error' : '' }}">
    <label for="minute_volume_short_text" class="required">Minute Volume Short Text</label>
    <input type="text" name="offer_info[minute_volume_short_text]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['minute_volume_short_text'])) ? $offerInfo['minute_volume_short_text'] : old("offer_info.minute_volume_short_text") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <span class="text-warning">Example: Video Call</span>
    <div class="help-block"></div>
    @if ($errors->has('minute_volume_short_text'))
        <div class="help-block">  {{ $errors->first('minute_volume_short_text') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('local_sms') ? ' error' : '' }}">
    <label for="local_sms" class="required">Local (SMS)</label>
    <input type="number" name="offer_info[local_sms]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['local_sms'])) ? $offerInfo['local_sms'] : old("offer_info.local_sms") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('local_sms'))
        <div class="help-block">  {{ $errors->first('local_sms') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('local_sms_short_text') ? ' error' : '' }}">
    <label for="local_sms_short_text" class="required">Local SMS Short Text</label>
    <input type="text" name="offer_info[local_sms_short_text]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['local_sms_short_text'])) ? $offerInfo['local_sms_short_text'] : old("offer_info.local_sms_short_text") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <span class="text-warning">Example: Local</span>
    <div class="help-block"></div>
    @if ($errors->has('local_sms_short_text'))
        <div class="help-block">  {{ $errors->first('local_sms_short_text') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('international_sms') ? ' error' : '' }}">
    <label for="international_sms" class="required">International (SMS)</label>
    <input type="number" name="offer_info[international_sms]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['international_sms'])) ? $offerInfo['international_sms'] : old("offer_info.international_sms") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('international_sms'))
        <div class="help-block">  {{ $errors->first('international_sms') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('international_sms_short_text') ? ' error' : '' }}">
    <label for="international_sms_short_text" class="required">International SMS Short Text</label>
    <input type="text" name="offer_info[international_sms_short_text]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['international_sms_short_text'])) ? $offerInfo['international_sms_short_text'] : old("offer_info.international_sms_short_text") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <span class="text-warning">Example: International</span>
    <div class="help-block"></div>
    @if ($errors->has('international_sms_short_text'))
        <div class="help-block">  {{ $errors->first('international_sms_short_text') }}</div>
    @endif
</div>


