<div class="form-group col-md-12 {{ $errors->has('play_store_link') ? ' error' : '' }}">
    <label for="media_url" >Play Store Link</label>
    <input type="text" name="attribute[play_store_link][en]"  class="form-control" placeholder="Enter play store link English"
           value="{{ $component->attribute['play_store_link']['en'] ?? '' }}">
    <div class="help-block"></div>
</div>

