{{ Form::hidden('sections[section_name]', 'Multiple Image Banner' ) }}
{{ Form::hidden('sections[section_type]', 'multiple_image_banner' ) }}
{{ Form::hidden('sections[tab_type]', $tab_type ) }}
{{ Form::hidden('sections[category]', 'component_sections' ) }}
{{ Form::hidden('component[0][component_type]', 'multiple_image_banner' ) }}

<div class="col-sm-12">
    <div class="add_button_wrap float-right">
      <a href="#" class="btn btn-info  btn-glow px-1 add_moreslider_item">+ Add Image</a>
    </div>
</div>

<div class="col-sm-12">

    <div id="slider_content_section" class="slider_content_section" data-count="1">
        <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="1">
        <input type="hidden" name="component[0][multi_item][id-1]" value="1">
        <input type="hidden" name="component[0][multi_item][display_order-1]" value="0">


        <div class="row single_slider_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">

            <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                <label for="alt_text" class="">Image (optional)</label>
                <div class="custom-file">
                    <input type="file" name="component[0][multi_item][image_url-1]" class="dropify">
{{--                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
                </div>
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                <div class="help-block"></div>
                @if ($errors->has('image_url'))
                    <div class="help-block">  {{ $errors->first('image_url') }}</div>
                @endif
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

            <div class="form-group col-md-3">
                <label for="status">Status</label>
                <select class="form-control" name="component[0][multi_item][status-1]" aria-invalid="false">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>

            </div>
            <div class="form-group">
                <label for="status" style="padding-bottom: 43px;"> </label>
                <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>
            </div>
        </div>
    </div>
    {{-- <hr class="hr">
    <br> --}}
</div>



{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="multiple_image_banner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--		<div class="modal-dialog modal-lg modal_lg_custom" role="document">--}}
{{--				<div class="modal-content">--}}
{{--					<div class="modal-header">--}}
{{--						<h4 class="modal-title" id="exampleModalLabel"><strong>Component: Multiple image banner</strong></h4>--}}
{{--						<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--							<span aria-hidden="true">&times;</span>--}}
{{--						</button>--}}

{{--					</div>--}}
{{--						<form id="product_details_form" role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">--}}
{{--								@csrf--}}
{{--							<div class="modal-body">--}}
{{--								<div class="row">--}}
{{--									<div class="col-sm-12">--}}
{{--										<div class="add_button_wrap float-right">--}}
{{--										  <a href="#" class="btn btn-info  btn-glow px-1 add_moreslider_item">+ Add Image</a>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="row">--}}

{{--										{{ Form::hidden('sections[section_name]', 'Multiple Image Banner' ) }}--}}
{{--										{{ Form::hidden('sections[section_type]', 'multiple_image_banner' ) }}--}}
{{--										{{ Form::hidden('sections[tab_type]', $tab_type ) }}--}}
{{--										{{ Form::hidden('sections[category]', 'component_sections' ) }}--}}
{{--										{{ Form::hidden('component[0][component_type]', 'multiple_image_banner' ) }}--}}

{{--									<div class="col-sm-12">--}}
{{--									  --}}
{{--									  <div id="slider_content_section" class="slider_content_section" data-count="1">--}}
{{--									    <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="1">--}}
{{--									    <input type="hidden" name="component[0][multi_item][id-1]" value="1">--}}
{{--									    <input type="hidden" name="component[0][multi_item][display_order-1]" value="0">--}}


{{--									    <div class="row single_slider_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">--}}

{{--									      <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">--}}
{{--									          <label for="alt_text" class="">Image (optional)</label>--}}
{{--									          <div class="custom-file">--}}
{{--									              <input type="file" name="component[0][multi_item][image_url-1]" class="custom-file-input image_with_preview">--}}
{{--									              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
{{--									          </div>--}}
{{--									          <span class="text-primary">Please given file type (.png, .jpg, svg)</span>--}}

{{--									          <div class="help-block"></div>--}}
{{--									          @if ($errors->has('image_url'))--}}
{{--									              <div class="help-block">  {{ $errors->first('image_url') }}</div>--}}
{{--									          @endif--}}
{{--									      </div>--}}

{{--									      <div class="form-group col-md-1">--}}
{{--									          <img style="height:70px;width:70px;display:none" class="imgDisplay">--}}
{{--									      </div>--}}


{{--									      <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">--}}
{{--									         <label for="alt_text" class="required1">Alt Text</label>--}}
{{--									         <input type="text" name="component[0][multi_item][alt_text-1]"  class="form-control"--}}
{{--									                value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >--}}
{{--									         <div class="help-block"></div>--}}
{{--									         @if ($errors->has('alt_text'))--}}
{{--									             <div class="help-block">  {{ $errors->first('alt_text') }}</div>--}}
{{--									         @endif--}}
{{--									      </div>--}}

{{--									      <div class="form-group col-md-2">--}}
{{--									          <label for="status">Status</label>--}}
{{--									          <select class="form-control" name="component[0][multi_item][status-1]" aria-invalid="false">--}}
{{--									                  <option value="1">Active</option>--}}
{{--									                  <option value="0">Inactive</option>--}}
{{--									          </select>--}}
{{--									          --}}
{{--									      </div>--}}


{{--									      --}}

{{--									      <div class="form-group">--}}
{{--									        <label for="status" style="padding-bottom: 43px;"> </label>--}}
{{--									          <button class="btn btn-danger multi_item_remove">-</button>--}}
{{--									      </div>--}}

{{--									      --}}



{{--									    </div>--}}

{{--									    --}}


{{--									  </div>--}}

{{--									  --}}{{-- <hr class="hr">--}}
{{--									  <br> --}}

{{--									</div>--}}

{{--									--}}
{{--									<div class="multi_attr_update_hide col-md-6">--}}
{{--										<div class="form-group">--}}
{{--											<label for="title" class="mr-1">Status:</label>--}}
{{--											<input type="radio" name="sections[status]" value="1" id="active" checked>--}}
{{--											<label for="active" class="mr-1">Active</label>--}}

{{--											<input type="radio" name="sections[status]" value="0" id="inactive">--}}
{{--											<label for="inactive">Inactive</label>--}}
{{--										</div>--}}
{{--									</div>--}}

{{--									<div class="form-group col-md-6">--}}
{{--											<!-- 0 - NO, 1 - Yes : Component has multiple component or not -->--}}
{{--											{{ Form::hidden('sections[multiple_component]', 0 ) }}--}}
{{--									</div>--}}

{{--										--}}

{{--								</div>--}}

{{--							</div>--}}
{{--							<div class="modal-footer">--}}
{{--									{{ Form::hidden('sections[id]', null, ['class' => 'section_id'] ) }}--}}
{{--									{{ Form::hidden('component[0][id]', null, ['class' => 'component_id'] ) }}--}}

{{--								<a type="button" href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>--}}
{{--								<button id="form_save" type="submit" name="save" class="btn btn-primary">Save changes</button>--}}
{{--								<button id="form_update" type="submit" name="update" class="btn btn-primary" style="display: none;">Update</button>--}}
{{--								<button id="form_multi_attr_update" type="submit" name="compnent_muti_attr_update" class="btn btn-primary" style="display: none;">Update</button>--}}
{{--							</div>--}}
{{--					</form>--}}
{{--				</div>--}}
{{--		</div>--}}
{{--</div><!-- /.modal -->--}}
{{--<!-- Modal -->--}}


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

	   	$parentSelector = $('#multiple_image_banner');

	     var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);
	     // $('#slider_content_section').empty();

	     i = i+1;

	     var html = '';

	     html += '<div class="row single_slider_content"><input type="hidden" name="component[0][multi_item][id-'+i+']" value="'+i+'"><input type="hidden" name="component[0][multi_item][display_order-'+i+']" value="'+i+'"><div class="form-group col-md-4"> <label for="alt_text" class="">Image (optional)</label><div class="custom-file"> <input type="file" name="component[0][multi_item][image_url-'+i+']" class="dropify" aria-invalid="false"></div> <span class="text-primary">Please given file type (.png, .jpg, svg)</span><div class="help-block"></div></div><div class="form-group col-md-4"> <label for="alt_text" class="required1">Alt Text</label> <input type="text" name="component[0][multi_item][alt_text-'+i+']" class="form-control" value=""><div class="help-block"></div></div><div class="form-group col-md-3"> <label for="status">Status</label> <select class="form-control" name="component[0][multi_item][status-'+i+']" aria-invalid="false"><option value="1">Active</option><option value="0">Inactive</option> </select></div><div class="form-group"> <label for="status" style="padding-bottom: 43px;"> </label><button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button></div></div>';

	     $parentSelector.find('#slider_content_section').append(html);

         $('.dropify').dropify({
             messages: {
                 'default': 'Browse for an Image File to upload',
                 'replace': 'Click to replace',
                 'remove': 'Remove',
                 'error': 'Choose correct file format'
             },
             height: 100
         });

	     $parentSelector.find('#multi_item_count').val(i);
	   });


	   $(document).on('click', '.multi_item_remove', function(e){

	     e.preventDefault();

	     $(this).parents('.row.single_slider_content').remove();

	   });




	}); // doc ready
</script>




@endpush
