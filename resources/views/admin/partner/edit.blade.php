@extends('layouts.admin')
@section('title', 'Partner Edit')
@section('card_name', 'Partner Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('partners') }}"> Partner List</a></li>
    <li class="breadcrumb-item active"> Partner Edit</li>
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
                        <form role="form" action="{{ url("partners/$partner->id") }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('company_name_en') ? ' error' : '' }}">
                                    <label for="company_name_en" class="required">Company Name (English)</label>
                                    <input type="text" name="company_name_en"  class="form-control" placeholder="Enter company name in English"
                                           value="{{ $partner->company_name_en }}" required data-validation-required-message="Enter company name in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('company_name_en'))
                                        <div class="help-block">  {{ $errors->first('company_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('company_name_bn') ? ' error' : '' }}">
                                    <label for="company_name_bn" class="required">Company Name (Bangla)</label>
                                    <input type="text" name="company_name_bn"  class="form-control" placeholder="Enter company name bangla"
                                           value="{{ $partner->company_name_bn }}" required data-validation-required-message="Enter company name in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('company_name_bn'))
                                        <div class="help-block">  {{ $errors->first('company_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('company_website') ? ' error' : '' }}">
                                    <label for="company_website" class="required">Company Website</label>
                                    <input type="url" name="company_website"  class="form-control" placeholder="Enter company website"
                                           value="{{ old('company_website') ??  $partner->company_website }}" required data-validation-required-message="Enter company website">
                                    <div class="help-block"></div>
                                    @if ($errors->has('company_website'))
                                        <div class="help-block">  {{ $errors->first('company_website') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('contact_person_name') ? ' error' : '' }}">
                                    <label for="contact_person_name" class="required">Contact Person Name</label>
                                    <input type="text" name="contact_person_name"  class="form-control" placeholder="Enter contact person name"
                                           value="{{ $partner->contact_person_name }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('contact_person_name'))
                                        <div class="help-block">  {{ $errors->first('contact_person_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('contact_person_email') ? ' error' : '' }}">
                                    <label for="contact_person_email" class="required">Contact Person Email</label>
                                    <input type="text" name="contact_person_email"  class="form-control" placeholder="Enter contact person name"
                                           value="{{ old('contact_person_email') ?? $partner->contact_person_email }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('contact_person_email'))
                                        <div class="help-block">  {{ $errors->first('contact_person_email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('contact_person_mobile') ? ' error' : '' }}">
                                    <label for="contact_person_mobile" class="required">Contact Person Mobile Number</label>
                                    <input type="text" name="contact_person_mobile"  class="form-control" placeholder="Enter contact person name"
                                           value="{{ $partner->contact_person_mobile }}" required data-validation-required-message="Enter contact person mobile number">
                                    <div class="help-block"></div>
                                    @if ($errors->has('contact_person_mobile'))
                                        <div class="help-block">  {{ $errors->first('contact_person_mobile') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('partner_category_id') ? ' error' : '' }}">
                                    <label for="partner_category_id" class="required">Company Category</label>
                                    <fieldset class="form-group position-relative">
                                        <select class="form-control input-sm" name="partner_category_id" id="SmallSelect" required data-validation-required-message="Please partner category">
                                            <option selected="" value="">--Select partner category--</option>
                                            @foreach($partnerCategories as $partnerCategory)
                                                <option value="{{ $partnerCategory->id }}" {{ ($partnerCategory->id == $partner->partner_category_id) ? 'selected' : '' }}>
                                                    {{$partnerCategory->name_en}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('partner_category_id'))
                                            <div class="help-block">  {{ $errors->first('partner_category_id') }}</div>
                                        @endif
                                    </fieldset>
                                </div>


                                <div class="form-group col-md-5 {{ $errors->has('company_logo') ? ' error' : '' }}">
                                    <label for="file">Select Company Logo</label>
                                    <div class="custom-file">
                                        <input type="file" name="company_logo" class="custom-file-input" id="image" accept="image/*" />
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    {{--<label for="file" class=""></label><br>--}}
                                    {{--<label for="file">Select Company Logo</label>--}}
                                    {{--<label id="projectinput7" class="file center-block ml-2">--}}
                                        {{--<input type="file" id="file" name="company_logo">--}}
                                    {{--</label><br>--}}
                                    {{--<span class="text-primary">Please given file type (.png, .jpg)</span>--}}
                                    @if ($errors->has('company_logo'))
                                        <div class="help-block">  {{ $errors->first('company_logo') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-1 pt-1">
                                    <img class="" src="{{ $partner->company_logo }}" height="60" width="105" id="imgDisplay">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('google_play_link') ? ' error' : '' }}">
                                    <label for="google_play_link" class="required">Google Play Store Link</label>
                                    <input type="url" name="google_play_link"  class="form-control" placeholder="Enter google play store link"
                                           value="{{ $partner->google_play_link }}" required data-validation-required-message="Enter google play store link"/>
                                    <div class="help-block"></div>
                                    @if ($errors->has('google_play_link'))
                                        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('apple_app_store_link') ? ' error' : '' }}">
                                    <label for="apple_app_store_link" class="required">Apple App Store Link</label>
                                    <input type="url" name="apple_app_store_link" class="form-control" placeholder="Enter apple app store link"
                                           value="{{ $partner->apple_app_store_link }}" required data-validation-required-message="Enter apple app store link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('apple_app_store_link'))
                                        <div class="help-block">  {{ $errors->first('apple_app_store_link') }}</div>
                                    @endif
                                </div>



                                <div class="form-group col-md-12 {{ $errors->has('company_address') ? ' error' : '' }}">
                                    <label for="company_address" class="required">Company Address</label>
                                    <textarea name="company_address" rows="4" class="form-control" placeholder="Enter company address"
                                              required data-validation-required-message="Enter company address">{{ $partner->company_address }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('company_address'))
                                        <div class="help-block">  {{ $errors->first('company_address') }}</div>
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
                            @method('PUT')
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







