<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="view_list_btn_text_bn" class="required">Call Rate (Paisa)</label>
    <input type="text" name="offer_info[callrate_offer]"  class="form-control" placeholder="Enter call rate in paisa"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['callrate_offer'])) ? $offerInfo['callrate_offer'] : old("other_attributes.callrate_offer") ?? '' }}"
           required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('callrate_offer'))
        <div class="help-block">  {{ $errors->first('callrate_offer') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sms_rate_offer') ? ' error' : '' }}">
    <label for="sms_rate_offer" class="required">SMS Rate (Paisa)</label>
    <input type="text" name="offer_info[sms_rate_offer]"  class="form-control" placeholder="Enter SMS rate in paisa"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['sms_rate_offer'])) ? $offerInfo['sms_rate_offer'] : old("offer_info.sms_rate_offer") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('sms_rate_offer'))
        <div class="help-block">  {{ $errors->first('sms_rate_offer') }}</div>
    @endif
</div>
