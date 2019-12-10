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

<div class="form-group col-md-6 {{ $errors->has('sms_volume') ? ' error' : '' }}">
    <label for="sms_volume">SMS Volume</label>
    <input type="number" name="sms_volume"  class="form-control" placeholder="Enter SMS volume"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->sms_volume)) ? $product->product_core->sms_volume : old("sms_volume") ?? '' }}"
           {{--required data-validation-required-message="Enter view list button label bangla"--}}>
    <div class="help-block"></div>
    @if ($errors->has('sms_volume'))
        <div class="help-block">  {{ $errors->first('sms_volume') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('validity') ? ' error' : '' }}">
    <label for="validity" class="required">Validity Days</label>
    <input type="number" name="validity"  class="form-control validity" placeholder="Enter validity days" id="validity"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->validity)) ? $product->product_core->validity : old("validity") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('validity'))
        <div class="help-block">  {{ $errors->first('validity') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('balance_check_ussd') ? ' error' : '' }}">
    <label for="balance_check_ussd">Balance Check</label>
    <input type="text" name="balance_check_ussd"  class="form-control" placeholder="Enter balance check USSD"
           {{--oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"--}}
           value="{{ (!empty($product->product_core->balance_check_ussd)) ? $product->product_core->balance_check_ussd : old("balance_check_ussd") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('balance_check_ussd'))
        <div class="help-block">  {{ $errors->first('balance_check_ussd') }}</div>
    @endif
</div>

