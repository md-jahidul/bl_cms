    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
        <label for="title_en" class="required1">
            Title (English)
        </label>
        <input type="text" name="title_en"  class="form-control section_name" placeholder="Enter title"
               value="{{ old("title_en") ? old("title_en") : '' }}">
        <div class="help-block"></div>
        @if ($errors->has('title_en'))
            <div class="help-block">  {{ $errors->first('title_en') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
     <label for="title_bn" class="required1">
         Title (Bangla)
     </label>
     <input type="text" name="title_bn"  class="form-control section_name" placeholder="Enter title"
            value="{{ old("title_bn") ? old("title_bn") : '' }}">
     <div class="help-block"></div>
     @if ($errors->has('title_bn'))
         <div class="help-block">  {{ $errors->first('title_bn') }}</div>
     @endif
    </div>



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
