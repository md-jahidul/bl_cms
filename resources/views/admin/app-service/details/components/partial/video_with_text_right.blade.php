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


 <div class="form-group col-md-6 ">
     <label for="description_en">Description (English)</label>
     <textarea type="text" name="description_en" id="vat" class="form-control" placeholder="Enter description in English"
     >{{ old("description_en") ? old("description_en") : '' }}</textarea>
     <div class="help-block"></div>
 </div>

 <div class="form-group col-md-6 ">
     <label for="description_bn">Description (Bangla)</label>
     <textarea type="text" name="description_bn" id="vat" class="form-control" placeholder="Enter description in Bangla"
     >{{ old("description_bn") ? old("description_bn") : '' }}</textarea>
     <div class="help-block"></div>
 </div>


 <div class="form-group col-md-6">
     <label for="tag_category_id" class="required">Select Video Type</label>
     <select class="form-control" name="app_service_video_type">
             <option value="uploaded_video">Upload video</option>
             <option value="youtube_video">Youtube video link</option>
     </select>
     <div class="help-block"></div>
     @if ($errors->has('app_service_video_type'))
         <div class="help-block">{{ $errors->first('app_service_video_type') }}</div>
     @endif
 </div>



<div class="form-group col-md-6 {{ $errors->has('video_url') ? ' error' : '' }}">
    <label for="alt_text" class="">Uplaod Video_url (optional)</label>
    <div class="custom-file">
        <input type="file" name="video_url" class="custom-file-input" id="image">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
    <span class="text-primary">Please given file type (.mp4)</span>

    <div class="help-block"></div>
    @if ($errors->has('video_url'))
        <div class="help-block">  {{ $errors->first('video_url') }}</div>
    @endif
</div>


<div class="form-group col-md-6 {{ $errors->has('video_url') ? ' error' : '' }}">
    <label for="video_url" class="required1">Youtube video link</label>
    <input type="text" name="video_url"  class="form-control"
           value="{{ old("video_url") ? old("video_url") : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('video_url'))
        <div class="help-block">  {{ $errors->first('video_url') }}</div>
    @endif
</div>