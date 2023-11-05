<div class="form-group col-md-6">
    <label for="alt_text">Video URL</label>
    <input type="text" value="{{ isset($component->video) ? $component->video : '' }}"
          placeholder="Enter embed video URL" name="video" class="form-control">
    <span class="text-primary">Ex: https://www.youtube.com/embed/m5r-chnFIaI</span>
</div>

<div class="form-group col-md-6">
    <label for="alt_text">Alt Text</label>
    <input type="text" value="{{ isset($component->alt_text) ? $component->alt_text : '' }}" name="alt_text"  class="form-control">
</div>
