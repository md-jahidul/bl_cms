@include('layouts.partials.app-service.common-field.validity-unit')
@include('layouts.partials.app-service.common-field.price')
@include('layouts.partials.app-service.common-field.tag')

@include('layouts.partials.app-service.common-field.product-image', ['imgField' => 'imgOne', 'showImg' => 'imgShowOne'])

<div class="form-group col-md-6 {{ $errors->has('google_play_link') ? ' error' : '' }}">
    <label for="title">Google Play Store Link</label>
    <input type="text" name="google_play_link"  class="form-control" placeholder="Enter play store link"
    value="{{ isset($appServiceProduct->google_play_link) ? $appServiceProduct->google_play_link : "" }}">
    <div class="help-block"></div>
    @if ($errors->has('google_play_link'))
        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('app_store_link') ? ' error' : '' }}">
    <label for="title">App Store Link</label>
    <input type="text" name="app_store_link"  class="form-control" placeholder="Enter app store link"
    value="{{ isset($appServiceProduct->app_store_link) ? $appServiceProduct->app_store_link : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('app_store_link'))
        <div class="help-block">  {{ $errors->first('app_store_link') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('app_review') ? ' error' : '' }}">
    <label for="title">Total User Ratings</label>
    <input type="text" name="app_review"  class="form-control app_review" placeholder="Enter Total Ratings"
    value="{{ isset($appServiceProduct->app_review) ? $appServiceProduct->app_review : "" }}">
    <div class="help-block"></div>
    @if ($errors->has('app_review'))
        <div class="help-block">  {{ $errors->first('app_review') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('app_rating') ? ' error' : '' }}">
    <label for="title" class="required">Average Rating</label>
    <input type="text" name="app_rating"  class="form-control app_rating" placeholder="Enter Average Rating"
    value="{{ isset($appServiceProduct->app_rating) ? $appServiceProduct->app_rating : '' }}" required>
    <div class="help-block"></div>
    @if ($errors->has('app_rating'))
        <div class="help-block">  {{ $errors->first('app_rating') }}</div>
    @endif
</div>

<h4>
    <strong>Referral Engine Part</strong>
</h4>
<div class="form-actions col-md-12 mt-0"></div>

<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
    <label for="title_en">Title (English)</label>
    <input type="text" name="referral[title_en]" id="title_en" class="form-control" placeholder="Enter offer name in English"
           value="{{ isset($referralInfo->title_en) ? $referralInfo->title_en : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('title_en'))
        <div class="help-block">{{ $errors->first('title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn">Title (Bangla)</label>
    <input type="text" name="referral[title_bn]" id="title_bn" class="form-control" placeholder="Enter offer name in Bangla"
           value="{{ isset($referralInfo->title_bn) ? $referralInfo->title_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('title_bn'))
        <div class="help-block">{{ $errors->first('title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 ">
    <label for="rf_details_en">Description (English)</label>
    <textarea type="text" name="referral[details_en]" id="rf_details_en" class="form-control summernote_editor" placeholder="Enter description in English"
    >{{ isset($referralInfo->details_en) ? $referralInfo->details_en : '' }}</textarea>
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="rf_details_bn">Description (Bangla)</label>
    <textarea type="text" name="referral[details_bn]" id="rf_details_bn" class="form-control summernote_editor" placeholder="Enter description in Bangla"
    >{{ isset($referralInfo->details_bn) ? $referralInfo->details_bn : '' }}</textarea>
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 {{ $errors->has('btn_title_en') ? ' error' : '' }}">
    <label for="btn_title_en">Button Title (English)</label>
    <input type="text" name="referral[btn_title_en]" id="btn_title_en" class="form-control" placeholder="Enter Button name in English"
           value="{{ isset($referralInfo->btn_title_en) ? $referralInfo->btn_title_en : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('btn_title_en'))
        <div class="help-block">{{ $errors->first('btn_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('btn_title_bn') ? ' error' : '' }}">
    <label for="btn_title_bn"> Button Title (Bangla)</label>
    <input type="text" name="referral[btn_title_bn]" id="btn_title_bn" class="form-control" placeholder="Enter Button name in Bangla"
           value="{{ isset($referralInfo->btn_title_bn) ? $referralInfo->btn_title_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('btn_title_bn'))
        <div class="help-block">{{ $errors->first('btn_title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-12 {{ $errors->has('referral_image') ? ' error' : '' }}">
    <label for="alt_text" class="">Image</label>
    <div class="custom-file">
        <input type="file" name="referral[referral_image]" 
        data-default-file="{{ (isset($referralInfo->referral_image)) ?  config('filesystems.file_base_url') . $referralInfo->referral_image : null  }}"
        class="dropify">
    </div>
    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

    <div class="help-block"></div>
    @if ($errors->has('referral_image'))
        <div class="help-block">  {{ $errors->first('referral_image') }}</div>
    @endif
</div>

<div class="col-md-6">
    <label></label>
    <div class="form-group">
        <label for="title" class="mr-1">Referral Engine Status:</label>
        <input type="radio" name="referral[status]" value="1" id="active" {{ isset($referralInfo->status) ? ($referralInfo->status == 1) ? 'checked' : '' : 'checked' }}>
        <label for="active" class="mr-1">Active</label>

        <input type="radio" name="referral[status]" value="0" id="inactive" {{ isset($referralInfo->status) ? ($referralInfo->status == 0) ? 'checked' : '' : '' }}>
        <label for="inactive">Inactive</label>
    </div>
</div>


<div class="form-actions col-md-12 mt-0"></div>



@push('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script>
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
                height: 100
            });
        })
    </script>
@endpush

