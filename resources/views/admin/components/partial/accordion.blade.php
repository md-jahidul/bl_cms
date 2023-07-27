<div class="col-sm-12">
  <div class="slider_top_section">
    <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
          <div class="add_button_wrap float-right">
            <a href="#" class="btn btn-info  btn-glow px-1 add_moreslider_item">+ Add Accordion Item</a>
          </div>
        </div>
    </div>
  </div>
</div>


<div class="col-sm-12">

  <div id="slider_content_section" class="slider_content_section" data-count="1">
    <input id="multi_item_count" type="hidden" name="multi_item_count" value="1">

    <div class="row single_slider_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">

      <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
         <label for="title_en" class="required1">Accordion Title (English)</label>
         <input type="text" name="multi_item[title_en-1]"  class="form-control"
                value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
         <div class="help-block"></div>
         @if ($errors->has('title_en'))
             <div class="help-block">  {{ $errors->first('title_en') }}</div>
         @endif
      </div>

      <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
         <label for="title_bn" class="required1">Accordion Title (Bangla)</label>
         <input type="text" name="multi_item[title_bn-1]"  class="form-control"
                value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
         <div class="help-block"></div>
         @if ($errors->has('title_bn'))
             <div class="help-block">  {{ $errors->first('title_bn') }}</div>
         @endif
      </div>

      <div class="col-md-6">
           <div class="form-group">
               <label for="exampleInputPassword1">Accordion content (English)</label>
               <textarea id="details_en-1" name="multi_item[editor_en-1]" class="form-control <!--accordion_class-->" rows="5"
                         placeholder="Enter description">{{ isset($ecarrer_item->editor_en) ? $ecarrer_item->editor_en : '' }}</textarea>
           </div>
       </div>

       <div class="col-md-6">
           <div class="form-group">
               <label for="exampleInputPassword1">Accordion content (Bangla)</label>
               <textarea id="details_bn-1" name="multi_item[editor_bn-1]" class="form-control accordion_class" rows="5"
                         placeholder="Enter description">{{ isset($ecarrer_item->editor_bn) ? $ecarrer_item->editor_bn : '' }}</textarea>
           </div>
       </div>




      <div class="form-group col-md-6">
        <label for="status"> </label>
          <button class="btn btn-danger multi_item_remove">-</button>
      </div>





    </div>




  </div>

  {{-- <hr class="hr">
  <br> --}}

</div>



@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush

@push('page-js')

<script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
 <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
 <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

<script type="text/javascript">


  jQuery(document).ready(function($){

    // Add multiple item
    $('.add_moreslider_item').on('click', function(){

      var i = parseInt($('#multi_item_count').val(), 10);

      i = i+1;

      var html = '';

      html += '<div class="row single_slider_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;"> <div class="form-group col-md-6"> <label for="title_en" class="required1">Accordion Title (English)</label> <input type="text" name="multi_item[title_en-'+i+']" class="form-control" value="" aria-invalid="false"> <div class="help-block"></div></div><div class="form-group col-md-6 "> <label for="title_bn" class="required1">Accordion Title (Bangla)</label> <input type="text" name="multi_item[title_bn-'+i+']" class="form-control" value=""> <div class="help-block"></div></div><div class="col-md-6"> <div class="form-group"> <label for="exampleInputPassword1">Accordion content (English)</label> <textarea id="details_en-1" name="multi_item[editor_en-'+i+']" class="form-control accordion_class" rows="5" placeholder="Enter description"></textarea> </div></div><div class="col-md-6"> <div class="form-group"> <label for="exampleInputPassword1">Accordion content (Bangla)</label> <textarea id="details_bn-1" name="multi_item[editor_bn-'+i+']" class="form-control accordion_class" rows="5" placeholder="Enter description"></textarea> </div></div><div class="form-group col-md-6"> <label for="status"> </label> <button class="btn btn-danger multi_item_remove">-</button> </div></div>';

      $('#slider_content_section').append(html);



      $('#multi_item_count').val(i);

      makeSummernote();

    });


    $(document).on('click', '.multi_item_remove', function(e){

      e.preventDefault();

      $(this).parents('.row.single_slider_content').remove();

    });





  }); // doc ready

  makeSummernote();

  function makeSummernote(){
    // $(".accordion_class").summernote({
    //     toolbar: [
    //         ['style', ['bold', 'italic', 'underline', 'clear']],
    //         ['font', ['strikethrough', 'superscript', 'subscript']],
    //         ['fontsize', ['fontsize']],
    //         ['color', ['color']],
    //         // ['table', ['table']],
    //         ['para', ['ul', 'ol', 'paragraph']],
    //         ['view', ['fullscreen', 'codeview']]
    //     ],
    //     height:200
    // });
  }


</script>
@endpush
