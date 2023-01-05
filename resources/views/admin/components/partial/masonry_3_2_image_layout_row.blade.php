{{ Form::hidden('component_type', 'masonry_3_2_image_layout_row' ) }}


<div class="col-sm-12">
    <div class="add_button_wrap float-right">
      <a href="#" class="btn btn-info  btn-glow px-1 add_more_masonry_item">+ Add Image</a>
    </div>
</div>

<div class="col-sm-12">
        @php
            $count = (isset($component->multiple_attributes))? count($component->multiple_attributes) : 1 ;
        @endphp

    <div id="masonry_content_section" class="masonry_content_section" data-count="1">
        <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$count}}">

        {{-- <input type="hidden" name="multi_item[id-1]" value="1">
        <input type="hidden" name="multi_item[display_order-1]" value="0"> --}}
        @if (isset($component->multiple_attributes))
            
            @foreach ( $component->multiple_attributes as $key => $single_attribute )

                <div class="row single_masonry_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">

                    <input type="hidden" name="multi_item[id-{{ $key +1 }}]" value="{{ $key +1 }}">
                    <input type="hidden" name="multi_item[display_order-{{ $key +1 }}]" value="{{ $key +1 }}">

                    <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                        <label for="alt_text" class="">Image (optional)</label>
                        <div class="custom-file">
                            <input type="file" name="multi_item[image_url-{{ $key +1 }}]" class="dropify" data-default-file="{{ isset($single_attribute['image_url']) ? config('filesystems.file_base_url') . $single_attribute['image_url'] : '' }}">
                        </div>
                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                        <div class="help-block"></div>
                        @if ($errors->has('image_url'))
                            <div class="help-block">  {{ $errors->first('image_url') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                        <label for="alt_text" class="required1">Alt Text</label>
                        <input type="text" name="multi_item[alt_text-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['alt_text'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('alt_text'))
                            <div class="help-block">  {{ $errors->first('alt_text') }}</div>
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
        @else
            <div class="row single_masonry_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">

                <input type="hidden" name="multi_item[id-1]" value="1">
                <input type="hidden" name="multi_item[display_order-1]" value="1">

                <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                    <label for="alt_text" class="">Image (optional)</label>
                    <div class="custom-file">
                        <input type="file" name="multi_item[image_url-1]" class="dropify">
                    </div>
                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                    <div class="help-block"></div>
                    @if ($errors->has('image_url'))
                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                    <label for="alt_text" class="required1">Alt Text</label>
                    <input type="text" name="multi_item[alt_text-1]"  class="form-control"
                        value="" >
                    <div class="help-block"></div>
                    @if ($errors->has('alt_text'))
                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3">
                    <label for="status">Status</label>
                    <select class="form-control" name="multi_item[status-1]" aria-invalid="false">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="status" style="padding-bottom: 43px;"> </label>
                    <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>
                </div>
            </div>
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
        //itemCheck();
	   // Add multiple item
	   $('.add_more_masonry_item').on('click', function(event){

        event.preventDefault();
        
	   	$parentSelector = $('#masonry_3_2_image_layout_row');

	     var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);
	     // $('#masonry_content_section').empty();

	     i = i+1;

	     var html = '';

	     html += '<div class="row single_masonry_content"><input type="hidden" name="multi_item[id-'+i+']" value="'+i+'"><input type="hidden" name="multi_item[display_order-'+i+']" value="'+i+'"><div class="form-group col-md-4"> <label for="alt_text" class="">Image (optional)</label><div class="custom-file"> <input type="file" name="multi_item[image_url-'+i+']" class="dropify" aria-invalid="false"></div> <span class="text-primary">Please given file type (.png, .jpg, svg)</span><div class="help-block"></div></div><div class="form-group col-md-4"> <label for="alt_text" class="required1">Alt Text</label> <input type="text" name="multi_item[alt_text-'+i+']" class="form-control" value=""><div class="help-block"></div></div><div class="form-group col-md-3"> <label for="status">Status</label> <select class="form-control" name="multi_item[status-'+i+']" aria-invalid="false"><option value="1">Active</option><option value="0">Inactive</option> </select></div><div class="form-group"> <label for="status" style="padding-bottom: 43px;"> </label><button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button></div></div>';

	     $parentSelector.find('#masonry_content_section').append(html);

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

         //itemCheck();
	   });


	   $(document).on('click', '.multi_item_remove', function(e){

	     e.preventDefault();

	     $(this).parents('.row.single_masonry_content').remove();


        let parentSelector = $('#masonry_3_2_image_layout_row');
        let count =  parentSelector.find('#multi_item_count').val();

        parentSelector.find('#multi_item_count').val(count-1);
        //itemCheck();

	   });

/*
        $('#masonry_type').on('change', function () {
            var componentType = ''

            let type_value = this.value;
            let flage = 'enable';
            console.log(type_value);
            
            if (type_value == '1_2_image_layout_col' || type_value =='') 
            {
                componentType = "masonry.png";

            } else {
                componentType = 'masonry_'+type_value + ".png";
            }

            itemCheck();

            var fullUrl = "{{ asset('app-assets/images/app_services') }}/" + componentType;
            $("#componentImg").attr('src', fullUrl)
        })


*/




        function addBtnDisableEnable(flage){
            if(flage == 'enable'){
                $( ".add_more_masonry_item" ).removeClass( 'disabled');
            }else{
                $( ".add_more_masonry_item" ).addClass( 'disabled');
            }
        }

        function saveBtnDisableEnable(flage){
            if(flage == 'enable'){
                $( "#save" ).removeClass( 'd-none');
            }else{
                $( "#save" ).addClass( 'd-none');
            }
        }

        function itemCheck(){
            $parentSelector = $('#masonry');

	        let total_item = parseInt($parentSelector.find('#multi_item_count').val(), 10);
	        let masonry_type = $parentSelector.find('#masonry_type').val();
            let item_count = 0;

            if( masonry_type == "1_2_image_layout_col") 
            {
                item_count = 3;
            }
            if( masonry_type == "3_2_image_layout_row") 
            {
                item_count = 5;
            }

            if( masonry_type == ""){
                addBtnDisableEnable('disable');
            }else{
                addBtnDisableEnable('enable');
            }


            if( item_count == total_item){
                saveBtnDisableEnable('enable');
            } else{
                saveBtnDisableEnable('disable');
            }
        }
	}); // doc ready

</script>




@endpush
