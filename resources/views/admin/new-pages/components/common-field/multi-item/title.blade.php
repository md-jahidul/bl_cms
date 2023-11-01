<div class="form-group col-md-6">
    <label for="title_en">Title En</label>
    <input type="text" name="componentData[{{$key}}][title][value_en]" class="form-control"
           value="{{ $data['title']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][title][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][title][id]" value="{{ $data['title']['id'] ?? '' }}">
</div>

<div class="form-group col-md-6">
    <label for="title_en">Title Bn</label>
    <input type="text" name="componentData[{{$key}}][title][value_bn]" class="form-control"
           value="{{ $data['title']['value_bn'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][title][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][title][id]" value="{{ $data['title']['id'] ?? '' }}">
</div>
