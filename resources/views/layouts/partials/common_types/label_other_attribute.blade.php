<div class="form-group col-md-6 {{ $errors->has('label_en') ? ' error' : '' }}">
    <label for="label_en">label</label>
    <textarea type="text" name="other_attributes[label_en]" rows="5" id=""
              class="form-control" placeholder="Enter label">{{ (!empty($other_attributes['label_en'])) ? $other_attributes['label_en'] : old("other_attributes.label_en") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('label_en'))
    <div class="help-block">  {{ $errors->first('label_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('label_bn') ? ' error' : '' }}">
    <label for="label_bn">label (bangla)</label>
    <textarea type="text" name="other_attributes[label_bn]" rows="5" id=""
              class="form-control" placeholder="Enter label (bangla)">{{ (!empty($other_attributes['label_bn'])) ? $other_attributes['label_bn'] : old("other_attributes.label_bn") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('label_bn'))
    <div class="help-block">  {{ $errors->first('label_bn') }}</div>
    @endif
</div>
