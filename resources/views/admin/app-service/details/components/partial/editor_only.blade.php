{{-- <div class="form-group col-md-6 {{ $errors->has('alt_links') ? ' error' : '' }}">
   <label for="alt_links" class="required1">Links</label>
   <input type="url" name="alt_links"  class="form-control section_name" placeholder="Links"
          value="{{ !empty($ecarrer_item->alt_links) ? $ecarrer_item->alt_links : '' }}" required data-validation-required-message="Please enter text">
   <div class="help-block"></div>
   @if ($errors->has('alt_links'))
       <div class="help-block">  {{ $errors->first('alt_links') }}</div>
   @endif
</div> --}}

{{ Form::hidden('sections[section_name]', 'Table Component' ) }}
{{ Form::hidden('sections[section_type]', 'table_component' ) }}
{{ Form::hidden('sections[tab_type]', $tab_type ) }}
{{ Form::hidden('sections[category]', 'component_sections' ) }}
{{ Form::hidden('component[0][component_type]', 'table_component' ) }}


<div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (English)</label>
         <textarea name="component[0][editor_en]" class="form-control summernote_editor" rows="5"
                   placeholder="Enter description">{{ isset($component->editor_en) ? $component->editor_en : '' }}</textarea>
     </div>
 </div>

 <div class="col-md-6">
     <div class="form-group">
         <label for="exampleInputPassword1">Description (Bangla)</label>
         <textarea name="component[0][editor_bn]" class="form-control summernote_editor" rows="5"
                   placeholder="Enter description">{{ isset($component->editor_bn) ? $component->editor_bn : '' }}</textarea>
     </div>
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


 <script>
     $(function () {
         // $("textarea#details_en").summernote({
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
         //
         // $("textarea#details_bn").summernote({
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

         // $('#design_structure').change(function () {
         //     if($(this).val() === 'structure_1') {
         //         // alert($(this).val());
         //         $('#structure_1').show();
         //         $('#structure_2').hide();
         //     }else if ($(this).val() === 'structure_2'){
         //         $('#structure_2').show();
         //         $('#structure_1').hide();
         //     }
         // })
         //
         // $('#save').click(function () {
         //
         //     $(this).submit();
         // })

     })
 </script>
 @endpush
