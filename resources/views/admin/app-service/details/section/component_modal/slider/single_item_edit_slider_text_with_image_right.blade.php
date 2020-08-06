<!-- Modal -->
<div class="modal fade" id="single_item_edit_slider_text_with_image_right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal_lg_custom" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel"><strong>Component: Single Item Edit</strong></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

					</div>
						<form id="product_details_form" role="form" action="{{ route('appservice.component.itemattr.store') }}" method="POST" novalidate enctype="multipart/form-data">
								@csrf
							<div class="modal-body">
								
								<div class="row">

									
									{{ Form::hidden('item_id', '', ['class' => 'item_id']) }}
									{{ Form::hidden('component_id', '', ['class' => 'component_id'] ) }}
									{{ Form::hidden('product_id', $product_id) }}
									{{ Form::hidden('tab_type', $tab_type) }}

									
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
									        <input type="file" name="component_multi_attr[image_url]" class="custom-file-input image_with_preview">
									        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
									    </div>
									    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

									    <div class="help-block"></div>
									    @if ($errors->has('image_url'))
									        <div class="help-block">  {{ $errors->first('image_url') }}</div>
									    @endif
									</div>

									<div class="form-group col-md-1">
									    <img style="height:70px;width:70px;display:none" class="imgDisplay">
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
	   
	   




	}); // doc ready
</script>




@endpush