<div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
    <label for="description_en">Description</label>
    <textarea type="text" name="other_attributes[description_en]" rows="5" id="details"
              class="form-control" placeholder="Enter description">{{ (!empty($other_attributes['description_en'])) ? $other_attributes['description_en'] : old("other_attributes.description_en") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_en'))
    <div class="help-block">  {{ $errors->first('description_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
    <label for="description_bn">Description (bangla)</label>
    <textarea type="text" name="other_attributes[description_bn]" rows="5" id="details"
              class="form-control" placeholder="Enter description (bangla)">{{ (!empty($other_attributes['description_bn'])) ? $other_attributes['description_bn'] : old("other_attributes.description_bn") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_bn'))
    <div class="help-block">  {{ $errors->first('description_bn') }}</div>
    @endif
</div>
