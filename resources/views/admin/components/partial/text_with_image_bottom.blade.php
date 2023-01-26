{{-- <div class="form-group col-md-6 {{ $errors->has('alt_links') ? ' error' : '' }}">
   <label for="alt_links" class="required1">Links</label>
   <input type="url" name="alt_links"  class="form-control section_name" placeholder="Links"
          value="{{ !empty($ecarrer_item->alt_links) ? $ecarrer_item->alt_links : '' }}" required data-validation-required-message="Please enter text">
   <div class="help-block"></div>
   @if ($errors->has('alt_links'))
       <div class="help-block">  {{ $errors->first('alt_links') }}</div>
   @endif
</div> --}}


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
         <textarea name="description_en" class="form-control" rows="5"
                   placeholder="Enter description">{{ isset($ecarrer_item->description_en) ? $ecarrer_item->description_en : '' }}</textarea>
     </div>
 </div>

 <div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (Bangla)</label>
         <textarea name="description_bn" class="form-control" rows="5"
                   placeholder="Enter description">{{ isset($ecarrer_item->description_bn) ? $ecarrer_item->description_bn : '' }}</textarea>
     </div>
 </div>

<div class="form-group col-md-5 {{ $errors->has('image_url') ? ' error' : '' }}">
    <label for="alt_text" class="">Image (optional)</label>
    <div class="custom-file">
        <input type="file" name="image_url" class="custom-file-input" id="image">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

    <div class="help-block"></div>
    @if ($errors->has('image_url'))
        <div class="help-block">  {{ $errors->first('image_url') }}</div>
    @endif
</div>

<div class="form-group col-md-1">
    <img style="height:70px;width:70px;display:none" id="imgDisplay">
</div>

<div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label for="alt_text" class="required1">Alt text</label>
    <input type="text" name="alt_text"  class="form-control"
           value="{{ old("alt_text") ? old("alt_text") : $component->alt_text ?? null }}">
    <div class="help-block"></div>
    @if ($errors->has('alt_text'))
        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('google_play_link') ? ' error' : '' }}">
    <label for="title">Google Play Store Link</label>
    <input type="text" name="other_attributes[google_play_link]"  class="form-control" placeholder="Enter play store link"
        value="{{ (!empty($component->other_attributes['google_play_link'])) ? $component->other_attributes['google_play_link'] : old("other_attributes.google_play_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('google_play_link'))
        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
    @endif
</div>


<div class="form-group col-md-6 {{ $errors->has('app_store_link') ? ' error' : '' }}">
    <label for="title">App Store Link</label>
    <input type="text" name="other_attributes[app_store_link]"  class="form-control" placeholder="Enter app store link"
        value="{{ (!empty($component->other_attributes['app_store_link'])) ? $component->other_attributes['app_store_link'] : old("other_attributes.app_store_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('app_store_link'))
        <div class="help-block">  {{ $errors->first('app_store_link') }}</div>
    @endif
</div>
