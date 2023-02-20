<div class="col-md-12">
    <span><h4><strong>Internet</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

<div class="form-group col-md-6 {{ $errors->has('internet_volume_mb') ? ' error' : '' }}">
    <label for="internet_volume_mb">Internet Volume (MB)</label>
    <input type="number" name="internet_volume_mb" class="form-control internet_volume_mb" placeholder="Enter internet volume in MB"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->internet_volume_mb)) ? $product->product_core->internet_volume_mb : old("internet_volume_mb") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('internet_volume_mb'))
        <div class="help-block">  {{ $errors->first('internet_volume_mb') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('internet_short_text_en') ? ' error' : '' }}">
    <label for="internet_short_text_en">Internet Short Text (EN)</label>
    <input type="text" name="offer_info[internet_short_text_en]"  class="form-control" placeholder="Enter call rate short text in English"
           value="{{ (!empty($product->offer_info['internet_short_text_en'])) ? $product->offer_info['internet_short_text_en'] : old("offer_info.internet_short_text_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('internet_short_text_en'))
        <div class="help-block">  {{ $errors->first('internet_short_text_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('internet_short_text_bn') ? ' error' : '' }}">
    <label for="internet_short_text_bn">Internet Short Text (BN)</label>
    <input type="text" name="offer_info[internet_short_text_bn]"  class="form-control" placeholder="Enter call rate short text in Bangla"
           value="{{ (!empty($product->offer_info['internet_short_text_bn'])) ? $product->offer_info['internet_short_text_bn'] : old("offer_info.internet_short_text_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('internet_short_text_bn'))
        <div class="help-block">  {{ $errors->first('internet_short_text_bn') }}</div>
    @endif
</div>
