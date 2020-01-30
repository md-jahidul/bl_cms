@extends('layouts.admin')
@section('title', 'Management Info Add')
@section('card_name', 'Management Info Add')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('management') }}"> Management List</a></li>
    <li class="breadcrumb-item active"> Management Info</li>
@endsection
@section('action')
    <a href="{{ url('management') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('management.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name') ? ' error' : '' }}">
                                    <label for="name" class="required">Name (English)</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("name") ? old("name") : '' }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">  {{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn" class="required">Name (Bangla)</label>
                                    <input type="text" name="name_bn"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ old("name_bn") ? old("name_bn") : '' }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">  {{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('designation') ? ' error' : '' }}">
                                    <label for="designation" class="required">Designation (English)</label>
                                    <input type="text" name="designation"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("designation") ? old("designation") : '' }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('designation'))
                                        <div class="help-block">  {{ $errors->first('designation') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('designation_bn') ? ' error' : '' }}">
                                    <label for="designation_bn" class="required">Designation (Bangla)</label>
                                    <input type="text" name="designation_bn"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ old("designation_bn") ? old("designation_bn") : '' }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('designation_bn'))
                                        <div class="help-block">  {{ $errors->first('designation_bn') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('personal_details') ? ' error' : '' }}">
                                    <label for="personal_details" class="required">Personal Details (English)</label>
                                    <input type="text" name="personal_details"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("personal_details") ? old("personal_details") : '' }}" required data-validation-required-message="Enter english title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('personal_details'))
                                        <div class="help-block">  {{ $errors->first('personal_details') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('personal_details_bn') ? ' error' : '' }}">
                                    <label for="personal_details_bn" class="required">Personal Details (Bangla)</label>
                                    <input type="text" name="personal_details_bn"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ old("personal_details_bn") ? old("personal_details_bn") : '' }}" required data-validation-required-message="Enter bangla title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('personal_details_bn'))
                                        <div class="help-block">  {{ $errors->first('personal_details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('twitter_link') ? ' error' : '' }}">
                                    <label for="twitter_link" class="required">Twitter link</label>
                                    <input type="text" name="twitter_link"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("twitter_link") ? old("twitter_link") : '' }}" required data-validation-required-message="Enter twitter_link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('twitter_link'))
                                        <div class="help-block">  {{ $errors->first('twitter_link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('linkedin_link') ? ' error' : '' }}">
                                    <label for="linkedin_link" class="required">Linkedin link</label>
                                    <input type="text" name="linkedin_link"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("linkedin_link") ? old("linkedin_link") : '' }}" required data-validation-required-message="Enter linkedin_link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('linkedin_link'))
                                        <div class="help-block">  {{ $errors->first('linkedin_link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('facebook_link') ? ' error' : '' }}">
                                    <label for="facebook_link" class="required">Facebook link</label>
                                    <input type="text" name="facebook_link"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("facebook_link") ? old("facebook_link") : '' }}" required data-validation-required-message="Enter facebook_link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('facebook_link'))
                                        <div class="help-block">  {{ $errors->first('facebook_link') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('others_link') ? ' error' : '' }}">
                                    <label for="others_link" class="required">Others link</label>
                                    <input type="text" name="others_link"  class="form-control" placeholder="Enter english title"
                                           value="{{ old("others_link") ? old("others_link") : '' }}" required data-validation-required-message="Enter others_link">
                                    <div class="help-block"></div>
                                    @if ($errors->has('others_link'))
                                        <div class="help-block">  {{ $errors->first('others_link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('profile_image') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Profile Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" class="custom-file-input" id="image" required data-validation-required-message="Enter alt text">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_image') ? ' error' : '' }}">
                                    <label for="alt_text" class="required">Banner Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_image" class="custom-file-input" id="image" required data-validation-required-message="Enter alt text">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <img style="height:70px;width:70px;display:none" id="imgDisplay">
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







