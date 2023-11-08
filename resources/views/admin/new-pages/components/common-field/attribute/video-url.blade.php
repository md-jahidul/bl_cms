<div class="form-group col-md-12 {{ $errors->has('media_url') ? ' error' : '' }}">
    <label for="media_url" >Video URL</label>
    <input type="text" name="attribute[media_url][en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $component->attribute['media_url']['en'] ?? '' }}">
    <div class="help-block"></div>
</div>

