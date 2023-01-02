<div class=" col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}">
    <label for="alt_text" class="required">Component Image (Desktop View)</label>
    <div class="custom-file">
        <input type="file" name="image_url" class="custom-file-input dropify"
                required data-validation-required-message="Slider image field is required" data-height="80" data-default-file="{{  isset($component) && isset($component->image_url) ? config('filesystems.file_base_url') . $component->image_url : ''}}">
    </div>
    <span class="text-primary">Please given file type (.png, .jpg)</span>

    <div class="help-block"></div>
    @if ($errors->has('image_url'))
        <div class="help-block">  {{ $errors->first('image_url') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('mobile_view_img') ? ' error' : '' }}">
    <label for="mobileImg">Component Image (Mobile View)</label>
    <div class="custom-file">
        <input type="file" name="mobile_view_img" class="custom-file-input dropify" data-height="80" data-default-file="{{  isset($component) && isset($component->mobile_view_img) ? config('filesystems.file_base_url') . $component->mobile_view_img : ''}}">
    </div>
    <span class="text-primary">Please given file type (.png, .jpg)</span>

    <div class="help-block"></div>
    @if ($errors->has('mobile_view_img'))
        <div class="help-block">  {{ $errors->first('mobile_view_img') }}</div>
    @endif
</div>
<div class=" col-md-6 form-group {{ $errors->has('alt_text_en') ? ' error' : '' }}">
    <label for="alt_text_en" class="required">Alt Text EN</label>
    <input type="text" name="alt_text_en"  class="form-control" placeholder="Enter alt text en"
            required data-validation-required-message="Enter alt text en"
            value="{{ old("alt_text_en") ? old("alt_text_en") : (isset($component) && isset($component->alt_text_en) ?  $component->alt_text_en : '')}}">
    <div class="help-block"></div>
    @if ($errors->has('alt_text_en'))
        <div class="help-block">  {{ $errors->first('alt_text_en') }}</div>
    @endif
</div>
<div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
    <label class="required">Alt Text BN</label>
    <input type="text" name="alt_text_bn"  class="form-control" placeholder="Enter alt text bn"
            required data-validation-required-message="Enter alt text bn"
            value="{{ old("alt_text_bn") ? old("alt_text_bn") : (isset($component) && isset($component->alt_text_bn) ?  $component->alt_text_bn : '') }}">
    <div class="help-block"></div>
    @if ($errors->has('alt_text_bn'))
        <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('image_name') ? ' error' : '' }}">
    <label class="required">Image Name EN</label>
    <input type="text" name="image_name"  class="form-control" placeholder="Enter image name en"
            required data-validation-required-message="Enter image name en"
            value="{{ old("image_name") ? old("image_name") : (isset($component) && isset($component->image_name) ?  $component->image_name : '') }}">
    <div class="help-block"></div>
    @if ($errors->has('image_name'))
        <div class="help-block">  {{ $errors->first('image_name') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
    <label class="required">Image Name BN</label>
    <input type="text" name="image_name_bn"  class="form-control" placeholder="Enter image name en"
            required data-validation-required-message="Enter image name en"
            value="{{ old("image_name_bn") ? old("image_name_bn") : (isset($component) && isset($component->image_name_bn) ?  $component->image_name_bn : '') }}">
    <div class="help-block"></div>
    @if ($errors->has('image_name_bn'))
        <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
    @endif
</div>
<div class="col-md-4">
    <label></label>
    <div class="form-group mt-1">
        <label for="is_icon" class="mr-1">Is Icon:</label>
        <input type="checkbox" name="other_attributes[is_icon]" value="1" id="is_icon" {{ (!empty($other_attributes['is_icon'])) ? 'checked' : null }}>
    </div>
</div>

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script>
        $(function () {
            $("textarea#details").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                height:150
            })

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        })
    </script>

@endpush
