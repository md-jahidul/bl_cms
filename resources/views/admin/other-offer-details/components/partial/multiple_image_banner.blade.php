<div class="col-sm-12">
  <div class="slider_top_section">
    <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
          <div class="add_button_wrap float-right">
            <a href="#" class="btn btn-info  btn-glow px-1 add_moreslider_item">+ Add Image</a>
          </div>
        </div>
    </div>
  </div>
</div>


<div class="col-sm-12">
  
  <div id="slider_content_section" class="slider_content_section" data-count="1">
    <input id="multi_item_count" type="hidden" name="multi_item_count" value="1">

    <div class="row single_slider_content">
      
      <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
          <label for="alt_text" class="">Image (optional)</label>
          <div class="custom-file">
              <input type="file" name="multi_item[image_url-1]" class="custom-file-input" id="image">
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


      <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
         <label for="alt_text" class="required1">Alt Text</label>
         <input type="text" name="multi_item[alt_text-1]"  class="form-control"
                value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >
         <div class="help-block"></div>
         @if ($errors->has('alt_text'))
             <div class="help-block">  {{ $errors->first('alt_text') }}</div>
         @endif
      </div>

      <div class="form-group col-md-2">
          <label for="status">Status</label>
          <select class="form-control" name="multi_item[status-1]" aria-invalid="false">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
          </select>
          
      </div>
      

      <div class="form-group">
        <label for="status" style="padding-bottom: 43px;"> </label>
          <button class="btn btn-danger multi_item_remove">-</button>
      </div>

      



    </div>

    


  </div>

  <hr class="hr">
  <br>

</div>


@push('page-js')
<script type="text/javascript">
  
  
  jQuery(document).ready(function($){

    // Add multiple item
    $('.add_moreslider_item').on('click', function(){

      var i = parseInt($('#multi_item_count').val(), 10);

      i = i+1;

      var html = '';
      
      html += '<div class="row single_slider_content"><div class="form-group col-md-4"> <label for="alt_text" class="">Image (optional)</label><div class="custom-file"> <input type="file" name="multi_item[image_url-'+i+']" class="custom-file-input" id="image" aria-invalid="false"> <label class="custom-file-label" for="inputGroupFile01">Choose file</label></div> <span class="text-primary">Please given file type (.png, .jpg, svg)</span><div class="help-block"></div></div><div class="form-group col-md-1"> <img style="height:70px;width:70px;display:none" id="imgDisplay"></div><div class="form-group col-md-4 "> <label for="alt_text" class="required1">Alt Text</label> <input type="text" name="multi_item[alt_text-'+i+']" class="form-control" value=""><div class="help-block"></div></div><div class="form-group col-md-2"> <label for="status">Status</label> <select class="form-control" name="multi_item[status-'+i+']" aria-invalid="false"><option value="1">Active</option><option value="0">Inactive</option> </select></div><div class="form-group"> <label for="status" style="padding-bottom: 43px;"> </label> <button class="btn btn-danger multi_item_remove">-</button></div></div>';

      $('#slider_content_section').append(html);

      

      $('#multi_item_count').val(i);


    });


    $(document).on('click', '.multi_item_remove', function(e){

      e.preventDefault();

      $(this).parents('.row.single_slider_content').remove();

    });

  }); // doc ready



</script>
@endpush