@include('layouts.partials.products.common-field.call_rate')

@include('layouts.partials.products.common-field.internet_volume')

@include('layouts.partials.products.common-field.minute_volume')

@include('layouts.partials.products.common-field.validity')

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

@include('layouts.partials.products.common-field.balance_check')
