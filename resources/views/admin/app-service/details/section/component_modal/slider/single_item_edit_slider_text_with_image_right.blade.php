<!-- Modal -->
<div class="modal fade" id="single_item_edit_slider_text_with_image_right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal_lg_custom" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel"><strong>Component: Slider - text with Image right</strong></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

					</div>
						<form id="product_details_form" role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">
								@csrf
							<div class="modal-body">
								
								<div class="row">

									
									{{ Form::hidden('item_id', '' ) }}
									{{ Form::hidden('component_id', '' ) }}

									
									<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
									   <label for="title_en" class="required1">Slider Title (English)</label>
									   <input type="text" name="component_multi_attr[title_en]"  class="form-control"
									          value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
									   <div class="help-block"></div>
									   @if ($errors->has('title_en'))
									       <div class="help-block">  {{ $errors->first('title_en') }}</div>
									   @endif
									</div>

									<div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
									   <label for="title_bn" class="required1">Slider Title (Bangla)</label>
									   <input type="text" name="component_multi_attr[title_bn]"  class="form-control"
									          value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
									   <div class="help-block"></div>
									   @if ($errors->has('title_bn'))
									       <div class="help-block">  {{ $errors->first('title_bn') }}</div>
									   @endif
									</div>
									
									<div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
									    <label for="alt_text" class="">Image (optional)</label>
									    <div class="custom-file">
									        <input type="file" name="component_multi_attr[image_url]" class="custom-file-input" id="image">
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
									   <input type="text" name="component_multi_attr[alt_text]"  class="form-control"
									          value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >
									   <div class="help-block"></div>
									   @if ($errors->has('alt_text'))
									       <div class="help-block">  {{ $errors->first('alt_text') }}</div>
									   @endif
									</div>

									<div class="form-group col-md-2">
									    <label for="status">Status</label>
									    <select class="form-control" name="component_multi_attr[status]" aria-invalid="false">
									            <option value="1">Active</option>
									            <option value="0">Inactive</option>
									    </select>
									    
									</div>












										

								</div>

							</div>
							<div class="modal-footer">
								<a type="button" href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
								<button id="form_update" type="submit" name="update" class="btn btn-primary">Update</button>
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
	     // $('#slider_content_section').empty();

	     i = i+1;

	     var html = '';
	     
	     html += '<div class="row single_slider_content"><input type="hidden" name="component[0][multi_item][display_order-'+i+']" value="'+i+'"><input type="hidden" name="component[0][multi_item][id-'+i+']" value="'+i+'"><div class="form-group col-md-6"> <label for="title_en" class="required1">Slider Title (English)</label> <input type="text" name="component[0][multi_item][title_en-'+i+']" class="form-control" value="" aria-invalid="false"> <div class="help-block"></div></div><div class="form-group col-md-6 "> <label for="title_bn" class="required1">Slider Title (Bangla)</label> <input type="text" name="component[0][multi_item][title_bn-'+i+']" class="form-control" value=""> <div class="help-block"></div></div><div class="form-group col-md-4"> <label for="alt_text" class="">Image (optional)</label><div class="custom-file"> <input type="file" name="component[0][multi_item][image_url-'+i+']" class="custom-file-input" id="image" aria-invalid="false"> <label class="custom-file-label" for="inputGroupFile01">Choose file</label></div> <span class="text-primary">Please given file type (.png, .jpg, svg)</span><div class="help-block"></div></div><div class="form-group col-md-1"> <img style="height:70px;width:70px;display:none" id="imgDisplay"></div><div class="form-group col-md-4 "> <label for="alt_text" class="required1">Alt Text</label> <input type="text" name="component[0][multi_item][alt_text-'+i+']" class="form-control" value=""><div class="help-block"></div></div><div class="form-group col-md-2"> <label for="status">Status</label> <select class="form-control" name="component[0][multi_item][status-'+i+']" aria-invalid="false"><option value="1">Active</option><option value="0">Inactive</option> </select></div><div class="form-group"> <label for="status" style="padding-bottom: 43px;"> </label> <button class="btn btn-danger multi_item_remove">-</button></div></div>';

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