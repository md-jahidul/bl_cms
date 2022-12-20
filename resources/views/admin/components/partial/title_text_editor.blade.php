    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
        <label for="title_en" class="required1">
            Title (English)
        </label>
        <input type="text" name="title_en"  class="form-control section_name" placeholder="Enter title"
               value="{{ $component->title_en ?? null }}">
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
            value="{{ $component->title_bn ?? null }}">
     <div class="help-block"></div>
     @if ($errors->has('title_bn'))
         <div class="help-block">  {{ $errors->first('title_bn') }}</div>
     @endif
    </div>

    <div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (English)</label>
         <textarea name="editor_en" class="form-control summernote_editor" rows="5"
                   placeholder="Enter description">{{ $component->editor_en ?? null }}</textarea>
     </div>
    </div>

    <div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (Bangla)</label>
         <textarea name="editor_bn" class="form-control summernote_editor" rows="5"
                   placeholder="Enter description">{{ $component->editor_bn ?? null }}</textarea>
     </div>
    </div>
