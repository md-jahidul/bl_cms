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

<div class="form-actions col-md-12 mt-0"></div>
