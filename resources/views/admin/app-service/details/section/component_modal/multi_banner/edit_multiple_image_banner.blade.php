<!-- Modal -->
<div class="modal fade" id="edit_multiple_image_banner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-number_of_compoent="1">
		<div class="modal-dialog modal-lg modal_lg_custom" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel"><strong>Component Multi Image Banner</strong></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

					</div>
						<form role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">
								@csrf
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-12">
										<h4 class="pb-1 float-left"><strong>Multi Image List</strong></h4>
										<div class="add_button_wrap float-right">
										  <a href="#" class="btn btn-info  btn-glow px-1 edit_multi_image_item_add">+ Add Image</a>
										</div>
									</div>
								</div>
								<div class="row">

										{{ Form::hidden('sections[section_name]', 'Multi image banner' ) }}
										{{ Form::hidden('sections[section_type]', 'multiple_image_banner' ) }}
										{{ Form::hidden('sections[tab_type]', $tab_type ) }}
										{{ Form::hidden('sections[category]', 'component_sections' ) }}
										{{ Form::hidden('component[0][component_type]', 'multiple_image_banner' ) }}



									<div class="col-sm-12">
										<table class="table table-striped table-bordered"
											   role="grid" aria-describedby="Example1_info" style="" >
											<thead>
												<tr>
													<td width="3%">#</td>
													<th width="15%">Image</th>
													<th width="20%">Title</th>
													<th width="12%" class="">Status</th>
													<th width="12%" class="">Action</th>
												</tr>
											</thead>
											<tbody id="slider_sortable" data-component_id="" class="tablecompoent_0"></tbody>
										</table>
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
							{{-- <button id="form_save" type="submit" name="save" class="btn btn-primary">Save changes</button> --}}
							<button id="form_update" type="submit" name="update" class="btn btn-primary" style="">Update</button>
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

	   //Add multiple item on edit
	   $('.edit_multi_image_item_add').on('click', function(e){
	   	e.preventDefault();

	    var	$parentSelector = $('#multiple_image_banner');
	   	var $parentSelectorEdit = $('#edit_multiple_image_banner');

	   	var getNumberOfComponent = parseInt($parentSelectorEdit.attr('data-number_of_compoent'));
	   	var getSectionsId = $parentSelectorEdit.find('.section_id').val();



	   	// console.log(getSectionsId);
	   	for (var i = 0; i < getNumberOfComponent; i++) {
	   		var singleComponentId = $parentSelectorEdit.find("input[name='component["+i+"][id]']").val();
	   		$parentSelector.find("input[name='component["+i+"][id]']").val(singleComponentId);
	   	}

	   	$parentSelector.find("input[name='sections[id]']").val(getSectionsId);

	   	$parentSelector.find('.multi_attr_update_hide').empty();

	   	$parentSelector.find('#form_save').hide();
	   	$parentSelector.find('#form_update').hide();
	   	$parentSelector.find('#form_multi_attr_update').show();

	     $parentSelectorEdit.modal('hide');
	     $parentSelector.modal('show');

        $('.modal-open .modal').css('overflow-x','hidden');
        $('.modal-open .modal').css('overflow-y','auto');

	     $parentSelector.on('hidden.bs.modal', function(){
	         // $('#multiple_image_banner').find('.multi_attr_update_hide').show();
	         location.reload();
	         return false;
	     });


	   });



	   // Edit multiple attribute single item
	   var $singleModalID = $('#single_item_edit_multiple_image_banner');
	   var $editedModalID = $('#edit_multiple_image_banner');

	   $(document).on('click', '.banner_multi_item_edit', function(e){
	   	e.preventDefault();

	   	var componentId = $(this).attr('data-component_id');
	   	var itemId = $(this).attr('data-item_id');

	   	var baseUrl = "{{ config('filesystems.file_base_url') }}";

	   	$.ajax({
	   	    type: "GET",
	   	    url: "{{ url('app-service/component/itemattr') }}",
	   	    data: {
	   	    		item_id : itemId,
	   	        	component_id: componentId
	   	    },
	   	    success: function (result) {
	   	    	if( result.status == 'SUCCESS' ){


	   	    		$.each(result.data, function(k, v){

	   	    			if( k == 'image_url' ){
	   	    				$singleModalID.find('.imgDisplay').attr('src', baseUrl + v).show();
	   	    			}
	   	    			else if( k == 'status' ){
	   	    				$singleModalID.find("select[name='component_multi_attr["+k+"]']").children('option[value="'+v+'"]').attr('selected', true);
	   	    			}
	   	    			else{
	   	    				$singleModalID.find("input[name='component_multi_attr["+k+"]']").val(v);
	   	    			}


	   	    			// Put item id and component id
	   	    			$singleModalID.find('.item_id').val(itemId);
	   	    			$singleModalID.find('.component_id').val(componentId);


	   	    		});

	   	    		$editedModalID.modal('hide');

	   	    		$singleModalID.modal('show');

	   	    		return false;



	   	    	}

	   	    },
	   	    error: function () {
	   	        // window.location.replace(auto_save_url);
	   	    }
	   	});


	   });



	   $singleModalID.on('hidden.bs.modal', function(){
	       $editedModalID.modal('show');
	   });


	}); // doc ready
</script>




@endpush
