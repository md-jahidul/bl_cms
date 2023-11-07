<div class="form-group col-md-12 {{ $errors->has('url') ? ' error' : '' }}">
    <label for="url" >URL</label>
    <input type="text" name="componentData[{{$key}}][url][value_en]"  class="form-control" placeholder="Enter URL"
           value="{{ $data['url']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][url][group]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][url][id]" value="{{ $data['url']['id'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('url'))
        <div class="help-block">  {{ $errors->first('url') }}</div>
    @endif
</div>
