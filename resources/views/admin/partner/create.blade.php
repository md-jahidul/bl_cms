@extends('layouts.admin')
@section('title', 'Partner Create')
@section('card_name', 'Partner Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('partners') }}"> Partner List</a></li>
    <li class="breadcrumb-item active"> Partner Create</li>
@endsection
@section('action')
    <a href="{{ url('partners') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('partners.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('company_name_en') ? ' error' : '' }}">
                                    <label for="company_name_en" class="required">Company Name (English)</label>
                                    <input type="text" name="company_name_en"  class="form-control" placeholder="Enter company name in English"
                                           value="{{ old("company_name_en") ? old("company_name_en") : '' }}" required data-validation-required-message="Enter company name in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('company_name_en'))
                                        <div class="help-block">  {{ $errors->first('company_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('company_name_bn') ? ' error' : '' }}">
                                    <label for="company_name_bn" class="required">Company Name (Bangla)</label>
                                    <input type="text" name="company_name_bn"  class="form-control" placeholder="Enter company name bangla"
                                           value="{{ old("company_name_bn") ? old("company_name_bn") : '' }}" required data-validation-required-message="Enter company name in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('company_name_bn'))
                                        <div class="help-block">  {{ $errors->first('company_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('company_website') ? ' error' : '' }}">
                                    <label for="company_website" class="">Company Website</label>
                                    <input type="url" name="company_website"  class="form-control" placeholder="Enter company website"
                                           value="{{ old("company_website") ? old("company_website") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('company_website'))
                                        <div class="help-block">  {{ $errors->first('company_website') }}</div>
                                    @endif
                                </div>



                                <div class="form-group col-md-6 mb-0{{ $errors->has('partner_category_id') ? ' error' : '' }}">
                                    <label for="partner_category_id" class="required">Company Category</label>
                                    <fieldset class="form-group position-relative">
                                        <select class="form-control input-sm" name="partner_category_id" id="SmallSelect" required data-validation-required-message="Please select partner category">
                                            <option selected="" value="">--Select partner category--</option>
                                            @foreach($partnerCategories as $partnerCategory)
                                                <option value="{{ $partnerCategory->id }}" {{ (old('partner_category_id') == $partnerCategory->id) ? 'selected' : "" }}>
                                                    {{$partnerCategory->name_en}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('partner_category_id'))
                                            <div class="help-block">  {{ $errors->first('partner_category_id') }}</div>
                                        @endif
                                    </fieldset>
                                </div>

                                <div class="form-group col-md-6 mb-0 {{ $errors->has('company_logo') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Company logo</label>
                                    <div class="custom-file">
                                        <input type="file" name="company_logo" class="custom-file-input" id="image" accept="image/*"
                                               required data-validation-required-message="Company logo field is required.">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('company_logo'))
                                        <div class="help-block">  {{ $errors->first('company_logo') }}</div>
                                    @endif

                                    <div class="form-group col-md-6 mt-1">
                                        <img style="height:70px;width:70px;display:none" id="imgDisplay">
                                    </div>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('google_play_link') ? ' error' : '' }}">
                                    <label for="google_play_link">Google Play Store Link</label>
                                    <input type="url" name="google_play_link"  class="form-control" placeholder="Enter google play store link"
                                           value="{{ old("google_play_link") ? old("google_play_link") : '' }}" />
                                    <div class="help-block"></div>
                                    @if ($errors->has('google_play_link'))
                                        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('apple_app_store_link') ? ' error' : '' }}">
                                    <label for="apple_app_store_link">Apple App Store Link</label>
                                    <input type="url" name="apple_app_store_link" class="form-control" placeholder="Enter apple app store link"
                                           value="{{ old("apple_app_store_link") ? old("apple_app_store_link") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('apple_app_store_link'))
                                        <div class="help-block">  {{ $errors->first('apple_app_store_link') }}</div>
                                    @endif
                                </div>




                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush







