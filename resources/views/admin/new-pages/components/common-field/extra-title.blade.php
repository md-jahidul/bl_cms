<div class="form-group col-md-6 {{ $errors->has('extra_title_en') ? ' error' : '' }}">
    <label for="extra_title_en">{{ isset($title_en) ? $title_en : "Extra Title (English)" }}</label>
    <input type="text" name="extra_title_en"  class="form-control" placeholder="Enter extra title in English"
    value="{{ isset($component->extra_title_en) ? $component->extra_title_en : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('extra_title_en'))
        <div class="help-block">{{ $errors->first('extra_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('extra_title_bn') ? ' error' : '' }}">
    <label for="extra_title_bn">{{ isset($title_bn) ? $title_bn : "Extra Title (Bangla)" }}</label>
    <input type="text" name="extra_title_bn"  class="form-control" placeholder="Enter extra title in Bangla"
    value="{{ isset($component->extra_title_bn) ? $component->extra_title_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('extra_title_bn'))
        <div class="help-block">{{ $errors->first('extra_title_bn') }}</div>
    @endif
</div>
