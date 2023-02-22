@include('layouts.partials.app-service.common-field.validity-unit')
@include('layouts.partials.app-service.common-field.price')
@include('layouts.partials.app-service.common-field.tag')

{{--@include('layouts.partials.app-service.common-field.product-image', ['imgField' => 'imgOne', 'showImg' => 'imgShowOne'])--}}

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

