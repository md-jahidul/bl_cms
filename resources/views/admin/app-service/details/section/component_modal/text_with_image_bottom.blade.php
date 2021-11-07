{{ Form::hidden('sections[section_name]', 'Text with Image Bottom' ) }}
{{ Form::hidden('sections[section_type]', 'text_with_image_bottom' ) }}
{{ Form::hidden('sections[tab_type]', $tab_type ) }}
{{ Form::hidden('sections[category]', 'component_sections' ) }}
{{ Form::hidden('component[0][component_type]', 'text_with_image_bottom' ) }}

<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
    <label for="title_en" class="required1">
        Title (English)
    </label>
    <input type="text" name="component[0][title_en]"  class="form-control" placeholder="Enter title"
           value="{{ isset($component->description_bn) ? $component->description_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('title_en'))
        <div class="help-block">  {{ $errors->first('title_en') }}</div>
    @endif
</div>
<div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn" class="required1">
        Title (Bangla)
    </label>
    <input type="text" name="component[0][title_bn]"  class="form-control" placeholder="Enter title"
           value="{{ isset($component->description_bn) ? $component->description_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('title_bn'))
        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
    @endif
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Description (English)</label>
        <textarea name="component[0][description_en]" class="form-control" rows="5"
                  placeholder="Enter description">{{ isset($component->description_en) ? $component->description_en : '' }}</textarea>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Description (Bangla)</label>
        <textarea name="component[0][description_bn]" class="form-control" rows="5"
                  placeholder="Enter description">{{ isset($component->description_bn) ? $component->description_bn : '' }}</textarea>
    </div>
</div>
<div class="form-group col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}">
    <label for="alt_text" class="">Image (optional)</label>
    <div class="custom-file">
        <input type="file" name="component[0][image_url]" class="dropify"
               data-default-file="{{ isset($component->image) ?  config('filesystems.file_base_url') . $component->image : null  }}">
    </div>
    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

    <div class="help-block"></div>
    @if ($errors->has('image_url'))
        <div class="help-block">  {{ $errors->first('image_url') }}</div>
    @endif
</div>
<div class="form-group col-md-3 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label for="alt_text" class="required1">Alt Text English</label>
    <input type="text" name="component[0][alt_text]"  class="form-control"
           value="{{ isset($component->alt_text) ? $component->alt_text : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('alt_text'))
        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
    @endif
</div>

<div class="form-group col-md-3 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
    <label for="alt_text" class="required1">Alt text Bangla</label>
    <input type="text" name="component[0][alt_text_bn]"  class="form-control"
           value="{{ isset($component->alt_text_bn) ? $component->alt_text_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('alt_text_bn'))
        <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('image_name_en') ? ' error' : '' }}">
    <label for="image_name_en" class="required1">Image Name English</label>
    <input type="text" name="component[0][image_name_en]"  class="form-control"
           value="{{ isset($component->image_name_en) ? $component->image_name_en : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('image_name_en'))
        <div class="help-block">  {{ $errors->first('image_name_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
    <label for="image_name_bn" class="required1">Image Name Bangla</label>
    <input type="text" name="component[0][image_name_bn]"  class="form-control"
           value="{{ isset($component->image_name_bn) ? $component->image_name_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('image_name_bn'))
        <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
    @endif
</div>
