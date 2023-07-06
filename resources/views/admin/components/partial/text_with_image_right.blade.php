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
           value="{{ old("title_en") ? old("title_en") : $component->title_en ?? null }}">
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
            value="{{ old("title_bn") ? old("title_bn") : $component->title_bn ?? null }}">
     <div class="help-block"></div>
     @if ($errors->has('title_bn'))
         <div class="help-block">  {{ $errors->first('title_bn') }}</div>
     @endif
 </div>

 <div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (English)</label>
         <textarea name="description_en" class="form-control" rows="5"
                   placeholder="Enter description">{{ old('description_en') ? old('description_en') : $component->description_en ?? null }}</textarea>
     </div>
 </div>

 <div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (Bangla)</label>
         <textarea name="description_bn" class="form-control" rows="5"
                   placeholder="Enter description">{{ old('description_bn') ? old('description_bn') : $component->description_bn ?? null }}</textarea>
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
