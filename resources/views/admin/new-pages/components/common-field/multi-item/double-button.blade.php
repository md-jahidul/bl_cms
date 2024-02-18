<div class="form-group col-md-4">
    <label for="button_en">Button One Title (English)</label>
    <input type="text" name="componentData[{{ $key }}][button_one_name][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_one_name']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{ $key }}][button_one_name][id]" value="{{ $data['button_one_name']['id'] ?? '' }}">
</div>

<div class="form-group col-md-4">
    <label for="button_bn" >Button One Title (Bangla)</label>
    <input type="text" name="componentData[{{ $key }}][button_one_name][value_bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_one_name']['value_bn'] ?? '' }}">
    <input type="hidden" name="componentData[{{ $key }}][button_one_name][id]" value="{{ $data['button_one_name']['id'] ?? '' }}">
</div>

<div class="form-group col-md-4">
    <label for="button_link" >Button One URL</label>
    <input type="text" name="componentData[{{ $key }}][button_one_link][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_one_link']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{ $key }}][button_one_link][id]" value="{{ $data['button_one_link']['id'] ?? '' }}">
</div>

<div class="form-group col-md-4">
    <label for="button_en">Button One Title (English)</label>
    <input type="text" name="componentData[{{ $key }}][button_two_name][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_two_name']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{ $key }}][button_two_name][id]" value="{{ $data['button_two_name']['id'] ?? '' }}">
</div>

<div class="form-group col-md-4">
    <label for="button_bn" >Button One Title (Bangla)</label>
    <input type="text" name="componentData[{{ $key }}][button_two_name][value_bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_two_name']['value_bn'] ?? '' }}">
    <input type="hidden" name="componentData[{{ $key }}][button_two_name][id]" value="{{ $data['button_two_name']['id'] ?? '' }}">
</div>

<div class="form-group col-md-4">
    <label for="button_link" >Button One URL</label>
    <input type="text" name="componentData[{{ $key }}][button_two_link][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_two_link']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{ $key }}][button_two_link][id]" value="{{ $data['button_two_link']['id'] ?? '' }}">
</div>
