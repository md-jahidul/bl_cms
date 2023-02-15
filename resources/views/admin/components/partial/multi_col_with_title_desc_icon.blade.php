{{-- {{ Form::hidden('component_type', 'multi_col_with_title_desc_icon' ) }} --}}

<div class="col-sm-12">
    <div class="add_button_wrap float-right">
      <a href="#" class="btn btn-info  btn-glow px-1 add_more_multi_col_with_icon_item">+ Add Column</a>
    </div>
</div>

<div class="col-sm-12">
        @php
            $count = (isset($component->multiple_attributes))? count($component->multiple_attributes) : 0 ;
        @endphp

    <div id="multi_col_with_icon_content_section" class="multi_col_with_icon_content_section" data-count="1">
        <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$count}}">

        {{-- <input type="hidden" name="multi_item[id-1]" value="1">
        <input type="hidden" name="multi_item[display_order-1]" value="0"> --}}
        @if (isset($component->multiple_attributes))
            
            @foreach ( $component->multiple_attributes as $key => $single_attribute )
                <h4>Column: {{ $key +1 }}</h4>
                <hr class="hr">

                <div class="row single_multi_col_with_icon_content">

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
                        <textarea name="multi_item[desc_en-{{ $key +1 }}]" class="form-control summernote_editor" rows="5" placeholder="Enter description">{{ $single_attribute['desc_en'] ?? null}}</textarea>
                        <div class="help-block"></div>
                        @if ($errors->has('desc_en'))
                            <div class="help-block">  {{ $errors->first('desc_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('desc_bn') ? ' error' : '' }}">
                        <label for="desc_bn" class="required1">Description (Bangla)</label>
                        <textarea name="multi_item[desc_bn-{{ $key +1 }}]" class="form-control summernote_editor" rows="5" placeholder="Enter description">{{ $single_attribute['desc_bn'] ?? null}}</textarea>
                        <div class="help-block"></div>
                        @if ($errors->has('desc_bn'))
                            <div class="help-block">  {{ $errors->first('desc_bn') }}</div>
                        @endif
                    </div>

                    <!-- Image Section -->

                    <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                        <label for="alt_text_en" class="required1">Alt Text (English)</label>
                        <input type="text" name="multi_item[alt_text_en-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['alt_text_en'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('alt_text_en'))
                            <div class="help-block">  {{ $errors->first('alt_text_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                        <label for="alt_text_bn" class="required1">Alt Text (Bangla)</label>
                        <input type="text" name="multi_item[alt_text_bn-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['alt_text_bn'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('alt_text_bn'))
                            <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('image_name_en') ? ' error' : '' }}">
                        <label for="image_name_en" class="required1">Icon Name (English)</label>
                        <input type="text" name="multi_item[image_name_en-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['image_name_en'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('image_name_en'))
                            <div class="help-block">  {{ $errors->first('image_name_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                        <label for="image_name_bn" class="required1">Icon Name (Bangla)</label>
                        <input type="text" name="multi_item[image_name_bn-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['image_name_bn'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('image_name_bn'))
                            <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}">
                        <label for="image_url" class="">Icone (optional)</label>
                        <div class="custom-file">
                            <input type="file" name="multi_item[image_url-{{ $key +1 }}]" class="dropify" data-default-file="{{ isset($single_attribute['image_url']) ? config('filesystems.file_base_url') . $single_attribute['image_url'] : '' }}">
                        </div>
                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                        <div class="help-block"></div>
                        @if ($errors->has('image_url'))
                            <div class="help-block">  {{ $errors->first('image_url') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6"></div>

                    {{-- Need to work For Multiple Button here --}}

                    @include('admin.components.partial.button', $component ?? [])




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

<slot id="img_section" data-offer-type="img_section"></slot>

@push('page-js')

<script type="text/javascript">
	$(document).ready(function () {

	   // Add multiple item
	   $('.add_more_multi_col_with_icon_item').on('click', function(event){
        event.preventDefault();

	   	$parentSelector = $('#multi_col_with_title_desc_icon');

	    var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);
	     // $('#multi_col_content_section').empty();

	    i = i+1;
        console.log(i);

	    var html = '';
        let img_section = '';

        img_section = '<div class="form-group col-md-6"> <label for="alt_text_en" class="required1">Alt Text (English)</label> <input type="text" name="multi_item[alt_text_en-'+i+']"  class="form-control" value=""> <div class="help-block"></div> </div> <div class="form-group col-md-6"><label for="alt_text_bn" class="required1">Alt Text (Bangla)</label><input type="text" name="multi_item[alt_text_bn-'+i+']"  class="form-control" value="" ><div class="help-block"></div></div> <div class="form-group col-md-6"><label for="image_name_en" class="required1">Image Name (English)</label><input type="text" name="multi_item[image_name_en-'+i+']"  class="form-control" value="" ><div class="help-block"></div> </div> <div class="form-group col-md-6"> <label for="image_name_bn" class="required1">Image Name (Bangla)</label> <input type="text" name="multi_item[image_name_bn-'+i+']"  class="form-control" value="" ><div class="help-block"></div></div> <div class="form-group col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}"><label for="image_url" class="">Image (optional)</label><div class="custom-file"><input type="file" name="multi_item[image_url-'+i+']" class="dropify"></div><span class="text-primary">Please given file type (.png, .jpg, svg)</span><div class="help-block"></div></div>';

	    html += '<h4>Column: '+i+'</h4> <hr class="hr"><div class="row single_multi_col_with_icon_content"><input type="hidden" name="multi_item[id-'+i+']" value="'+i+'"><input type="hidden" name="multi_item[display_order-'+i+']" value="'+i+'"><div class="form-group col-md-6"> <label for="title_en" class="required1">Title (Englist)</label> <input type="text" name="multi_item[title_en-'+i+']"  class="form-control" value="" > <div class="help-block"></div> </div><div class="form-group col-md-6"> <label for="title_bn" class="required1">Title (Bangla)</label> <input type="text" name="multi_item[title_bn-'+i+']"  class="form-control"  value="" >  <div class="help-block"></div> </div><div class="form-group col-md-6"> <label for="desc_en" class="required1">Description (English)</label> <textarea name="multi_item[desc_en-'+i+']" class="form-control summernote_editor" rows="5" placeholder="Enter description"></textarea> <div class="help-block"></div> </div><div class="form-group col-md-6"> <label for="desc_bn" class="required1">Description (Bangla)</label> <textarea name="multi_item[desc_bn-'+i+']" class="form-control summernote_editor" rows="5" placeholder="Enter description"></textarea> <div class="help-block"></div></div>'+
        img_section + 
        '<div class="form-group col-md-6"></div><div class="form-group col-md-4">'+
            '<label for="learn_more_btn_label_en" class="required1">Learn More Btn Lable (English)</label>'+
            '<input type="text" name="multi_item[learn_more_btn_label_en-'+i+']"  class="form-control section_name" placeholder="Enter title" value="">'+
            '<div class="help-block"></div>'+
            '<div class="help-block"></div>'+
        '</div>'+


        '<div class="form-group col-md-4">'+
            '<label for="learn_more_btn_label_bn" class="required1">Learn More Btn Lable (Bangla)</label>'+
            '<input type="text" name="multi_item[learn_more_btn_label_bn-'+i+']"  class="form-control section_name" placeholder="Enter title" value="">'+
            '<div class="help-block"></div>'+
            '<div class="help-block"></div>'+
        '</div>'+
        
        '<div class="col-md-4">'+
            '<div class="form-group">'+
                '<label for="exampleInputPassword1">Button link</label>'+
                '<input type="text" name="multi_item[learn_more_btn_link-'+i+']" class="form-control" rows="5" placeholder="Enter button link" value="">'+
            '</div>'+
        '</div>'+
        '<div class="form-group col-md-4">'+
            '<label for="others_btn_label_en" class="required1">Learn More Btn Lable (English)</label>'+
            '<input type="text" name="multi_item[others_btn_label_en-'+i+']"  class="form-control section_name" placeholder="Enter title" value="">'+
            '<div class="help-block"></div>'+
            '<div class="help-block"></div>'+
        '</div>'+


        '<div class="form-group col-md-4">'+
            '<label for="learn_more_btn_label_bn" class="required1">Learn More Btn Lable (Bangla)</label>'+
            '<input type="text" name="multi_item[learn_more_btn_label_bn-'+i+']"  class="form-control section_name" placeholder="Enter title" value="">'+
            '<div class="help-block"></div>'+
            '<div class="help-block"></div>'+
        '</div>'+
        
        '<div class="col-md-4">'+
            '<div class="form-group">'+
                '<label for="exampleInputPassword1">Button link</label>'+
                '<input type="text" name="multi_item[others_btn_link-'+i+']" class="form-control" rows="5" placeholder="Enter button link" value="">'+
            '</div>'+
        '</div>'+
        '<div class="form-group col-md-3"> <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button> </div> </div>';

	    $parentSelector.find('#multi_col_with_icon_content_section').append(html);
	    $parentSelector.find('.summernote_editor').summernote();

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

	     $(this).parents('.row.single_multi_col_with_icon_content').remove();

	   });

	}); // doc ready
</script>




@endpush
