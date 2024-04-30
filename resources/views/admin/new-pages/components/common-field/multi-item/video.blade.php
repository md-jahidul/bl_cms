<div class="form-group col-md-12">
    <label for="video_url" >Video URL</label>
    <input type="text" name="componentData[{{$key}}][video_url][value_en]"  class="form-control" placeholder="Enter video url"
           value="{{ $data['video_url']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][video_url][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][video_url][id]" value="{{ $data['video_url']['id'] ?? '' }}">
</div>
