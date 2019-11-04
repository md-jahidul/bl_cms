<div class="form-group col-md-6 {{ $errors->has('sms_rate_offer') ? ' error' : '' }}">
    <label for="sms_rate_offer" class="required">Description</label>
    <textarea type="text" name="offer_info[sms_rate_offer]"  class="form-control" placeholder="Enter SMS rate in paisa"
              required data-validation-required-message="Enter view list url">{{ (!empty($offerInfo['sms_rate_offer'])) ? $offerInfo['sms_rate_offer'] : old("offer_info.sms_rate_offer") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('sms_rate_offer'))
        <div class="help-block">  {{ $errors->first('sms_rate_offer') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
    <label for="offer_category_id" class="required">Other</label>
    <select class="form-control required" name="offer_category_id" id="offer_type"
            required data-validation-required-message="Please select offer">
        <option value="">---Select Offer Type---</option>
        @foreach($others_offer_child as $offer)
            <option value="{{ $offer->id }}">{{ $offer->name }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('offer_category_id'))
        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
    @endif
</div>
