<div class="form-group col-md-6 {{ $errors->has('price_info') ? ' error' : '' }}">
    <label for="price_info">Price Info</label>
    <input type="text" name="other_attributes[price_info]"  class="form-control" placeholder="Enter price info"
            value="{{ (!empty($other_attributes['price_info'])) ? $other_attributes['price_info'] : old("other_attributes.price_info") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('price_info'))
        <div class="help-block">  {{ $errors->first('price_info') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('price_info_bn') ? ' error' : '' }}">
    <label for="price_info_bn">Price Info Bangla</label>
    <input type="text" name="other_attributes[price_info_bn]"  class="form-control" placeholder="Enter price info (Bangla)"
            value="{{ (!empty($other_attributes['price_info_bn'])) ? $other_attributes['price_info_bn'] : old("other_attributes.price_info_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('price_info_bn'))
        <div class="help-block">  {{ $errors->first('price_info_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('google_play_link') ? ' error' : '' }}">
    <label for="title">Google Play Store Link</label>
    <input type="text" name="other_attributes[google_play_link]"  class="form-control" placeholder="Enter play store link"
            value="{{ (!empty($other_attributes['google_play_link'])) ? $other_attributes['google_play_link'] : old("other_attributes.google_play_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('google_play_link'))
        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
    @endif
</div>
<div class="form-group col-md-6 {{ $errors->has('app_store_link') ? ' error' : '' }}">
    <label for="title">App Store Link</label>
    <input type="text" name="other_attributes[app_store_link]"  class="form-control" placeholder="Enter app store link"
            value="{{ (!empty($other_attributes['app_store_link'])) ? $other_attributes['app_store_link'] : old("other_attributes.app_store_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('app_store_link'))
        <div class="help-block">  {{ $errors->first('app_store_link') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
    <label for="description_en">Description</label>
    <textarea type="text" name="other_attributes[description_en]" rows="5"
              class="form-control" placeholder="Enter description">{{ (!empty($other_attributes['description_en'])) ? $other_attributes['description_en'] : old("other_attributes.description_en") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_en'))
        <div class="help-block">  {{ $errors->first('description_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
    <label for="description_bn">Description (bangla)</label>
    <textarea type="text" name="other_attributes[description_bn]" rows="5"
              class="form-control" placeholder="Enter description (bangla)">{{ (!empty($other_attributes['description_bn'])) ? $other_attributes['description_bn'] : old("other_attributes.description_bn") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_bn'))
        <div class="help-block">  {{ $errors->first('description_bn') }}</div>
    @endif
</div>
