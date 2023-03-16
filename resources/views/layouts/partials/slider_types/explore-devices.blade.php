<div class="form-group col-md-4 {{ $errors->has('secondary_text_en') ? ' error' : '' }}">
    <label for="Secondary_text">Secondary Text (EN)</label>
    <input type="text" name="other_attributes[secondary_text_en]"  class="form-control" placeholder="Enter Secondary Text EN"
            value="{{ (!empty($other_attributes['secondary_text_en'])) ? $other_attributes['secondary_text_en'] : old("other_attributes.secondary_text_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('secondary_text_en'))
        <div class="help-block">  {{ $errors->first('secondary_text_en') }}</div>
    @endif
</div>
<div class="form-group col-md-4 {{ $errors->has('secondary_text_bn') ? ' error' : '' }}">
    <label for="Secondary_text">Secondary Text (BN)</label>
    <input type="text" name="other_attributes[secondary_text_bn]"  class="form-control" placeholder="Enter Secondary Text BN"
            value="{{ (!empty($other_attributes['secondary_text_bn'])) ? $other_attributes['secondary_text_bn'] : old("other_attributes.secondary_text_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('secondary_text_bn'))
        <div class="help-block">  {{ $errors->first('secondary_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('btn_text_en') ? ' error' : '' }}">
    <label for="btn_text_en">Button Text (EN)</label>
    <input type="text" name="other_attributes[btn_text_en]"  class="form-control" placeholder="Button Text EN"
            value="{{ (!empty($other_attributes['btn_text_en'])) ? $other_attributes['btn_text_en'] : old("other_attributes.btn_text_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('btn_text_en'))
        <div class="help-block">  {{ $errors->first('btn_text_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('btn_text_bn') ? ' error' : '' }}">
    <label for="btn_text_bn">Button Text (BN)</label>
    <input type="text" name="other_attributes[btn_text_bn]"  class="form-control" placeholder="Button Text BN"
            value="{{ (!empty($other_attributes['btn_text_bn'])) ? $other_attributes['btn_text_bn'] : old("other_attributes.btn_text_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('btn_text_bn'))
        <div class="help-block">  {{ $errors->first('btn_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('btn_link') ? ' error' : '' }}">
    <label for="btn_link">Button Link</label>
    <input type="text" name="other_attributes[btn_link]"  class="form-control" placeholder="Button Link"
            value="{{ (!empty($other_attributes['btn_link'])) ? $other_attributes['btn_link'] : old("other_attributes.btn_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('btn_link'))
        <div class="help-block">  {{ $errors->first('btn_link') }}</div>
    @endif
</div>

<div class="col-md-4">
    <label></label>
    <div class="form-group mt-1">
        <label for="is_external_link" class="mr-1">Is External Link:</label>
        <input type="checkbox" name="other_attributes[is_external_link]" value="1" id="is_external_link" {{ (!empty($other_attributes['is_external_link'])) ? 'checked' : null }}>
    </div>
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

