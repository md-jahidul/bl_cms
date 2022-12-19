{{-- <div class="form-group col-md-6 {{ $errors->has('alt_links') ? ' error' : '' }}">
   <label for="alt_links" class="required1">Links</label>
   <input type="url" name="alt_links"  class="form-control section_name" placeholder="Links"
          value="{{ !empty($ecarrer_item->alt_links) ? $ecarrer_item->alt_links : '' }}" required data-validation-required-message="Please enter text">
   <div class="help-block"></div>
   @if ($errors->has('alt_links'))
       <div class="help-block">  {{ $errors->first('alt_links') }}</div>
   @endif
</div> --}}


<div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (English)</label>
         <textarea name="editor_en" class="form-control summernote_editor" rows="5"
                   placeholder="Enter description">{{ isset($ecarrer_item->editor_en) ? $ecarrer_item->editor_en : '' }}</textarea>
     </div>
 </div>

 <div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (Bangla)</label>
         <textarea name="editor_bn" class="form-control summernote_editor" rows="5"
                   placeholder="Enter description">{{ isset($ecarrer_item->editor_bn) ? $ecarrer_item->editor_bn : '' }}</textarea>
     </div>
 </div>
