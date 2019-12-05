<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="view_list_btn_text_bn" class="required">Call Rate (Paisa)</label>
    <input type="text" name="call_rate"  class="form-control" placeholder="Enter call rate in paisa"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->call_rate)) ? $product->product_core->call_rate : old("call_rate") ?? '' }}"
           required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('call_rate'))
        <div class="help-block">  {{ $errors->first('call_rate') }}</div>
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

<div class="form-group col-md-6 {{ $errors->has('callrate_short_note_en') ? ' error' : '' }}">
    <label for="callrate_short_note_en" class="required">Call Rate Short Note English</label>
    <input type="text" name="offer_info[callrate_short_note_en]"  class="form-control" placeholder="Enter call rate short note in english"
           value="{{ (!empty($offerInfo['callrate_short_note_en'])) ? $offerInfo['callrate_short_note_en'] : old("offer_info.callrate_short_note_en") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('callrate_short_note_en'))
        <div class="help-block">  {{ $errors->first('callrate_short_note_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('callrate_short_note_bn') ? ' error' : '' }}">
    <label for="callrate_short_note_bn" class="required">Call Rate Short Note Bangla</label>
    <input type="text" name="offer_info[callrate_short_note_bn]"  class="form-control" placeholder="Enter call rate short note in bangla"
           value="{{ (!empty($offerInfo['callrate_short_note_bn'])) ? $offerInfo['callrate_short_note_bn'] : old("offer_info.callrate_short_note_bn") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('callrate_short_note_bn'))
        <div class="help-block">  {{ $errors->first('callrate_short_note_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('gb_short_note_en') ? ' error' : '' }}">
    <label for="gb_short_note_en" class="required">Internet Short Note English</label>
    <input type="text" name="offer_info[gb_short_note_en]"  class="form-control" placeholder="Enter internet short note in english"
           value="{{ (!empty($offerInfo['gb_short_note_en'])) ? $offerInfo['gb_short_note_en'] : old("offer_info.gb_short_note_en") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('gb_short_note_en'))
        <div class="help-block">  {{ $errors->first('gb_short_note_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('gb_short_note_bn') ? ' error' : '' }}">
    <label for="gb_short_note_bn" class="required">Internet Short Note Bangla</label>
    <input type="text" name="offer_info[gb_short_note_bn]"  class="form-control" placeholder="Enter internet short note in bangla"
           value="{{ (!empty($offerInfo['gb_short_note_bn'])) ? $offerInfo['gb_short_note_bn'] : old("offer_info.gb_short_note_bn") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('gb_short_note_bn'))
        <div class="help-block">  {{ $errors->first('gb_short_note_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('balance_check_ussd') ? ' error' : '' }}">
    <label for="balance_check_ussd" class="required">Balance Check</label>
    <input type="text" name="balance_check_ussd"  class="form-control" placeholder="Enter balance check USSD"
           {{--oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"--}}
           value="{{ (!empty($product->product_core->balance_check_ussd)) ? $product->product_core->balance_check_ussd : old("balance_check_ussd") ?? '' }}"
           required data-validation-required-message="Enter balance check USSD">
    <div class="help-block"></div>
    @if ($errors->has('balance_check_ussd'))
        <div class="help-block">  {{ $errors->first('balance_check_ussd') }}</div>
    @endif
</div>
