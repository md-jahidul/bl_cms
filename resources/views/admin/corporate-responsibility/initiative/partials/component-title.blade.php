<div class="form-group col-md-6 {{ $errors->has('component_title_en') ? ' error' : '' }}">
    <label for="component_title_en">Component Title En</label>
    <input type="text" name="component_title_en"  class="form-control" placeholder="Enter extra title in English"
    value="{{ isset($component->component_title_en) ? $component->component_title_en : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('component_title_en'))
        <div class="help-block">{{ $errors->first('component_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('component_title_bn') ? ' error' : '' }}">
    <label for="component_title_bn">Component Title Bn</label>
    <input type="text" name="component_title_bn"  class="form-control" placeholder="Enter extra title in Bangla"
    value="{{ isset($component->component_title_bn) ? $component->component_title_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('component_title_bn'))
        <div class="help-block">{{ $errors->first('component_title_bn') }}</div>
    @endif
</div>
