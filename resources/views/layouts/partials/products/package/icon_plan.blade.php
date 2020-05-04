{{--@include('layouts.partials.products.common-field.price_vat_mrp')--}}

{{--@include('layouts.partials.products.common-field.internet_volume')--}}

{{--@include('layouts.partials.products.common-field.minute_volume')--}}

<div class="form-group col-md-6 {{ $errors->has('isd_call_tk') ? ' error' : '' }}">
    <label for="isd_call_tk">ISD Call (Tk)</label>
    <input type="number" name="offer_info[isd_call_tk]"  class="form-control" placeholder="Enter ISD call in Tk"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['isd_call_tk'])) ? $offerInfo['isd_call_tk'] : old("offer_info.isd_call_tk") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('isd_call_tk'))
        <div class="help-block">  {{ $errors->first('isd_call_tk') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('isd_short_text') ? ' error' : '' }}">
    <label for="isd_short_text">ISD Short Text (English)</label>
    <input type="text" name="offer_info[isd_short_text]"  class="form-control" placeholder="Enter ISD short text"
           value="{{ (!empty($offerInfo['isd_short_text'])) ? $offerInfo['isd_short_text'] : old("offer_info.isd_short_text") ?? '' }}">
            <span class="text-warning">Example: Tk. 1000 ISD Call</span>
    <div class="help-block"></div>
    @if ($errors->has('isd_short_text'))
        <div class="help-block">  {{ $errors->first('isd_short_text') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('isd_short_text_bn') ? ' error' : '' }}">
    <label for="isd_short_text_bn">ISD Short Text (Bangla)</label>
    <input type="text" name="offer_info[isd_short_text_bn]"  class="form-control" placeholder="Enter ISD short text"
           value="{{ (!empty($offerInfo['isd_short_text_bn'])) ? $offerInfo['isd_short_text_bn'] : old("offer_info.isd_short_text_bn") ?? '' }}">
    <span class="text-warning">Example: Tk. 1000 ISD Call</span>
    <div class="help-block"></div>
    @if ($errors->has('isd_short_text_bn'))
        <div class="help-block">  {{ $errors->first('isd_short_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_volume_video_call') ? ' error' : '' }}">
    <label for="minute_volume_video_call">Minute Volume (Video Call)</label>
    <input type="number" name="offer_info[minute_volume_video_call]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['minute_volume_video_call'])) ? $offerInfo['minute_volume_video_call'] : old("offer_info.minute_volume_video_call") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('minute_volume_video_call'))
        <div class="help-block">  {{ $errors->first('minute_volume_video_call') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_volume_short_text') ? ' error' : '' }}">
    <label for="minute_volume_short_text">Minute Volume Short Text (English)</label>
    <input type="text" name="offer_info[minute_volume_short_text]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['minute_volume_short_text'])) ? $offerInfo['minute_volume_short_text'] : old("offer_info.minute_volume_short_text") ?? '' }}">
    <span class="text-warning">Example: Video Call</span>
    <div class="help-block"></div>
    @if ($errors->has('minute_volume_short_text'))
        <div class="help-block">  {{ $errors->first('minute_volume_short_text') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_volume_short_text_bn') ? ' error' : '' }}">
    <label for="minute_volume_short_text_bn">Minute Volume Short Text (Bangla)</label>
    <input type="text" name="offer_info[minute_volume_short_text_bn]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['minute_volume_short_text_bn'])) ? $offerInfo['minute_volume_short_text_bn'] : old("offer_info.minute_volume_short_text_bn") ?? '' }}">
    <span class="text-warning">Example: Video Call</span>
    <div class="help-block"></div>
    @if ($errors->has('minute_volume_short_text_bn'))
        <div class="help-block">  {{ $errors->first('minute_volume_short_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('mms') ? ' error' : '' }}">
    <label for="mms">MMS</label>
    <input type="number" name="offer_info[mms]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['mms'])) ? $offerInfo['mms'] : old("offer_info.mms") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('mms'))
        <div class="help-block">  {{ $errors->first('mms') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('mms_short_text') ? ' error' : '' }}">
    <label for="mms_short_text">MMS Short Text (English)</label>
    <input type="text" name="offer_info[mms_short_text]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['mms_short_text'])) ? $offerInfo['mms_short_text'] : old("offer_info.mms_short_text") ?? '' }}">
    <span class="text-warning">Example: Local</span>
    <div class="help-block"></div>
    @if ($errors->has('mms_short_text'))
        <div class="help-block">  {{ $errors->first('mms_short_text') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('mms_short_text_bn') ? ' error' : '' }}">
    <label for="mms_short_text_bn">MMS Short Text (Bangla)</label>
    <input type="text" name="offer_info[mms_short_text_bn]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['mms_short_text_bn'])) ? $offerInfo['mms_short_text_bn'] : old("offer_info.mms_short_text_bn") ?? '' }}">
    <span class="text-warning">Example: Local</span>
    <div class="help-block"></div>
    @if ($errors->has('mms_short_text_bn'))
        <div class="help-block">  {{ $errors->first('mms_short_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('local_sms') ? ' error' : '' }}">
    <label for="local_sms">Local (SMS)</label>
    <input type="number" name="offer_info[local_sms]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['local_sms'])) ? $offerInfo['local_sms'] : old("offer_info.local_sms") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('local_sms'))
        <div class="help-block">  {{ $errors->first('local_sms') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('local_sms_short_text') ? ' error' : '' }}">
    <label for="local_sms_short_text">Local SMS Short Text (English)</label>
    <input type="text" name="offer_info[local_sms_short_text]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['local_sms_short_text'])) ? $offerInfo['local_sms_short_text'] : old("offer_info.local_sms_short_text") ?? '' }}">
    <span class="text-warning">Example: Local</span>
    <div class="help-block"></div>
    @if ($errors->has('local_sms_short_text'))
        <div class="help-block">  {{ $errors->first('local_sms_short_text') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('local_sms_short_text_bn') ? ' error' : '' }}">
    <label for="local_sms_short_text_bn">Local SMS Short Text (Bangla)</label>
    <input type="text" name="offer_info[local_sms_short_text_bn]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['local_sms_short_text_bn'])) ? $offerInfo['local_sms_short_text_bn'] : old("offer_info.local_sms_short_text_bn") ?? '' }}">
    <span class="text-warning">Example: Local</span>
    <div class="help-block"></div>
    @if ($errors->has('local_sms_short_text_bn'))
        <div class="help-block">  {{ $errors->first('local_sms_short_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('international_sms') ? ' error' : '' }}">
    <label for="international_sms">International (SMS)</label>
    <input type="number" name="offer_info[international_sms]"  class="form-control" placeholder="Enter minute offer"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['international_sms'])) ? $offerInfo['international_sms'] : old("offer_info.international_sms") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('international_sms'))
        <div class="help-block">  {{ $errors->first('international_sms') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('international_sms_short_text') ? ' error' : '' }}">
    <label for="international_sms_short_text">International SMS Short Text (English)</label>
    <input type="text" name="offer_info[international_sms_short_text]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['international_sms_short_text'])) ? $offerInfo['international_sms_short_text'] : old("offer_info.international_sms_short_text") ?? '' }}">
    <span class="text-warning">Example: International</span>
    <div class="help-block"></div>
    @if ($errors->has('international_sms_short_text'))
        <div class="help-block">  {{ $errors->first('international_sms_short_text') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('international_sms_short_text_bn') ? ' error' : '' }}">
    <label for="international_sms_short_text_bn">International SMS Short Text (Bangla)</label>
    <input type="text" name="offer_info[international_sms_short_text_bn]"  class="form-control" placeholder="Enter minute offer"
           value="{{ (!empty($offerInfo['international_sms_short_text_bn'])) ? $offerInfo['international_sms_short_text_bn'] : old("offer_info.international_sms_short_text_bn") ?? '' }}">
    <span class="text-warning">Example: International</span>
    <div class="help-block"></div>
    @if ($errors->has('international_sms_short_text_bn'))
        <div class="help-block">  {{ $errors->first('international_sms_short_text_bn') }}</div>
    @endif
</div>


