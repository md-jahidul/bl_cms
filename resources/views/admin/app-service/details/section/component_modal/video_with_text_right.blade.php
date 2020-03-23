<!-- Modal -->
<div class="modal fade" id="video_with_text_right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                		{{ Form::hidden('sections[section_name]', 'Video with text right' ) }}
                     {{ Form::hidden('sections[section_type]', 'video_with_text_right' ) }}
                		{{ Form::hidden('sections[tab_type]', $tab_type ) }}
                		{{ Form::hidden('sections[category]', 'component_sections' ) }}
                		{{ Form::hidden('component[0][component_type]', 'video_with_text_right' ) }}

                
                
                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                    <label for="title_en" class="required1">
                        Header Main Title (English)
                    </label>
                    <input type="text" name="sections[title_en]"  class="form-control section_name" placeholder="Enter title"
                           value="{{ old("title_en") ? old("title_en") : '' }}">
                    <div class="help-block"></div>
                    @if ($errors->has('title_en'))
                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                    @endif
                </div>


                 <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                     <label for="title_bn" class="required1">
                         Header Main Title (Bangla)
                     </label>
                     <input type="text" name="sections[title_bn]"  class="form-control section_name" placeholder="Enter title"
                            value="{{ old("title_bn") ? old("title_bn") : '' }}">
                     <div class="help-block"></div>
                     @if ($errors->has('title_bn'))
                         <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                     @endif
                 </div>




							<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
							    <label for="title_en" class="required1">
							        Component Title (English)
							    </label>
							    <input type="text" name="component[0][title_en]"  class="form-control" placeholder="Enter title"
							           value="{{ old("title_en") ? old("title_en") : '' }}">
							    <div class="help-block"></div>
							    @if ($errors->has('title_en'))
							        <div class="help-block">  {{ $errors->first('title_en') }}</div>
							    @endif
							</div>


							 <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
							     <label for="title_bn" class="required1">
							         Component Title (Bangla)
							     </label>
							     <input type="text" name="component[0][title_bn]"  class="form-control" placeholder="Enter title"
							            value="{{ old("title_bn") ? old("title_bn") : '' }}">
							     <div class="help-block"></div>
							     @if ($errors->has('title_bn'))
							         <div class="help-block">  {{ $errors->first('title_bn') }}</div>
							     @endif
							 </div>


						   <div class="form-group col-md-6 ">
                         <label for="description_en">Description (English)</label>
                         <textarea type="text" name="component[0][description_en]" id="vat" class="form-control" placeholder="Enter description in English"
                         >{{ old("description_en") ? old("description_en") : '' }}</textarea>
                         <div class="help-block"></div>
                     </div>

                     <div class="form-group col-md-6 ">
                         <label for="description_bn">Description (Bangla)</label>
                         <textarea type="text" name="component[0][description_bn]" id="vat" class="form-control" placeholder="Enter description in Bangla"
                         >{{ old("description_bn") ? old("description_bn") : '' }}</textarea>
                         <div class="help-block"></div>
                     </div>


                      <div class="form-group col-md-6">
                          <label for="tag_category_id" class="required">Select Video Type</label>
                          <select id="select_video_type" class="form-control" name="component[0][other_attr][video_type]">
                                  <option value="uploaded_video">Upload video</option>
                                  <option value="youtube_video">Youtube video link</option>
                          </select>
                          <div class="help-block"></div>
                          @if ($errors->has('app_service_video_type'))
                              <div class="help-block">{{ $errors->first('app_service_video_type') }}</div>
                          @endif
                      </div>



                     <div class="uploaded_video form-group col-md-6 {{ $errors->has('video_url') ? ' error' : '' }}">
                         <label for="alt_text" class="">Uplaod Video_url (optional)</label>
                         <div class="custom-file">
                             <input type="file" name="component[0][video_url]" class="custom-file-input" id="image">
                             <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                         </div>
                         <span class="text-primary">Please given file type (.mp4)</span>

                         <div class="help-block"></div>
                         @if ($errors->has('video_url'))
                             <div class="help-block">  {{ $errors->first('video_url') }}</div>
                         @endif
                     </div>


                     <div class="youtube_video form-group col-md-6 {{ $errors->has('video_url') ? ' error' : '' }}" style="display: none;">
                         <label for="video_url" class="required1">Youtube video link</label>
                         <input type="text" name="component[0][video_url]"  class="form-control"
                                value="{{ old("video_url") ? old("video_url") : '' }}">
                         <div class="help-block"></div>
                         <p class="small text-warning">Please put embeded youtube link ex: https://www.youtube.com/embed/USs8IaKYoRI</p>
                         @if ($errors->has('video_url'))
                             <div class="help-block">  {{ $errors->first('video_url') }}</div>
                         @endif
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
 <style>
     .modal-xl.modal_xl_custom {
         max-width: 80%;
         margin-left: 10%;
       	margin-right: 10%;
     }
 </style>
@endpush




@push('page-js')

<script type="text/javascript">
  $(document).ready(function () {
     
     $('#select_video_type').on('change', function(){
      var selected = $(this).val();

      console.log(selected);
     });




  }); // doc ready
</script>




@endpush