<div class="col-sm-12">
    <div class="add_button_wrap float-right">
      <a href="#" class="btn btn-info  btn-glow px-1 add_more_testimonials_section_item">+ Add Section</a>
    </div>
</div>

<div class="col-sm-12">
        @php
            $count = (isset($component->multiple_attributes))? count($component->multiple_attributes) : 1 ;
        @endphp
    <div id="testimonials_content_section" class="testimonials_content_section" data-count="1">
        <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$count}}">

        @if (isset($component->multiple_attributes))
            
            @foreach ( $component->multiple_attributes as $key => $single_attribute )

                <div class="row single_testimonials_section" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">
                    <input type="hidden" name="multi_item[id-{{ $key +1 }}]" value="{{ $key +1 }}">
                    <input type="hidden" name="multi_item[display_order-{{ $key +1 }}]" value="{{ $key +1 }}">


                    <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                        <label for="name_en" class="required1">
                            Name (English)
                        </label>
                        <input type="text" name="multi_item[name_en-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter name"
                            value="{{ $single_attribute['name_en'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('name_en'))
                            <div class="help-block">  {{ $errors->first('name_en') }}</div>
                        @endif
                    </div>


                    <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                        <label for="name_bn" class="required1">
                            Name (Bangla)
                        </label>
                        <input type="text" name="multi_item[name_bn-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter Name"
                                value="{{ $single_attribute['name_bn'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('name_bn'))
                            <div class="help-block">  {{ $errors->first('name_bn') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('designation_en') ? ' error' : '' }}">
                        <label for="designation_en" class="required1">
                            Designation (English)
                        </label>
                        <input type="text" name="multi_item[designation_en-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter designation"
                            value="{{ $single_attribute['designation_en'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('designation_en'))
                            <div class="help-block">  {{ $errors->first('designation_en') }}</div>
                        @endif
                    </div>


                    <div class="form-group col-md-6 {{ $errors->has('designation_bn') ? ' error' : '' }}">
                        <label for="designation_bn" class="required1">
                            Designation (Bangla)
                        </label>
                        <input type="text" name="multi_item[designation_bn-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter Designation"
                                value="{{ $single_attribute['designation_bn'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('designation_bn'))
                            <div class="help-block">  {{ $errors->first('designation_bn') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('organization_en') ? ' error' : '' }}">
                        <label for="organization_en" class="required1">
                            Organization (English)
                        </label>
                        <input type="text" name="multi_item[organization_en-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter Organization"
                            value="{{ $single_attribute['organization_en'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('organization_en'))
                            <div class="help-block">  {{ $errors->first('organization_en') }}</div>
                        @endif
                    </div>


                    <div class="form-group col-md-6 {{ $errors->has('organization_bn') ? ' error' : '' }}">
                        <label for="organization_bn" class="required1">
                            Organization (Bangla)
                        </label>
                        <input type="text" name="multi_item[organization_bn-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter Organization"
                                value="{{ $single_attribute['organization_bn'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('organization_bn'))
                            <div class="help-block">  {{ $errors->first('organization_bn') }}</div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Quotation (English)</label>
                            <textarea name="multi_item[quotation_en-{{ $key +1 }}]" class="form-control" rows="5"
                                    placeholder="Enter description">{{ $single_attribute['quotation_en'] ?? null}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Quotation (Bangla)</label>
                            <textarea name="multi_item[quotation_bn-{{ $key +1 }}]" class="form-control" rows="5"
                                    placeholder="Enter description">{{ $single_attribute['quotation_bn'] ?? null}}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-6 image_url {{ $errors->has('image_url') ? ' error' : '' }} {{ !isset($single_attribute['is_video']) ? '' : 'd-none' }}">
                        <label for="image_url" class="">Image</label>
                        <div class="custom-file">
                            <input type="file" name="multi_item[image_url-{{ $key +1 }}]" class="dropify" data-default-file="{{ isset($single_attribute['image_url']) ? config('filesystems.file_base_url') . $single_attribute['image_url'] : '' }}">
                        </div>
                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                        <div class="help-block"></div>
                        @if ($errors->has('image_url'))
                            <div class="help-block">  {{ $errors->first('image_url') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 video_url {{ $errors->has('video_url') ? ' error' : '' }} {{ isset($single_attribute['is_video']) && optional($single_attribute)['is_video'] == 1 ? '' : 'd-none' }}">
                        <label for="video_url">Video URL</label>
                        <input type="text" name="multi_item[video_url-{{ $key +1 }}]" class="form-control" placeholder="Enter URL"
                            value="{{ $single_attribute['video_url'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('video_url'))
                            <div class="help-block">  {{ $errors->first('video_url') }}</div>
                        @endif
                    </div>

                    <div class="col-md-6 mt-1">
                        <label></label>
                        <div class="form-group">
                            <label for="is_video">Is Video:</label>
                            <input type="checkbox" name="multi_item[is_video-1]" class="is_video" value="1" {{ (isset($single_attribute) && optional($single_attribute)['is_video'] == 1) ? 'checked' : (old("other_attr.is_video") ? 'checked' : '') }}>
                        </div>
                    </div>  

                    <div class="form-group col-md-6"></div>

                    <div class="form-group">
                        <label for="status" style="padding-bottom: 43px;"> </label>
                        <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>
                    </div>
                </div>
            @endforeach
            
        @else
            <div class="row single_testimonials_section" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">
                <input type="hidden" name="multi_item[id-1]" value="1">
                <input type="hidden" name="multi_item[display_order-1]" value="1">


                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                    <label for="name_en" class="required1">
                        Name (English)
                    </label>
                    <input type="text" name="multi_item[name_en-1]"  class="form-control section_name" placeholder="Enter Name"
                        value="">
                    <div class="help-block"></div>
                    @if ($errors->has('name_en'))
                        <div class="help-block">  {{ $errors->first('name_en') }}</div>
                    @endif
                </div>


                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                    <label for="name_bn" class="required1">
                        Name (Bangla)
                    </label>
                    <input type="text" name="multi_item[name_bn-1]"  class="form-control section_name" placeholder="Enter Name"
                            value="">
                    <div class="help-block"></div>
                    @if ($errors->has('name_bn'))
                        <div class="help-block">  {{ $errors->first('name_bn') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('designation_en') ? ' error' : '' }}">
                    <label for="designation_en" class="required1">
                        Designation (English)
                    </label>
                    <input type="text" name="multi_item[designation_en-1]"  class="form-control section_name" placeholder="Enter Designation"
                        value="">
                    <div class="help-block"></div>
                    @if ($errors->has('designation_en'))
                        <div class="help-block">  {{ $errors->first('designation_en') }}</div>
                    @endif
                </div>


                <div class="form-group col-md-6 {{ $errors->has('designation_bn') ? ' error' : '' }}">
                    <label for="designation_bn" class="required1">
                        Designation (Bangla)
                    </label>
                    <input type="text" name="multi_item[designation_bn-1]"  class="form-control section_name" placeholder="Enter Designation"
                            value="">
                    <div class="help-block"></div>
                    @if ($errors->has('designation_bn'))
                        <div class="help-block">  {{ $errors->first('designation_bn') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('organization_en') ? ' error' : '' }}">
                    <label for="organization_en" class="required1">
                        Organization (English)
                    </label>
                    <input type="text" name="multi_item[organization_en-1]"  class="form-control section_name" placeholder="Enter Organization"
                        value="">
                    <div class="help-block"></div>
                    @if ($errors->has('organization_en'))
                        <div class="help-block">  {{ $errors->first('organization_en') }}</div>
                    @endif
                </div>


                <div class="form-group col-md-6 {{ $errors->has('organization_bn') ? ' error' : '' }}">
                    <label for="organization_bn" class="required1">
                        Organization (Bangla)
                    </label>
                    <input type="text" name="multi_item[organization_bn-1]"  class="form-control section_name" placeholder="Enter Organization"
                            value="">
                    <div class="help-block"></div>
                    @if ($errors->has('organization_bn'))
                        <div class="help-block">  {{ $errors->first('organization_bn') }}</div>
                    @endif
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Quotation (English)</label>
                        <textarea name="multi_item[quotation_en-1]" class="form-control" rows="5"
                                placeholder="Enter description"></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Quotation (Bangla)</label>
                        <textarea name="multi_item[quotation_bn-1]" class="form-control" rows="5"
                                placeholder="Enter description"></textarea>
                    </div>
                </div>

                <div class="form-group col-md-6 image_url d-none">
                    <label for="image_url" class="">Image</label>
                    <div class="custom-file">
                        <input type="file" name="multi_item[image_url-1]" class="dropify" data-default-file="{{ isset($single_attribute['image_url']) ? config('filesystems.file_base_url') . $single_attribute['image_url'] : '' }}">
                    </div>
                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                    <div class="help-block"></div>
                    <div class="help-block"></div>
                </div>
                
                <div class="form-group col-md-6 video_url">
                    <label for="video_url">Video URL</label>
                    <input type="text" name="multi_item[video_url-1]" class="form-control" placeholder="Enter URL"
                        value="">
                    <div class="help-block"></div>
                    <div class="help-block"> </div>
                </div>

                <div class="col-md-6 mt-1">
                    <label></label>
                    <div class="form-group">
                        <label for="is_video">Is Video:</label>
                        <input type="checkbox" name="multi_item[is_video-1]" class="is_video" value="1" checked>
                    </div>
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
	   $('.add_more_testimonials_section_item').on('click', function(event){
        event.preventDefault();

	   	$parentSelector = $('#testimonials_with_title_desc');

	     var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);
         console.log(i);
	     // $('#testimonials_content_section').empty();

	     i = i+1;

	     var html = '';

        html += '<div class="row single_testimonials_section" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">'+
            '<input type="hidden" name="multi_item[id-'+i+']" value="'+i+'"><input type="hidden" name="multi_item[display_order-'+i+']" value="'+i+'">'+

            '<div class="form-group col-md-6">'+
                '<label for="name_en" class="required1">Name (English)</label>'+
                '<input type="text" name="multi_item[name_en-'+i+']"  class="form-control section_name" placeholder="Enter Name" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+


            '<div class="form-group col-md-6">'+
                '<label for="name_bn" class="required1">Name (Bangla)</label>'+
                '<input type="text" name="multi_item[name_bn-'+i+']"  class="form-control section_name" placeholder="Enter Name" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+

            '<div class="form-group col-md-6">'+
                '<label for="designation_en" class="required1">Designation (English)</label>'+
                '<input type="text" name="multi_item[designation_en-'+i+']"  class="form-control section_name" placeholder="Enter Designation" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+


            '<div class="form-group col-md-6">'+
                '<label for="designation_bn" class="required1">Designation (Bangla)</label>'+
                '<input type="text" name="multi_item[designation_bn-'+i+']"  class="form-control section_name" placeholder="Enter Designation" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+

            '<div class="form-group col-md-6">'+
                '<label for="organization_en" class="required1">Organization (English)</label>'+
                '<input type="text" name="multi_item[organization_en-'+i+']"  class="form-control section_name" placeholder="Enter Organization" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+


            '<div class="form-group col-md-6">'+
                '<label for="organization_bn" class="required1">Organization (Bangla)</label>'+
                '<input type="text" name="multi_item[organization_bn-'+i+']"  class="form-control section_name" placeholder="Enter Organization" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+
            
            '<div class="col-md-6">'+
                '<div class="form-group">'+
                    '<label for="exampleInputPassword1">Quotation (English)</label>'+
                    '<textarea name="multi_item[quotation_en-'+i+']" class="form-control summernote_editor" rows="5" placeholder="Enter quotation"></textarea>'+
                '</div>'+
            '</div>'+

            '<div class="col-md-6">'+
                '<div class="form-group">'+
                    '<label for="exampleInputPassword1">Quotation (Bangla)</label>'+
                    '<textarea name="multi_item[quotation_bn-'+i+']" class="form-control summernote_editor" rows="5" placeholder="Enter quotation"></textarea>'+
                '</div>'+
            '</div>'+

            '<div class="form-group col-md-6 image_url d-none">'+
                '<label for="image_url" class="">Image</label>'+
                '<div class="custom-file"><input type="file" name="multi_item[image_url-'+i+']" class="dropify"></div>'+
                '<span class="text-primary">Please given file type (.png, .jpg, svg)</span>'+
                '<div class="help-block"></div>'+
            '</div>'+

            '<div class="form-group col-md-6 video_url">'+
                '<label for="video_url">Video URL</label>'+
                '<input type="text" name="multi_item[video_url-'+i+']" class="form-control" placeholder="Enter URL" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"> </div>'+
            '</div>'+

            '<div class="col-md-6 mt-1">'+
                '<label></label>'+
                '<div class="form-group">'+
                    '<label for="is_video">Is Video:</label>'+
                    '<input type="checkbox" name="multi_item[is_video-'+i+']" class="is_video" value="1" checked>'+
                '</div>'+
            '</div>'+

            '<div class="form-group">'+
                '<label for="status" style="padding-bottom: 43px;"> </label>'+
               ' <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>'+
            '</div>'+
        '</div>';
	     $parentSelector.find('#testimonials_content_section').append(html);

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

	    $(this).parent().parent().remove();

        let parentSelector = $('#testimonials_with_title_desc');
        let count =  parentSelector.find('#multi_item_count').val();

        parentSelector.find('#multi_item_count').val(count-1);

	   });

    $(document).on('change', '.is_video', function(){


        var object = $(this).parents('.single_testimonials_section');

        var image_url = object.find('.image_url');
        var video_url = object.find('.video_url');

        if($(this).prop("checked") == true){

            video_url.removeClass('d-none');
            image_url.addClass('d-none');
        }else{

            image_url.removeClass('d-none');
            video_url.addClass('d-none');
        }
    });




	}); // doc ready
</script>




@endpush