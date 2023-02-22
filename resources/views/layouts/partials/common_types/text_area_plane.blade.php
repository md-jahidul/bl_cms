<div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
    <label for="description_en">Description</label>
    <textarea type="text" name="description_en" rows="5" id=""
              class="form-control" placeholder="Enter description">{{ (!empty($component->description_en)) ? $component->description_en : old("description_en") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_en'))
    <div class="help-block">  {{ $errors->first('description_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
    <label for="description_bn">Description (bangla)</label>
    <textarea type="text" name="description_bn" rows="5" id=""
              class="form-control" placeholder="Enter description (bangla)">{{ (!empty($component->description_bn)) ? $component->description_bn : old("description_bn") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_bn'))
    <div class="help-block">  {{ $errors->first('description_bn') }}</div>
    @endif
</div>
