<!-- Modal -->
<div class="modal fade" id="text_with_image_right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                		{{ Form::hidden('sections[section_name]', 'Text with Image Right' ) }}
                		{{ Form::hidden('sections[section_type]', 'text_with_image_right' ) }}
                		{{ Form::hidden('sections[tab_type]', $tab_type ) }}
                		{{ Form::hidden('sections[category]', 'component_sections' ) }}
                		{{ Form::hidden('component[0][component_type]', 'text_with_image_right' ) }}


  							<div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description (English)</label>
                        <textarea name="component[0][description_en]" class="form-control" rows="5"
                                  placeholder="Enter description">{{ isset($ecarrer_item->description_en) ? $ecarrer_item->description_en : '' }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description (Bangla)</label>
                        <textarea name="component[0][description_bn]" class="form-control" rows="5"
                                  placeholder="Enter description">{{ isset($ecarrer_item->description_bn) ? $ecarrer_item->description_bn : '' }}</textarea>
                    </div>
                </div>


							<div class="form-group col-md-5 {{ $errors->has('image_url') ? ' error' : '' }}">
							    <label for="alt_text" class="">Image (optional)</label>
							    <div class="custom-file">
							        <input type="file" name="component[0][image_url]" class="custom-file-input image_with_preview">
							        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>s
							    </div>
							    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

							    <div class="help-block"></div>
							    @if ($errors->has('image_url'))
							        <div class="help-block">  {{ $errors->first('image_url') }}</div>
							    @endif
							</div>

							<div class="form-group col-md-1">
							    <img id="imgDisplay" class="imgDisplay" style="height:70px;width:70px;display:none">
							</div>

							<div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
							    <label for="alt_text" class="required1">Alt text</label>
							    <input type="text" name="component[0][alt_text]"  class="form-control"
							           value="{{ old("alt_text") ? old("alt_text") : '' }}">
							    <div class="help-block"></div>
							    @if ($errors->has('alt_text'))
							        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
							    @endif
							</div>


                    {{-- <div class="form-group col-md-6 {{ $errors->has('section_name') ? ' error' : '' }}">
                        <label for="section_name" class="required">Section Name</label>
                        <input type="text" name="section_name" id="section_name" class="form-control section_name" placeholder="Give section a name"
                               value="{{ old("section_name") ? old("section_name") : '' }}" required data-validation-required-message="This field can not be empty">
                        <div class="help-block"></div>
                        @if ($errors->has('section_name'))
                            <div class="help-block">{{ $errors->first('section_name') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('slug') ? ' error' : '' }}">
                        <label for="slug" class="required">Section Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control auto_slug"
                               value="{{ old("slug") ? old("slug") : '' }}" readonly required data-validation-required-message="This field can not be empty">
                        <div class="help-block"></div>
                        @if ($errors->has('slug'))
                            <div class="help-block">{{ $errors->first('slug') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                        <label for="title_en">Title (English)</label>
                        <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter offer name in English"
                               value="{{ old("title_en") ? old("title_en") : '' }}">
                        <div class="help-block"></div>
                        @if ($errors->has('title_en'))
                            <div class="help-block">{{ $errors->first('title_en') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                        <label for="title_bn">Title (Bangla)</label>
                        <input type="text" name="title_bn" id="title_bn" class="form-control" placeholder="Enter offer name in Bangla"
                               value="{{ old("title_bn") ? old("title_bn") : '' }}">
                        <div class="help-block"></div>
                        @if ($errors->has('title_bn'))
                            <div class="help-block">{{ $errors->first('title_bn') }}</div>
                        @endif
                    </div> --}}


							
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