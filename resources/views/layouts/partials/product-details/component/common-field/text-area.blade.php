<div class="form-group col-md-12 {{ $errors->has('description_en') ? ' error' : '' }}">
    <label for="description_en" >Text Area (English)</label>
    <textarea name="description_en"  class="form-control summernote_editor" placeholder="Enter company name bangla">{{ isset($component->description_en) ? $component->description_en : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_en'))
        <div class="help-block">  {{ $errors->first('description_en') }}</div>
    @endif
</div>


<div class="form-group col-md-12 {{ $errors->has('description_bn') ? ' error' : '' }}">
    <label for="description_bn" >Text Area (Bangla)</label>
    <textarea name="description_bn"  class="form-control summernote_editor" placeholder="Enter company name bangla">{{ isset($component->description_bn) ? $component->description_bn : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_bn'))
        <div class="help-block">  {{ $errors->first('description_bn') }}</div>
    @endif
</div>
