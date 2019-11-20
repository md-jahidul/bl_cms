<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="view_list_btn_text_bn" class="required">Eligible customer:</label>
    <input type="text" name="offer_info[eligible_customer_en]"  class="form-control" placeholder="Enter call rate in paisa"
           value="{{ (!empty($offerInfo['eligible_customer_en'])) ? $offerInfo['eligible_customer_en'] : old("other_attributes.eligible_customer_en") ?? '' }}"
           required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('eligible_customer_en'))
        <div class="help-block">  {{ $errors->first('eligible_customer_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="view_list_btn_text_bn" class="required">Eligible customer:</label>
    <input type="text" name="offer_info[eligible_customer_bn]"  class="form-control" placeholder="Enter call rate in paisa"
           value="{{ (!empty($offerInfo['eligible_customer_bn'])) ? $offerInfo['eligible_customer_bn'] : old("other_attributes.eligible_customer_bn") ?? '' }}"
           required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('eligible_customer_bn'))
        <div class="help-block">  {{ $errors->first('eligible_customer_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('how_avail_en') ? ' error' : '' }}">
    <label for="how_avail_en" class="required">How to Avail:</label>
    <input type="text" name="offer_info[how_avail_en]"  class="form-control" placeholder="Enter SMS rate in paisa"
           value="{{ (!empty($offerInfo['how_avail_en'])) ? $offerInfo['how_avail_en'] : old("offer_info.how_avail_en") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('how_avail_en'))
        <div class="help-block">  {{ $errors->first('how_avail_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('how_avail_bn') ? ' error' : '' }}">
    <label for="how_avail_bn" class="required">How to Avail:</label>
    <input type="text" name="offer_info[how_avail_bn]"  class="form-control" placeholder="Enter SMS rate in paisa"
           value="{{ (!empty($offerInfo['how_avail_bn'])) ? $offerInfo['how_avail_bn'] : old("offer_info.how_avail_bn") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('how_avail_bn'))
        <div class="help-block">  {{ $errors->first('how_avail_bn') }}</div>
    @endif
</div>