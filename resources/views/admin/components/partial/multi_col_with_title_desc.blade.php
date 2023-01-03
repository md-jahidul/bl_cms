{{ Form::hidden('component_type', 'multi_col_with_title_desc' ) }}

{{-- <div class="form-group col-md-4 {{ $errors->has('masonry_type') ? ' error' : '' }}">
    <label for="masonry_type" class="required">Masonry Type</label>
    <select name="other_attr[masonry_type]" class="form-control required" id="masonry_type" required data-validation-required-message="Please select masonry type">
        <option value="">--Select Data Type--</option>
        <option data-alias="" value="1_2_image_layout_col" {{ isset ($other_attributes['masonry_type'])  && $other_attributes['masonry_type'] == '1_2_image_layout_col' ? 'selected' : '' }}>1-2-image-layout-col</option>
        <option data-alias="" value="3_2_image_layout_row" {{ isset ($other_attributes['masonry_type'])  && $other_attributes['masonry_type'] == '3_2_image_layout_row' ? 'selected' : '' }}>3-2-image-layout-row</option>
    </select>
    <div class="help-block"></div>
    @if ($errors->has('component_type'))
        <div class="help-block">{{ $errors->first('component_type') }}</div>
    @endif
</div> --}}

<div class="col-sm-12">
    <div class="add_button_wrap float-right">
      <a href="#" class="btn btn-info  btn-glow px-1 add_more_multi_col_item">+ Add Column</a>
    </div>
</div>

<div class="col-sm-12">
        @php
            $count = (isset($component->multiple_attributes))? count($component->multiple_attributes) : 1 ;
        @endphp

    <div id="multi_col_content_section" class="multi_col_content_section" data-count="1">
        <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$count}}">

        {{-- <input type="hidden" name="multi_item[id-1]" value="1">
        <input type="hidden" name="multi_item[display_order-1]" value="0"> --}}
        @if (isset($component->multiple_attributes))
            
            @foreach ( $component->multiple_attributes as $key => $single_attribute )

                <div class="row single_multi_col_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">

                    <input type="hidden" name="multi_item[id-{{ $key +1 }}]" value="{{ $key +1 }}">
                    <input type="hidden" name="multi_item[display_order-{{ $key +1 }}]" value="{{ $key +1 }}">

                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                        <label for="title_en" class="required1">Title (English)</label>
                        <input type="text" name="multi_item[title_en-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['title_en'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('title_en'))
                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                        <label for="title_bn" class="required1">Title (Bangla)</label>
                        <input type="text" name="multi_item[title_bn-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['title_bn'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('title_bn'))
                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('desc_en') ? ' error' : '' }}">
                        <label for="desc_en" class="required1">Description (English)</label>
                        <textarea name="multi_item[desc_en-{{ $key +1 }}]" class="form-control" rows="5" placeholder="Enter description">{{ $single_attribute['desc_en'] ?? null}}</textarea>
                        <div class="help-block"></div>
                        @if ($errors->has('desc_en'))
                            <div class="help-block">  {{ $errors->first('desc_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('desc_bn') ? ' error' : '' }}">
                        <label for="desc_bn" class="required1">Description (Bangla)</label>
                        <textarea name="multi_item[desc_bn-{{ $key +1 }}]" class="form-control" rows="5" placeholder="Enter description">{{ $single_attribute['desc_bn'] ?? null}}</textarea>
                        <div class="help-block"></div>
                        @if ($errors->has('desc_bn'))
                            <div class="help-block">  {{ $errors->first('desc_bn') }}</div>
                        @endif
                    </div>

                    

                    <div class="form-group col-md-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="multi_item[status-{{ $key +1 }}]" aria-invalid="false">
                            <option value="1" {{ isset ($single_attribute['status'])  && $single_attribute['status'] == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ isset ($single_attribute['status'])  && $single_attribute['status'] == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" style="padding-bottom: 43px;"> </label>
                        <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>
                    </div>
                </div>
            @endforeach

        @endif
        
    </div>
    {{-- <hr class="hr">
    <br> --}}
</div>

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
	   $('.add_more_multi_col_item').on('click', function(){

	   	$parentSelector = $('#multi_col_with_title_desc');

	    var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);
	     // $('#multi_col_content_section').empty();

	    i = i+1;
        console.log(i);

	    var html = '';

	    html += '<div class="row single_multi_col_content"><input type="hidden" name="multi_item[id-'+i+']" value="'+i+'"><input type="hidden" name="multi_item[display_order-'+i+']" value="'+i+'"><div class="form-group col-md-6"> <label for="title_en" class="required1">Title (Englist)</label> <input type="text" name="multi_item[title_en-'+i+']"  class="form-control" value="" > <div class="help-block"></div> </div><div class="form-group col-md-6"> <label for="title_bn" class="required1">Title (Bangla)</label> <input type="text" name="multi_item[title_bn-'+i+']"  class="form-control"  value="" >  <div class="help-block"></div> </div><div class="form-group col-md-6"> <label for="desc_en" class="required1">Description (English)</label> <textarea name="multi_item[desc_en-'+i+']" class="form-control" rows="5" placeholder="Enter description"></textarea> <div class="help-block"></div> </div><div class="form-group col-md-6"> <label for="desc_bn" class="required1">Description (Bangla)</label> <textarea name="multi_item[desc_bn-'+i+']" class="form-control" rows="5" placeholder="Enter description"></textarea> <div class="help-block"></div> </div><div class="form-group col-md-3"> <label for="status">Status</label> <select class="form-control" name="multi_item[status-'+i+']" aria-invalid="false"> <option value="1">Active</option> <option value="0">Inactive</option> </select> </div><div class="form-group"> <label for="status" style="padding-bottom: 43px;"> </label> <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button> </div> </div>';

	     $parentSelector.find('#multi_col_content_section').append(html);

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

	     $(this).parents('.row.single_multi_col_content').remove();

	   });

	}); // doc ready
</script>




@endpush
