<div class="form-group col-md-4 {{ $errors->has('button_en') ? ' error' : '' }}">
    <label for="button_en">Button Title (English)</label>
    <input type="text" name="componentData[{{$key}}][button_name][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_name']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][button_name][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][button_name][id]" value="{{ $data['button_name']['id'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('button_en'))
        <div class="help-block">  {{ $errors->first('button_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_bn') ? ' error' : '' }}">
    <label for="button_bn" >Button Title (Bangla)</label>
    <input type="text" name="componentData[{{$key}}][button_name][value_bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_name']['value_bn'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][button_name][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][button_name][id]" value="{{ $data['button_name']['id'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('button_bn'))
        <div class="help-block">  {{ $errors->first('button_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_link') ? ' error' : '' }}">
    <label for="button_link" >Button URL</label>
    <input type="text" name="componentData[{{$key}}][button_link][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_link']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][button_link][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][button_link][id]" value="{{ $data['button_link']['id'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('button_link'))
        <div class="help-block">  {{ $errors->first('button_link') }}</div>
    @endif
</div>
