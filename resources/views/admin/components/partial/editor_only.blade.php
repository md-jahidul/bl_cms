<div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (English)</label>
         <textarea name="editor_en" class="form-control summernote_editor" rows="5"
                   placeholder="Enter description">{{ isset($component->editor_en) ? $component->editor_en : '' }}</textarea>
     </div>
 </div>

 <div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (Bangla)</label>
         <textarea name="editor_bn" class="form-control summernote_editor" rows="5"
                   placeholder="Enter description">{{ isset($component->editor_bn) ? $component->editor_bn : '' }}</textarea>
     </div>
 </div>
