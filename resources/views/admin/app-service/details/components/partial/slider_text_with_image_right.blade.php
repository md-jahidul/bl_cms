{{-- <div class="form-group col-md-6 {{ $errors->has('alt_links') ? ' error' : '' }}">
   <label for="alt_links" class="required1">Links</label>
   <input type="url" name="alt_links"  class="form-control section_name" placeholder="Links"
          value="{{ !empty($ecarrer_item->alt_links) ? $ecarrer_item->alt_links : '' }}" required data-validation-required-message="Please enter text">
   <div class="help-block"></div>
   @if ($errors->has('alt_links'))
       <div class="help-block">  {{ $errors->first('alt_links') }}</div>
   @endif
</div> --}}


<div class="col-sm-12">
  <div class="slider_top_section">
    <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
          <div class="add_button_wrap float-right">
            <a href="#" class="btn btn-info  btn-glow px-1 add_moreslider_item">+ Add</a>
          </div>
        </div>
    </div>
  </div>
</div>


<div class="col-sm-12">
  
  <div id="slider_content_section" class="slider_content_section">

    <div class="row single_slider_content">
      
      <div class="form-group col-md-4 {{ $errors->has('title_en') ? ' error' : '' }}">
         <label for="title_en" class="required1">Title (English)</label>
         <input type="text" name="title_en[]"  class="form-control section_name" placeholder="Title"
                value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" required data-validation-required-message="Please enter text">
         <div class="help-block"></div>
         @if ($errors->has('title_en'))
             <div class="help-block">  {{ $errors->first('title_en') }}</div>
         @endif
      </div>

      <div class="form-group col-md-4 {{ $errors->has('title_bn') ? ' error' : '' }}">
         <label for="title_bn" class="required1">Title (Bangla)</label>
         <input type="text" name="title_bn[]"  class="form-control section_name" placeholder="Title"
                value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" required data-validation-required-message="Please enter text">
         <div class="help-block"></div>
         @if ($errors->has('title_bn'))
             <div class="help-block">  {{ $errors->first('title_bn') }}</div>
         @endif
      </div>


      <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
          <label for="alt_text" class="">Image (optional)</label>
          <div class="custom-file">
              <input type="file" name="image_url[]" class="custom-file-input" id="image">
              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
          </div>
          <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

          <div class="help-block"></div>
          @if ($errors->has('image_url'))
              <div class="help-block">  {{ $errors->first('image_url') }}</div>
          @endif
      </div>

      {{-- <div class="form-group col-md-1">
          <img style="height:70px;width:70px;display:none" id="imgDisplay">
      </div> --}}


      



    </div>

    <hr class="hr">
    <br>


  </div>

</div>


@push('page-js')
<script type="text/javascript">
  
  
  jQuery(document).ready(function($){

    $('.add_moreslider_item').on('click', function(){

      var firstItem = $('#slider_content_section').children(':first-child').clone();

      $('#slider_content_section').append(firstItem);

      console.log(firstItem);

    });

  });



</script>
@endpush