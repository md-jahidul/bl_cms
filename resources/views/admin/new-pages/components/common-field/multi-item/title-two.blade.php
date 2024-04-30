<div class="form-group col-md-6">
    <label for="title_en">Title Hover En</label>
    <input type="text" name="componentData[{{$key}}][title_hover][value_en]" class="form-control"
           value="{{ $data['title_hover']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][title_hover][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][title_hover][id]" value="{{ $data['title_hover']['id'] ?? '' }}">
    <!-- <input type="hidden" name="componentData[0][title][group]" value="1" data-role="group">-->
</div>

<div class="form-group col-md-6">
    <label for="title_en">Title Hover Bn</label>
    <input type="text" name="componentData[{{$key}}][title_hover][value_bn]" class="form-control"
           value="{{ $data['title_hover']['value_bn'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][title_hover][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][title_hover][id]" value="{{ $data['title_hover']['id'] ?? '' }}">
</div>
