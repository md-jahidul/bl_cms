<div class="col-sm-12">
    <div class="add_button_wrap float-right">
    <a href="#" class="btn btn-info  btn-glow px-1 plus-image">+ Add Image</a>
    </div>
</div>
@php
    $count = (isset($component->multiple_attributes))? count($component->multiple_attributes) : 1 ;
@endphp
<input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$count}}">
@if (isset($component->multiple_attributes))
            
    @foreach ( $component->multiple_attributes as $key => $single_attribute )

        <div class="col-md-6 col-xs-6 option-{{ $key +1 }}">
            <div class="form-group">
                <label for="message">Multiple Image</label>
                <input type="file" class="dropify" name="multi_item[image_url-{{ $key +1 }}]" data-height="80" data-default-file="{{ isset($single_attribute['image_url']) ? config('filesystems.file_base_url') . $single_attribute['image_url'] : '' }}"/>
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
            </div>
        </div>

        <div class="form-group col-md-5 option-{{ $key +1 }}">
            <label for="alt_text">Alt Text</label>
            <input type="text" name="multi_item[alt_text-{{ $key +1 }}]" class="form-control" value="{{ $single_attribute['alt_text'] ?? null}}">

        </div>


        <div class="form-group col-md-1 option-{{ $key +1 }}">
            <label for="alt_text"></label>
            <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-{{ $key +1 }}"><i data-id="option-1" class="la la-trash"></i></button>
        </div>
    @endforeach
@else
    <div class="col-md-6 col-xs-6 option-1">
        <div class="form-group">
            <label for="message">Multiple Image</label>
            <input type="file" class="dropify" name="multi_item[image_url-1]" data-height="80"/>
            <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        </div>
    </div>

    <div class="form-group col-md-5 option-1">
        <label for="alt_text">Alt Text</label>
        <input type="text" name="multi_item[alt_text-1]" class="form-control">

    </div>


    <div class="form-group col-md-1 option-1">
        <label for="alt_text"></label>
        <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-1"><i data-id="option-1" class="la la-trash"></i></button>
    </div>
@endif



@push('page-js')

<script type="text/javascript">
	$(document).ready(function () {

        function dropify(){
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        }
        dropify();

        // Multi Image Component
        $('.plus-image').click(function (e) {
            e.preventDefault();
            
            let option_count = $('.options-count');
            let total_option = option_count.length + 1;
            

            var input = '<div class="col-md-6 col-xs-6 options-count option-'+total_option+'">\n' +
                //'<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
                '<div class="form-group">\n' +
                '      <label for="message">Multiple Image</label>\n' +
                '      <input type="file" class="dropify" name="multi_item[image_url-'+total_option+']" data-height="80"/>\n' +
                '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                '  </div>\n' +
                ' </div>\n'+
                '<div class="form-group col-md-5 option-'+total_option+'">\n' +
                '    <label for="alt_text">Alt Text</label>\n' +
                '    <input type="text" name="multi_item[alt_text-'+total_option+']"  class="form-control">\n' +
                '</div>\n' +
                '<div class="form-group col-md-1 option-'+total_option+'">\n' +
                '   <label for="alt_text"></label>\n' +
                '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-'+total_option+'" ><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
                '</div>';
            $('#multiple_image').append(input);
            let parentSelector = $('#multiple_image');

            parentSelector.find('#multi_item_count').val(total_option);
            dropify();
        });


	   $(document).on('click', '.remove-image', function(e){

	     e.preventDefault();

         console.log($(this).data("id") );

	    // $(this).remove();
        $('.'+$(this).data("id")).remove();
        let option_count = $('.options-count').find();
        let total_option = option_count.length;
        $('#multi_item_count').val(total_option)

        let parentSelector = $('#multiple_image');
        let count =  parentSelector.find('#multi_item_count').val();

        parentSelector.find('#multi_item_count').val(count-1);


	   });


	}); // doc ready

</script>




@endpush