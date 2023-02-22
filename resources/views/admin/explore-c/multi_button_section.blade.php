<div class="col-sm-12">
    <div class="add_button_wrap float-right">
      <a href="#" class="btn btn-info  btn-glow px-1 add_more_btn_section_item">+ Add Button Section</a>
    </div>
</div>

<div class="col-sm-12">
        @php
            $count = (isset($exploreC->multiple_attributes))? count($exploreC->multiple_attributes) : 1 ;
        @endphp
    <div id="btn_content_section" class="btn_content_section" data-count="1">
        <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$count}}">

        @if (isset($exploreC->multiple_attributes))
            
            @foreach ( $exploreC->multiple_attributes as $key => $single_attribute )

                <div class="row single_btn_section" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">
                    {{-- <input type="hidden" name="multi_item[id-{{ $key +1 }}]" value="{{ $key +1 }}"> --}}
                    {{-- <input type="hidden" name="multi_item[display_order-{{ $key +1 }}]" value="{{ $key +1 }}"> --}}


                    <div class="form-group col-md-6 {{ $errors->has('btn_label_en') ? ' error' : '' }}">
                        <label for="btn_label_en" class="required1">
                            Label (English)
                        </label>
                        <input type="text" name="multi_item[btn_label_en-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter btn label"
                            value="{{ $single_attribute['btn_label_en'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('btn_label_en'))
                            <div class="help-block">  {{ $errors->first('btn_label_en') }}</div>
                        @endif
                    </div>


                    <div class="form-group col-md-6 {{ $errors->has('btn_label_bn') ? ' error' : '' }}">
                        <label for="btn_label_bn" class="required1">
                            Label (Bangla)
                        </label>
                        <input type="text" name="multi_item[btn_label_bn-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter title"
                                value="{{ $single_attribute['btn_label_bn'] ?? null}}">
                        <div class="help-block"></div>
                        @if ($errors->has('btn_label_bn'))
                            <div class="help-block">  {{ $errors->first('btn_label_bn') }}</div>
                        @endif
                    </div>
                    
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">button Link En</label>
                            <input type="text" name="multi_item[btn_link_en-{{ $key +1 }}]" class="form-control " rows="5"
                                    placeholder="Enter Btn Link" value="{{ $single_attribute['btn_link_en'] ?? null}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">button Link Bn</label>
                            <input type="text" name="multi_item[btn_link_bn-{{ $key +1 }}]" class="form-control " rows="5"
                                    placeholder="Enter Btn Link" value="{{ $single_attribute['btn_link_bn'] ?? null}}">
                        </div>
                    </div> --}}

                    <div class="form-group col-md-6 {{ $errors->has('page_key') ? ' error' : '' }}">
                        <label for="page_key">Pages</label>
                        <select class="form-control" name="multi_item[page_key-{{ $key +1 }}]">
                            <option>---Select Page---</option>
                            @foreach($pages as $page)
                                <option value="{{ $page['url_slug'] }}" {{ ($single_attribute['page_key'] == $page['url_slug']) ? 'selected' : '' }}>{{ $page['page_name_en'] }}</option>
                            @endforeach
                        </select>
                        <div class="help-block"></div>
                        @if ($errors->has('page_key'))
                            <div class="help-block">  {{ $errors->first('page_key') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status" style="padding-bottom: 43px;"> </label>
                        <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>
                    </div>
                </div>
            @endforeach
            
        @else
            <div class="row single_btn_section" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">
                {{-- <input type="hidden" name="multi_item[id-1]" value="1"> --}}
                {{-- <input type="hidden" name="multi_item[display_order-1]" value="1"> --}}


                <div class="form-group col-md-6 {{ $errors->has('btn_label_en') ? ' error' : '' }}">
                    <label for="btn_label_en" class="required1">
                        Button Label (English)
                    </label>
                    <input type="text" name="multi_item[btn_label_en-1]"  class="form-control section_name" placeholder="Enter title"
                        value="">
                    <div class="help-block"></div>
                    @if ($errors->has('btn_label_en'))
                        <div class="help-block">  {{ $errors->first('btn_label_en') }}</div>
                    @endif
                </div>


                <div class="form-group col-md-6 {{ $errors->has('btn_label_bn') ? ' error' : '' }}">
                    <label for="btn_label_bn" class="required1">
                        Button Labe (Bangla)
                    </label>
                    <input type="text" name="multi_item[btn_label_bn-1]"  class="form-control section_name" placeholder="Enter title"
                            value="">
                    <div class="help-block"></div>
                    @if ($errors->has('btn_label_bn'))
                        <div class="help-block">  {{ $errors->first('btn_label_bn') }}</div>
                    @endif
                </div>
                
                
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Button link En</label>
                        <input type="text" name="multi_item[btn_link_en-1]" class="form-control" rows="5"
                                placeholder="Enter Btn link" value="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Button link Bn</label>
                        <input type="text" name="multi_item[btn_link_bn-1]" class="form-control" rows="5"
                                placeholder="Enter Btn link" value="">
                    </div>
                </div> --}}

                <div class="form-group col-md-6 {{ $errors->has('page_key') ? ' error' : '' }}">
                    <label for="page_key">Pages</label>
                    <select class="form-control" name="multi_item[page_key-1]">
                        <option>---Select Page---</option>
                        @foreach($pages as $page)
                            <option value="{{ $page['url_slug'] }}">{{ $page['page_name_en'] }}</option>

                        @endforeach
                    </select>
                    <div class="help-block"></div>
                    @if ($errors->has('page_key'))
                        <div class="help-block">  {{ $errors->first('page_key') }}</div>
                    @endif
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
        var pages = <?php echo json_encode($pages); ?>;
        var pageArray = '';

        $.each( pages, function( index, value ){
            pageArray += '<option value="'+value['url_slug']+'">'+value['page_name_en']+'</option>';
        });



	   // Add multiple item
	   $('.add_more_btn_section_item').on('click', function(event){
        event.preventDefault();

	   	$parentSelector = $('#explore_c_landing_btn');

	     var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);
         console.log(i);
	     // $('#text_content_section').empty();

	     i = i+1;

	     var html = '';

        html += '<div class="row single_btn_section" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">'+
            //'<input type="hidden" name="multi_item[id-'+i+']" value="'+i+'"><input type="hidden" name="multi_item[display_order-'+i+']" value="'+i+'">'+
            '<div class="form-group col-md-6">'+
                '<label for="btn_label_en" class="required1">Button Labe (English)</label>'+
                '<input type="text" name="multi_item[btn_label_en-'+i+']"  class="form-control section_name" placeholder="Enter title" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+


            '<div class="form-group col-md-6">'+
                '<label for="btn_label_bn" class="required1">Button Labe (Bangla)</label>'+
                '<input type="text" name="multi_item[btn_label_bn-'+i+']"  class="form-control section_name" placeholder="Enter title" value="">'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+
            
            /*'<div class="col-md-6">'+
                '<div class="form-group">'+
                    '<label for="exampleInputPassword1">Button link En</label>'+
                    '<input type="text" name="multi_item[btn_link_en-'+i+']" class="form-control" rows="5" placeholder="Enter button link" value="">'+
                '</div>'+
            '</div>'+

            '<div class="col-md-6">'+
                '<div class="form-group">'+
                    '<label for="exampleInputPassword1">Button link Bn</label>'+
                    '<input type="text" name="multi_item[btn_link_bn-'+i+']" class="form-control" rows="5" placeholder="Enter button link" value="">'+
                '</div>'+
            '</div>'+*/

            '<div class="form-group col-md-6">'+
                '<label for="page_key">Pages</label>'+
                '<select class="form-control" name="multi_item[page_key-'+i+']">'+
                    '<option>---Select Page---</option>'+
                    pageArray+
                '</select>'+
                '<div class="help-block"></div>'+
                '<div class="help-block"></div>'+
            '</div>'+

            '<div class="form-group">'+
                '<label for="status" style="padding-bottom: 43px;"> </label>'+
               ' <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>'+
            '</div>'+
        '</div>';
	     $parentSelector.find('#btn_content_section').append(html);


	     $parentSelector.find('#multi_item_count').val(i);
         console.log($('#multi_item_count').val());
	   });


	   $(document).on('click', '.multi_item_remove', function(e){

	     e.preventDefault();

	     $(this).parent().parent().remove();

        let parentSelector = $('#explore_c_landing_btn');
           let count =  parentSelector.find('#multi_item_count').val();

           parentSelector.find('#multi_item_count').val(count-1);

	   });




	}); // doc ready
</script>




@endpush
