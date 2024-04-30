<div class="form-group col-md-6">
    <label for="title_en">{{ $label ?? "Free Text" }} En</label>
    <input type="text" name="componentData[{{$key}}][{{ $fieldName ?? "free_text" }}][value_en]" class="form-control"
           value="{{ $data[$fieldName]['value_en'] ?? '' }}">
</div>
<div class="form-group col-md-6">
    <label for="title_bn">{{ $label ?? "Free Text" }} Bn</label>
    <input type="text" name="componentData[{{$key}}][{{ $fieldName ?? "free_text" }}][value_bn]" class="form-control"
           value="{{ $data[$fieldName]['value_bn'] ?? '' }}">
</div>
