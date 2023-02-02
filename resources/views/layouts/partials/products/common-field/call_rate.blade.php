<div class="col-md-12">
    <span><h4><strong>Call Rete</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="view_list_btn_text_bn">Call Rate (Paisa)</label>
    <input type="text" name="call_rate" class="form-control call_rate" placeholder="Enter call rate in paisa"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->call_rate)) ? $product->product_core->call_rate : old("call_rate") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('call_rate'))
        <div class="help-block">  {{ $errors->first('call_rate') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="call_rate_unit">Call Rate Unit (English)</label>
    <input type="text" name="call_rate_unit" class="form-control call_rate" placeholder="Enter call rate unit in English. e.g: Paisa/Sec"
           value="{{ (!empty($product->product_core->call_rate_unit)) ? $product->product_core->call_rate_unit : old("call_rate_unit") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('call_rate_unit'))
        <div class="help-block">  {{ $errors->first('call_rate_unit') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('call_rate_unit_bn') ? ' error' : '' }}">
    <label for="call_rate_unit_bn">Call Rate Unit (Bangla)</label>
    <input type="text" name="call_rate_unit_bn" class="form-control call_rate_unit_bn" placeholder="Enter call rate unit in English. e.g: Paisa/Sec"
           value="{{ (!empty($product->call_rate_unit_bn)) ? $product->call_rate_unit_bn : old("call_rate_unit_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('call_rate_unit_bn'))
        <div class="help-block">  {{ $errors->first('call_rate_unit_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('call_rate_short_text_en') ? ' error' : '' }}">
    <label for="call_rate_short_text_en">Call Rate Short Text (EN)</label>
    <input type="text" name="offer_info[call_rate_short_text_en]"  class="form-control" placeholder="Enter call rate short text in English"
           value="{{ (!empty($product->offer_info['call_rate_short_text_en'])) ? $product->offer_info['call_rate_short_text_en'] : old("offer_info.call_rate_short_text_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('call_rate_short_text_en'))
        <div class="help-block">  {{ $errors->first('call_rate_short_text_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('call_rate_short_text_bn') ? ' error' : '' }}">
    <label for="call_rate_short_text_bn">Call Rate Short Text (BN)</label>
    <input type="text" name="offer_info[call_rate_short_text_bn]"  class="form-control" placeholder="Enter call rate short text in Bangla"
           value="{{ (!empty($product->offer_info['call_rate_short_text_bn'])) ? $product->offer_info['call_rate_short_text_bn'] : old("offer_info.call_rate_short_text_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('call_rate_short_text_bn'))
        <div class="help-block">  {{ $errors->first('call_rate_short_text_bn') }}</div>
    @endif
</div>
