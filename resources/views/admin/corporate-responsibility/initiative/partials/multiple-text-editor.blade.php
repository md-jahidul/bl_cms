<div class="form-group col-md-6 {{ $errors->has('editor_en') ? ' error' : '' }}">
    <label for="editor_en">Text Editor (English)</label>
    <textarea type="text" name="details_en[]"  class="form-control summernote_editor" placeholder="Enter offer details in english">{{ isset($component->editor_en) ? $component->editor_en : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('editor_en'))
        <div class="help-block">{{ $errors->first('editor_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('editor_bn') ? ' error' : '' }}">
    <label for="editor_bn">Text Editor (Bangla)</label>
    <textarea type="text" name="details_bn[]"  class="form-control summernote_editor" placeholder="Enter offer details in english" >{{ isset($component->editor_bn) ? $component->editor_bn : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('editor_bn'))
        <div class="help-block">{{ $errors->first('editor_bn') }}</div>
    @endif
</div>
