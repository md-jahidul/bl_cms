<div class="form-group col-md-4">
    <label for="button_en">Description Title (English)</label>
    <input type="text" name="componentData[{{$key}}][desc_hover][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['desc_hover']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][desc_hover][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][desc_hover][id]" value="{{ $data['desc_hover']['id'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4">
    <label for="button_bn" >Button Title (Bangla)</label>
    <input type="text" name="componentData[{{$key}}][desc_hover][value_bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['desc_hover']['value_bn'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][desc_hover][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][desc_hover][id]" value="{{ $data['desc_hover']['id'] ?? '' }}">
    <div class="help-block"></div>
</div>
