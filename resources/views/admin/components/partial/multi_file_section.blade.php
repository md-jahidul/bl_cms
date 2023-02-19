<div class="col-sm-12">
    <div class="add_button_wrap float-right">
      <a href="#" class="btn btn-info  btn-glow px-1 add_more_file_section_item">+ Add File Section</a>
    </div>
</div>

<div class="col-sm-12">
        @php
            $count = (isset($component->multiple_attributes))? count($component->multiple_attributes) : 1 ;
        @endphp
    <div id="file_content_section" class="file_content_section" data-count="1">
        <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$count}}">

        @if (isset($component->multiple_attributes))
            
            @foreach ( $component->multiple_attributes as $key => $single_attribute )

                <div class="row single_file_section" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">
                    <input type="hidden" name="multi_item[id-{{ $key +1 }}]" value="{{ $key +1 }}">
                    <input type="hidden" name="multi_item[display_order-{{ $key +1 }}]" value="{{ $key +1 }}">


                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                        <label for="title_en" class="required1">
                            Title (English)
                        </label>
                        <input type="text" name="multi_item[title_en-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter title"
                            value="{{ $single_attribute['title_en'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('title_en'))
                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                        @endif
                    </div>


                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                        <label for="title_bn" class="required1">
                            Title (Bangla)
                        </label>
                        <input type="text" name="multi_item[title_bn-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter title"
                                value="{{ $single_attribute['title_bn'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('title_bn'))
                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description (English)</label>
                            <textarea name="multi_item[desc_en-{{ $key +1 }}]" class="form-control" rows="5"
                                    placeholder="Enter description">{{ $single_attribute['desc_en'] ?? null}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description (Bangla)</label>
                            <textarea name="multi_item[desc_bn-{{ $key +1 }}]" class="form-control" rows="5"
                                    placeholder="Enter description">{{ $single_attribute['desc_bn'] ?? null}}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('file_url') ? ' error' : '' }}">
                        <label for="file_url" class="">File</label>
                        <div class="custom-file">
                            <input type="file" name="multi_item[file_url-{{ $key +1 }}]" class="dropify" data-default-file="{{ isset($single_attribute['file_url']) ? config('filesystems.file_base_url') . $single_attribute['file_url'] : '' }}">
                        </div>
                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                        <div class="help-block"></div>
                        @if ($errors->has('file_url'))
                            <div class="help-block">  {{ $errors->first('file_url') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6"></div>

                    <div class="form-group">
                        <label for="status" style="padding-bottom: 43px;"> </label>
                        <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>
                    </div>
                </div>
            @endforeach
            
        @else
            <div class="row single_file_section" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">
                <input type="hidden" name="multi_item[id-1]" value="1">
                <input type="hidden" name="multi_item[display_order-1]" value="1">


                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                    <label for="title_en" class="required1">
                        Title (English)
                    </label>
                    <input type="text" name="multi_item[title_en-1]"  class="form-control section_name" placeholder="Enter title"
                        value="">
                    <div class="help-block"></div>
                    @if ($errors->has('title_en'))
                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                    @endif
                </div>


                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                    <label for="title_bn" class="required1">
                        Title (Bangla)
                    </label>
                    <input type="text" name="multi_item[title_bn-1]"  class="form-control section_name" placeholder="Enter title"
                            value="">
                    <div class="help-block"></div>
                    @if ($errors->has('title_bn'))
                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                    @endif
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description (English)</label>
                        <textarea name="multi_item[desc_en-1]" class="form-control" rows="5"
                                placeholder="Enter description"></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description (Bangla)</label>
                        <textarea name="multi_item[desc_bn-1]" class="form-control" rows="5"
                                placeholder="Enter description"></textarea>
                    </div>
                </div>

                <div class="form-group col-md-6 {{ $errors->has('file_url') ? ' error' : '' }}">
                    <label for="file_url" class="">File</label>
                    <div class="custom-file">
                        <input type="file" name="multi_item[file_url-1]" class="dropify" data-default-file="{{ isset($single_attribute['file_url']) ? config('filesystems.file_base_url') . $single_attribute['file_url'] : '' }}">
                    </div>
                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                    <div class="help-block"></div>
                    @if ($errors->has('file_url'))
                        <div class="help-block">  {{ $errors->first('file_url') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-6"></div>


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

	   // Add multiple item
	   $('.add_more_file_section_item').on('click', function(event){
        event.preventDefault();

	   	$parentSelector = $('#multi_application_form_with_title');

	     var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);
         console.log(i);
	     // $('#file_content_section').empty();

	     i = i+1;

	     var html = '';

        html += '<div class="row single_file_section" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">'+
            '<input type="hidden" name="multi_item[id-'+i+']" value="'+i+'"><input type="hidden" name="multi_item[display_order-'+i+']" value="'+i+'">'+
            '<div class="form-group col-md-6">'+
                '<label for="title_en" class="required1">Title (English)</label>'+
                '<input type="text" name="multi_item[title_en-'+i+']"  class="form-control section_name" placeholder="Enter title" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+


            '<div class="form-group col-md-6">'+
                '<label for="title_bn" class="required1">Title (Bangla)</label>'+
                '<input type="text" name="multi_item[title_bn-'+i+']"  class="form-control section_name" placeholder="Enter title" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+
            
            '<div class="col-md-6">'+
                '<div class="form-group">'+
                    '<label for="exampleInputPassword1">Description (English)</label>'+
                    '<textarea name="multi_item[desc_en-'+i+']" class="form-control summernote_editor" rows="5" placeholder="Enter description"></textarea>'+
                '</div>'+
            '</div>'+

            '<div class="col-md-6">'+
                '<div class="form-group">'+
                    '<label for="exampleInputPassword1">Description (Bangla)</label>'+
                    '<textarea name="multi_item[desc_bn-'+i+']" class="form-control summernote_editor" rows="5" placeholder="Enter description"></textarea>'+
                '</div>'+
            '</div>'+

            '<div class="form-group col-md-6">'+
                '<label for="file_url" class="">File</label>'+
                '<div class="custom-file"><input type="file" name="multi_item[file_url-'+i+']" class="dropify"></div>'+
                '<span class="text-primary">Please given file type (.png, .jpg, svg)</span>'+
                '<div class="help-block"></div>'+
            '</div>'+

            '<div class="form-group">'+
                '<label for="status" style="padding-bottom: 43px;"> </label>'+
               ' <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>'+
            '</div>'+
        '</div>';
	     $parentSelector.find('#file_content_section').append(html);


	     $parentSelector.find('#multi_item_count').val(i);
         console.log($('#multi_item_count').val());
	   });


	   $(document).on('click', '.multi_item_remove', function(e){

	     e.preventDefault();

	     $(this).parent().parent().remove();

        let parentSelector = $('#multi_application_form_with_title');
        let count =  parentSelector.find('#multi_item_count').val();

        parentSelector.find('#multi_item_count').val(count-1);

	   });




	}); // doc ready
</script>




@endpush
