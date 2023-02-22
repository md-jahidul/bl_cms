{{-- {{ Form::hidden('component_type', 'multi_col_for_video' ) }} --}}

<div class="col-sm-12">
    <div class="add_button_wrap float-right">
      <a href="#" class="btn btn-info  btn-glow px-1 add_more_multi_col_video_item">+ Add Column</a>
    </div>
</div>

<div class="col-sm-12">
        @php
            $count = (isset($component->multiple_attributes))? count($component->multiple_attributes) : 0 ;
        @endphp

    <div id="multi_col_video_content_section" class="multi_col_video_content_section" data-count="1">
        <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$count}}">

        {{-- <input type="hidden" name="multi_item[id-1]" value="1">
        <input type="hidden" name="multi_item[display_order-1]" value="0"> --}}
        @if (isset($component->multiple_attributes))
            
            @foreach ( $component->multiple_attributes as $key => $single_attribute )
                <h4>Column: {{ $key +1 }}</h4>
                <hr class="hr">
                <div class="row single_multi_col_video_content">

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

                    <div class="form-group col-md-6 {{ $errors->has('video_url') ? ' error' : '' }}">
                        <label for="video_url" class="required1">Video URL</label>
                        <input type="text" name="multi_item[video_url-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['video_url'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('video_url'))
                            <div class="help-block">  {{ $errors->first('video_url') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('year_en') ? ' error' : '' }}">
                        <label for="year_en" class="required1">Year (English)</label>
                        <input type="text" name="multi_item[year_en-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['year_en'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('year_en'))
                            <div class="help-block">  {{ $errors->first('year_en') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('year_bn') ? ' error' : '' }}">
                        <label for="year_bn" class="required1">Year (Bangla)</label>
                        <input type="text" name="multi_item[year_bn-{{ $key +1 }}]"  class="form-control"
                            value="{{ $single_attribute['year_bn'] ?? null}}" >
                        <div class="help-block"></div>
                        @if ($errors->has('year_bn'))
                            <div class="help-block">  {{ $errors->first('year_bn') }}</div>
                        @endif
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
	   $('.add_more_multi_col_video_item').on('click', function(event){
            
            event.preventDefault();


	   	$parentSelector = $('#multi_col_for_video');

	    var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);
	     // $('#multi_col_video_content_section').empty();

	    i = i+1;
        console.log(i);

	    var html = '';

	    html += '<h4>Column: '+i+'</h4> <hr class="hr"><div class="row single_multi_col_video_content"><input type="hidden" name="multi_item[id-'+i+']" value="'+i+'"><input type="hidden" name="multi_item[display_order-'+i+']" value="'+i+'">'+
            '<div class="form-group col-md-6"> <label for="title_en" class="required1">Title (Englist)</label> <input type="text" name="multi_item[title_en-'+i+']"  class="form-control" value="" > <div class="help-block"></div> </div>'+
            '<div class="form-group col-md-6"> <label for="title_bn" class="required1">Title (Bangla)</label> <input type="text" name="multi_item[title_bn-'+i+']"  class="form-control"  value="" >  <div class="help-block"></div> </div>'+
            
            '<div class="form-group col-md-6"> <label for="video_url" class="required1">Video URL</label> <input type="text" name="multi_item[video_url-'+i+']"  class="form-control" value="" > <div class="help-block"></div> </div>'+
            
            '<div class="form-group col-md-6"> <label for="year_en" class="required1">Year (Englist)</label> <input type="text" name="multi_item[year_en-'+i+']"  class="form-control" value="" > <div class="help-block"></div> </div>'+
            '<div class="form-group col-md-6"> <label for="year_bn" class="required1">Year (Bangla)</label> <input type="text" name="multi_item[year_bn-'+i+']"  class="form-control"  value="" >  <div class="help-block"></div> </div>'+
            
            '<div class="form-group"> <label for="status" style="padding-bottom: 43px;"> </label>'+ 
            '<button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button> </div> </div>';

            
	     $parentSelector.find('#multi_col_video_content_section').append(html);

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

	     $(this).parents('.row.single_multi_col_video_content').remove();

	   });

	}); // doc ready
</script>




@endpush
