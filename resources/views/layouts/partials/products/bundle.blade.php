<div class="form-group col-md-6 {{ $errors->has('minute_volume') ? ' error' : '' }}">
    <label for="minute_volume">Minute Volume</label>
    <input type="number" name="offer_info[minute_volume]"  class="form-control" placeholder="Enter minute volume"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['minute_volume'])) ? $offerInfo['minute_volume'] : old("offer_info.minute_volume") ?? '' }}"
           {{--required data-validation-required-message="Enter minute volume"--}}>
    <div class="help-block"></div>
    @if ($errors->has('minute_volume'))
        <div class="help-block">  {{ $errors->first('minute_volume') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('internet_volume_mb') ? ' error' : '' }}">
    <label for="internet_volume_mb">Internet Volume (MB)</label>
    <input type="number" name="offer_info[internet_volume_mb]"  class="form-control" placeholder="Enter internet volume in MB"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['internet_volume_mb'])) ? $offerInfo['internet_volume_mb'] : old("offer_info.internet_volume_mb") ?? '' }}"
          {{-- required data-validation-required-message="Enter internet volume"--}}>
    <div class="help-block"></div>
    @if ($errors->has('internet_volume_mb'))
        <div class="help-block">  {{ $errors->first('internet_volume_mb') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sms_volume') ? ' error' : '' }}">
    <label for="sms_volume">SMS Volume</label>
    <input type="number" name="offer_info[sms_volume]"  class="form-control" placeholder="Enter SMS volume"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['sms_volume'])) ? $offerInfo['sms_volume'] : old("offer_info.sms_volume") ?? '' }}"
           {{--required data-validation-required-message="Enter view list button label bangla"--}}>
    <div class="help-block"></div>
    @if ($errors->has('sms_volume'))
        <div class="help-block">  {{ $errors->first('sms_volume') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('validity_days') ? ' error' : '' }}">
    <label for="validity_days">Validity (Days)</label>
    <input type="text" name="offer_info[validity_days]"  class="form-control" placeholder="Enter validity in days"
           value="{{ (!empty($offerInfo['validity_days'])) ? $offerInfo['validity_days'] : old("offer_info.validity_days") ?? '' }}"
           {{--required data-validation-required-message="Enter view list url"--}}>
    <div class="help-block"></div>
    @if ($errors->has('validity_days'))
        <div class="help-block">  {{ $errors->first('validity_days') }}</div>
    @endif
</div>
