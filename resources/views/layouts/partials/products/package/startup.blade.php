{{--@include('layouts.partials.products.common-field.price_vat_mrp')--}}

{{--@include('layouts.partials.products.common-field.minute_volume')--}}

{{--@include('layouts.partials.products.common-field.internet_volume')--}}

{{--@include('layouts.partials.products.common-field.call_rate')--}}

{{--@include('layouts.partials.products.common-field.call_rate_unit')--}}

@include('layouts.partials.products.common-field.sms_rate')

@include('layouts.partials.products.common-field.sms_rate_unit')

@include('layouts.partials.products.common-field.validity_unit')

@include('layouts.partials.products.common-field.validity')

{{--<div class="form-group col-md-6 {{ $errors->has('callrate_short_note_en') ? ' error' : '' }}">--}}
{{--    <label for="callrate_short_note_en">Call Rate Short Note English</label>--}}
{{--    <input type="text" name="offer_info[callrate_short_note_en]"  class="form-control" placeholder="Enter call rate short note in english"--}}
{{--           value="{{ (!empty($offerInfo['callrate_short_note_en'])) ? $offerInfo['callrate_short_note_en'] : old("offer_info.callrate_short_note_en") ?? '' }}">--}}
{{--    <div class="help-block"></div>--}}
{{--    @if ($errors->has('callrate_short_note_en'))--}}
{{--        <div class="help-block">  {{ $errors->first('callrate_short_note_en') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 {{ $errors->has('callrate_short_note_bn') ? ' error' : '' }}">--}}
{{--    <label for="callrate_short_note_bn" >Call Rate Short Note Bangla</label>--}}
{{--    <input type="text" name="offer_info[callrate_short_note_bn]"  class="form-control" placeholder="Enter call rate short note in Bangla"--}}
{{--           value="{{ (!empty($offerInfo['callrate_short_note_bn'])) ? $offerInfo['callrate_short_note_bn'] : old("offer_info.callrate_short_note_bn") ?? '' }}">--}}
{{--    <div class="help-block"></div>--}}
{{--    @if ($errors->has('callrate_short_note_bn'))--}}
{{--        <div class="help-block">  {{ $errors->first('callrate_short_note_bn') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 {{ $errors->has('gb_short_note_en') ? ' error' : '' }}">--}}
{{--    <label for="gb_short_note_en" >Internet Short Note English</label>--}}
{{--    <input type="text" name="offer_info[gb_short_note_en]"  class="form-control" placeholder="Enter internet short note in english"--}}
{{--           value="{{ (!empty($offerInfo['gb_short_note_en'])) ? $offerInfo['gb_short_note_en'] : old("offer_info.gb_short_note_en") ?? '' }}">--}}
{{--    <div class="help-block"></div>--}}
{{--    @if ($errors->has('gb_short_note_en'))--}}
{{--        <div class="help-block">  {{ $errors->first('gb_short_note_en') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 {{ $errors->has('gb_short_note_bn') ? ' error' : '' }}">--}}
{{--    <label for="gb_short_note_bn">Internet Short Note Bangla</label>--}}
{{--    <input type="text" name="offer_info[gb_short_note_bn]"  class="form-control" placeholder="Enter internet short note in Bangla"--}}
{{--           value="{{ (!empty($offerInfo['gb_short_note_bn'])) ? $offerInfo['gb_short_note_bn'] : old("offer_info.gb_short_note_bn") ?? '' }}">--}}
{{--    <div class="help-block"></div>--}}
{{--    @if ($errors->has('gb_short_note_bn'))--}}
{{--        <div class="help-block">  {{ $errors->first('gb_short_note_bn') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}

@include('layouts.partials.products.common-field.balance_check')
