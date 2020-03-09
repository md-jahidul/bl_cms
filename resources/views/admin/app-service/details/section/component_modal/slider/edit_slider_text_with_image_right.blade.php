<!-- Modal -->
<div class="modal fade" id="edit_slider_text_with_image_right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal_lg_custom" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel"><strong>Component Slider List</strong></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

					</div>
						<form id="product_details_form" role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">
								@csrf
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-12">
										<h4 class="pb-1 float-left"><strong>Slider Image List</strong></h4>
										<div class="add_button_wrap float-right">
										  <a href="#" class="btn btn-info  btn-glow px-1 add_moreslider_item">+ Add slide</a>
										</div>
									</div>
								</div>
								<div class="row">

										{{ Form::hidden('sections[section_name]', 'Slider text with Image right' ) }}
										{{ Form::hidden('sections[section_type]', 'slider_text_with_image_right' ) }}
										{{ Form::hidden('sections[tab_type]', $tab_type ) }}
										{{ Form::hidden('sections[category]', 'component_sections' ) }}
										{{ Form::hidden('component[0][component_type]', 'slider_text_with_image_right' ) }}


									
									<div class="col-sm-12">
										<table class="table table-striped table-bordered"
											   role="grid" aria-describedby="Example1_info" style="">
											<thead>
												<tr>
													<td width="3%">#</td>
													<th width="15%">Image</th>
													<th width="20%">Title</th>
													<th width="12%" class="">Status</th>
													<th width="12%" class="">Action</th>
												</tr>
											</thead>
											<tbody id="slider_sortable">
													
											</tbody>
										</table>
									</div>


									{{-- <div class="col-sm-12">
									  
									  <div id="slider_content_section" class="slider_content_section" data-count="1">
									    <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="1">
									    <input type="hidden" name="component[0][multi_item][display_order-1]" value="0">

									    <div class="row single_slider_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">

									      <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
									         <label for="title_en" class="required1">Slider Title (English)</label>
									         <input type="text" name="component[0][multi_item][title_en-1]"  class="form-control"
									                value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
									         <div class="help-block"></div>
									         @if ($errors->has('title_en'))
									             <div class="help-block">  {{ $errors->first('title_en') }}</div>
									         @endif
									      </div>

									      <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
									         <label for="title_bn" class="required1">Slider Title (Bangla)</label>
									         <input type="text" name="component[0][multi_item][title_bn-1]"  class="form-control"
									                value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
									         <div class="help-block"></div>
									         @if ($errors->has('title_bn'))
									             <div class="help-block">  {{ $errors->first('title_bn') }}</div>
									         @endif
									      </div>
									      
									      <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
									          <label for="alt_text" class="">Image (optional)</label>
									          <div class="custom-file">
									              <input type="file" name="component[0][multi_item][image_url-1]" class="custom-file-input" id="image">
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
									         <input type="text" name="component[0][multi_item][alt_text-1]"  class="form-control"
									                value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >
									         <div class="help-block"></div>
									         @if ($errors->has('alt_text'))
									             <div class="help-block">  {{ $errors->first('alt_text') }}</div>
									         @endif
									      </div>

									      <div class="form-group col-md-2">
									          <label for="status">Status</label>
									          <select class="form-control" name="component[0][multi_item][status-1]" aria-invalid="false">
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


									</div> --}}



							<div class="form-group col-md-6 {{ $errors->has('sliding_speed') ? ' error' : '' }}">
							    <label for="sliding_speed" class="required">Sliding Speed</label>
							    <input type="text" name="component[0][other_attr][sliding_speed]" oninput="this.value =Number(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"  class="form-control" placeholder="Enter sliding speed (sec)"  min="1" max="300"
							           value="{{ (!empty($other_attr['sliding_speed'])) ? $other_attr['sliding_speed'] : old("other_attr.sliding_speed") ?? '' }}"
							           required data-validation-required-message="Enter slider info">
							    <div class="help-block"><small>Default value 10</small></div>
							    @if ($errors->has('sliding_speed'))
							        <div class="help-block">  {{ $errors->first('sliding_speed') }}</div>
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

		#accordion {
		    margin:20px;
		    min-height:300px;
		}
 </style>
@endpush



@push('page-js')

<script type="text/javascript">
	$(document).ready(function () {
	   
	   // Add multiple item
	   $('.add_moreslider_item').on('click', function(){

	     var i = parseInt($('#multi_item_count').val(), 10);

	     i = i+1;

	     var html = '';
	     
	     html += '<div class="row single_slider_content"><input type="hidden" name="component[0][multi_item][display_order-'+i+']" value="'+i+'"><div class="form-group col-md-6"> <label for="title_en" class="required1">Slider Title (English)</label> <input type="text" name="component[0][multi_item][title_en-'+i+']" class="form-control" value="" aria-invalid="false"> <div class="help-block"></div></div><div class="form-group col-md-6 "> <label for="title_bn" class="required1">Slider Title (Bangla)</label> <input type="text" name="component[0][multi_item][title_bn-'+i+']" class="form-control" value=""> <div class="help-block"></div></div><div class="form-group col-md-4"> <label for="alt_text" class="">Image (optional)</label><div class="custom-file"> <input type="file" name="component[0][multi_item][image_url-'+i+']" class="custom-file-input" id="image" aria-invalid="false"> <label class="custom-file-label" for="inputGroupFile01">Choose file</label></div> <span class="text-primary">Please given file type (.png, .jpg, svg)</span><div class="help-block"></div></div><div class="form-group col-md-1"> <img style="height:70px;width:70px;display:none" id="imgDisplay"></div><div class="form-group col-md-4 "> <label for="alt_text" class="required1">Alt Text</label> <input type="text" name="component[0][multi_item][alt_text-'+i+']" class="form-control" value=""><div class="help-block"></div></div><div class="form-group col-md-2"> <label for="status">Status</label> <select class="form-control" name="component[0][multi_item][status-'+i+']" aria-invalid="false"><option value="1">Active</option><option value="0">Inactive</option> </select></div><div class="form-group"> <label for="status" style="padding-bottom: 43px;"> </label> <button class="btn btn-danger multi_item_remove">-</button></div></div>';

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