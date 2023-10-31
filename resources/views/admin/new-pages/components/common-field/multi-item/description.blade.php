<div class="form-group col-md-6">
    <label for="title_en">Description En</label>
    <textarea type="text" rows="3" name="componentData[{{$key}}][desc][value_en]" class="form-control">{{ $data['desc']['value_en'] ?? '' }}</textarea>
    <input type="hidden" name="componentData[{{$key}}][desc][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][desc][id]" value="{{ $data['desc']['id'] ?? '' }}">
</div>

<div class="form-group col-md-6">
    <label for="title_en">Description Bn</label>
    <textarea type="text" rows="3" name="componentData[{{$key}}][desc][value_bn]" class="form-control">{{ $data['desc']['value_bn'] ?? '' }}</textarea>
    <input type="hidden" name="componentData[{{$key}}][desc][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][desc][id]" value="{{ $data['desc']['id'] ?? '' }}">
</div>
