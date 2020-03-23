<!-- Modal -->
<div class="modal fade" id="editor_only_section" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal_xl_custom " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel"><strong>Component: Text with image right</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form id="product_details_form" role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">
                @csrf
              <div class="modal-body">
                <div class="row">

                		{{ Form::hidden('sections[section_name]', 'Editor' ) }}
                		{{ Form::hidden('sections[section_type]', 'editor_only_section' ) }}
                		{{ Form::hidden('sections[tab_type]', $tab_type ) }}
                		{{ Form::hidden('sections[category]', 'component_sections' ) }}
                		{{ Form::hidden('component[0][component_type]', 'editor_only' ) }}


                    <div class="col-md-6">
                       <div class="form-group">
                           <label for="exampleInputPassword1">Editor (English)</label>
                           <textarea name="component[0][editor_en]" class="form-control js_editor_box" rows="5"
                                     placeholder="Enter description">{{ isset($ecarrer_item->editor_en) ? $ecarrer_item->editor_en : '' }}</textarea>
                       </div>
                     </div>

                     <div class="col-md-6">
                       <div class="form-group">
                           <label for="exampleInputPassword1">Editor (Bangla)</label>
                           <textarea name="component[0][editor_bn]" class="form-control js_editor_box" rows="5"
                                     placeholder="Enter description">{{ isset($ecarrer_item->editor_bn) ? $ecarrer_item->editor_bn : '' }}</textarea>
                       </div>
                     </div>

							
      							<div class="col-md-6">
      							    <div class="form-group">
      							        <label for="title" class="mr-1">Status:</label>
      							        <input type="radio" name="sections[status]" value="1" id="active" checked>
      							        <label for="active" class="mr-1">Active</label>

      							        <input type="radio" name="sections[status]" value="0" id="inactive">
      							        <label for="inactive">Inactive</label>
      							    </div>
      							</div>

      							<div class="form-group col-md-6">
      									<!-- 0 - NO, 1 - Yes : Component has multiple component or not -->
      									{{ Form::hidden('sections[multiple_component]', 0 ) }}
      							</div>

                    

                </div>

              </div>
              <div class="modal-footer">
              		{{ Form::hidden('sections[id]', null, ['class' => 'section_id'] ) }}
              		{{ Form::hidden('component[0][id]', null, ['class' => 'component_id'] ) }}

                <a type="button" href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <button id="form_save" type="submit" name="save" class="btn btn-primary">Save changes</button>
                <button id="form_update" type="submit" name="update" class="btn btn-primary" style="display: none;">Update</button>
              </div>
          </form>
        </div>
    </div>
</div><!-- /.modal -->
<!-- Modal -->


@push('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
 <style>
     .modal-xl.modal_xl_custom {
         max-width: 80%;
         margin-left: 10%;
       	margin-right: 10%;
     }
 </style>
@endpush



@push('page-js')
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

 <script>
     $(function () {

         $('.js_editor_box').each(function(k, v){
            $(this).summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    // ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                height:200
            });
         });

     })
 </script>
 @endpush