<div class="form-group col-md-6 {{ $errors->has('desc_en') ? ' error' : '' }}">
    <label for="desc_en">Description (English)</label>
    <textarea type="text" name="attribute[desc][en]"  class="form-control {{ $is_editor ? 'summernote_editor' : ''}}" placeholder="Enter offer details in english">{{ $component->attribute['desc']['en'] ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('desc_en'))
        <div class="help-block">{{ $errors->first('desc_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('desc_bn') ? ' error' : '' }}">
    <label for="desc_bn">Description (Bangla)</label>
    <textarea type="text" name="attribute[desc][bn]"  class="form-control {{ $is_editor ? 'summernote_editor' : ''}}" placeholder="Enter offer details in english" >{{ $component->attribute['desc']['bn'] ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('desc_bn'))
        <div class="help-block">{{ $errors->first('desc_bn') }}</div>
    @endif
</div>
