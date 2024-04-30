<div class="form-group col-md-6">
    <label for="button_en">Description (English)</label>
    <textarea type="text" name="componentData[{{$key}}][desc_hover][value_en]"  class="form-control" placeholder="Enter company name bangla">{{ $data['desc_hover']['value_en'] ?? '' }}</textarea>
    <input type="hidden" name="componentData[{{$key}}][desc_hover][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][desc_hover][id]" value="{{ $data['desc_hover']['id'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6">
    <label for="button_bn" >Description (Bangla)</label>
    <textarea type="text" name="componentData[{{$key}}][desc_hover][value_bn]"  class="form-control" placeholder="Enter company name bangla">{{ $data['desc_hover']['value_bn'] ?? '' }}</textarea>
    <input type="hidden" name="componentData[{{$key}}][desc_hover][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][desc_hover][id]" value="{{ $data['desc_hover']['id'] ?? '' }}">
    <div class="help-block"></div>
</div>
