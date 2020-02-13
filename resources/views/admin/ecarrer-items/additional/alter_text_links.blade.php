{{-- <div class="form-group col-md-6 {{ $errors->has('call_to_action') ? ' error' : '' }}">
   <label for="alt_text" class="required1">alt_text</label>
   <input type="text" name="alt_text"  class="form-control section_name" placeholder="Section name"
          value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" data-validation-required-message="Please enter text">
   <div class="help-block"></div>
   @if ($errors->has('alt_text'))
       <div class="help-block">  {{ $errors->first('alt_text') }}</div>
   @endif
</div> --}}

<div class="form-group col-md-6 {{ $errors->has('alt_links') ? ' error' : '' }}">
   <label for="alt_links" class="required1">Links</label>
   <input type="url" name="alt_links"  class="form-control section_name" placeholder="Links"
          value="{{ !empty($ecarrer_item->alt_links) ? $ecarrer_item->alt_links : '' }}" required data-validation-required-message="Please enter text">
   <div class="help-block"></div>
   @if ($errors->has('alt_links'))
       <div class="help-block">  {{ $errors->first('alt_links') }}</div>
   @endif
</div>