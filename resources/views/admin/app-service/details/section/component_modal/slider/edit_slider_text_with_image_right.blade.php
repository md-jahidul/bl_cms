<!-- Modal -->
<div class="modal fade" id="edit_slider_text_with_image_right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-number_of_compoent="1">
		<div class="modal-dialog modal-lg modal_lg_custom" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="exampleModalLabel"><strong>Component Slider List</strong></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

					</div>
						<form role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">
								@csrf
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-12">
										<h4 class="pb-1 float-left"><strong>Slider Image List</strong></h4>
{{--										<div class="add_button_wrap float-right">--}}
{{--										  <a href="#" class="btn btn-info  btn-glow px-1 edit_moreslider_item_add">+ Add slide</a>--}}
{{--										</div>--}}
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
											   role="grid" aria-describedby="Example1_info" style="" >
											<thead>
												<tr>
													<td width="3%">#</td>
													<th width="5%">Image</th>
													<th width="20%">Title</th>
													<th width="12%" class="">Status</th>
													<th width="12%" class="">Action</th>
												</tr>
											</thead>
											<tbody id="slider_sortable" data-component_id="" class="tablecompoent_0"></tbody>
										</table>
									</div>

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
                                        <label></label>
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
	   $('.edit_moreslider_item_add').on('click', function(e){
	   	e.preventDefault();

	   	$parentSelector = $('#slider_text_with_image_right');
	   	$parentSelectorEdit = $('#edit_slider_text_with_image_right');

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


	     $parentSelector.on('hidden.bs.modal', function(){
	         // $('#slider_text_with_image_right').find('.multi_attr_update_hide').show();
	         location.reload();
	         return false;
	     });


	   });



	   // Edit multiple attribute single item
	   $(document).on('click', '.multi_item_edit', function(e){
	   	e.preventDefault();

	   	var componentId = $(this).attr('data-component_id');
	   	var itemId = $(this).attr('data-item_id');
	   	var $singleModalID = $('#single_item_edit_slider_text_with_image_right');
	   	var $editedModalID = $('#edit_slider_text_with_image_right');
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


	   	    		$singleModalID.on('hidden.bs.modal', function(){
	   	    		    $editedModalID.modal('show');
	   	    		});


	   	    	}

	   	    },
	   	    error: function () {
	   	        // window.location.replace(auto_save_url);
	   	    }
	   	});


	   });




	}); // doc ready
</script>




@endpush
