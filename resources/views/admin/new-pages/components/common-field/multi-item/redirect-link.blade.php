<div class="form-group col-md-12 {{ $errors->has('redirect_link') ? ' error' : '' }}">
    <label for="redirect_link" >Redirect Link URL</label>
    <input type="text" name="componentData[{{$key}}][redirect_link][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['redirect_link']['value_en'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][redirect_link][value_en]" value="{{ $key + 1 }}">
    <input type="hidden" name="componentData[{{$key}}][redirect_link][id]" value="{{ $data['redirect_link']['id'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('redirect_link'))
        <div class="help-block">  {{ $errors->first('redirect_link') }}</div>
    @endif
</div>
