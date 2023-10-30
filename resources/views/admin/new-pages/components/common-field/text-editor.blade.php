<div class="form-group col-md-6 {{ $errors->has('desc_en') ? ' error' : '' }}">
    <label for="desc_en">Description (English)</label>
    <textarea type="text" name="attribute[desc_en]"  class="form-control summernote_editor" placeholder="Enter offer details in english">{{ $component->attribute['desc_en'] ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('desc_en'))
        <div class="help-block">{{ $errors->first('desc_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('desc_bn') ? ' error' : '' }}">
    <label for="desc_bn">Description (Bangla)</label>
    <textarea type="text" name="attribute[desc_bn]"  class="form-control summernote_editor" placeholder="Enter offer details in english" >{{ $component->attribute['desc_bn'] ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('desc_bn'))
        <div class="help-block">{{ $errors->first('desc_bn') }}</div>
    @endif
</div>
