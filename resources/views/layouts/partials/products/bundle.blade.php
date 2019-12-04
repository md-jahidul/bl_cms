<div class="form-group col-md-6 {{ $errors->has('minute_volume') ? ' error' : '' }}">
    <label for="minute_volume" class="required">Minute Volume</label>
    <input type="text" name="minute_volume"  class="form-control" placeholder="Enter minute volume"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->minute_volume)) ? $product->minute_volume : old("minute_volume") ?? '' }}"
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
           value="{{ (!empty($product->internet_volume_mb)) ? $product->internet_volume_mb : old("internet_volume_mb") ?? '' }}"
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
           value="{{ (!empty($product->sms_volume)) ? $product->sms_volume : old("sms_volume") ?? '' }}"
           {{--required data-validation-required-message="Enter view list button label bangla"--}}>
    <div class="help-block"></div>
    @if ($errors->has('sms_volume'))
        <div class="help-block">  {{ $errors->first('sms_volume') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('product_validity') ? ' error' : '' }}">
    <label for="product_validity" class="required">Validity Days</label>
    <input type="number" name="product_validity"  class="form-control product_validity" placeholder="Enter validity days" id="product_validity"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_validity)) ? $product->product_validity : old("product_validity") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('product_validity'))
        <div class="help-block">  {{ $errors->first('product_validity') }}</div>
    @endif
</div>
