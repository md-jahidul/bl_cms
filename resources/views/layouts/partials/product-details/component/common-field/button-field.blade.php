<div class="form-group col-md-4 {{ $errors->has('button_en') ? ' error' : '' }}">
    <label for="button_en">Button Title (English)</label>
    <input type="text" name="button_en"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($component->button_en) ? $component->button_en : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('button_en'))
        <div class="help-block">  {{ $errors->first('button_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_bn') ? ' error' : '' }}">
    <label for="button_bn" >Button Title (Bangla)</label>
    <input type="text" name="button_bn"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($component->button_bn) ? $component->button_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('button_bn'))
        <div class="help-block">  {{ $errors->first('button_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_link') ? ' error' : '' }}">
    <label for="button_link" >Button URL</label>
    <input type="text" name="button_link"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($component->button_link) ? $component->button_link : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('button_link'))
        <div class="help-block">  {{ $errors->first('button_link') }}</div>
    @endif
</div>
