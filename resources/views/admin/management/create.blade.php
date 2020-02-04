@extends('layouts.admin')
@section('title', 'Management Info')
@section('card_name', 'Management Info')
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

                        {{-- <form role="form" action="{{ route('management.store') }}" method="POST" novalidate enctype="multipart/form-data">--}}

                            @if(isset($manage))
                              <form novalidate action="{{ route('management.update',$manage->id) }}" method="post" enctype="multipart/form-data">
                            @else
                               <form novalidate action="{{ route('management.store') }}" method="post" enctype="multipart/form-data">
                                @endif

                                @csrf
                                @if(isset($manage))
                                    @method('put')
                                @else
                                    @method('post')
                                @endif

                               @if(isset($manage))
                                   @php $personal_details = $manage->personal_details; @endphp
                               @else
                                   @php $personal_details = ''; @endphp
                               @endif

                               @if(isset($manage))
                                   @php $personal_details_bn = $manage->personal_details_bn; @endphp
                               @else
                                   @php $personal_details_bn = ''; @endphp
                               @endif

                               <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name') ? ' error' : '' }}">
                                    <label for="name" class="required">Name (English)</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter Name in English"
                                           value="@if(isset($manage)){{$manage->name}} @elseif(old("name")) {{old("name")}} @endif"
                                           required data-validation-required-message="Enter Name in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">  {{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn" class="required">Name (Bangla)</label>
                                    <input type="text" name="name_bn"  class="form-control" placeholder="Enter Name in Bangla"
                                           value="@if(isset($manage)){{$manage->name_bn}} @elseif(old("name_bn")) {{old("name_bn")}} @endif"
                                           required data-validation-required-message="Enter Name in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">  {{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('designation') ? ' error' : '' }}">
                                    <label for="designation" class="required">Designation (English)</label>
                                    <input type="text" name="designation"  class="form-control" placeholder="Enter Designation in English"
                                           value="@if(isset($manage)){{$manage->designation_bn}} @elseif(old("designation_bn")) {{old("designation_bn")}} @endif"
                                           required data-validation-required-message="Enter Designation in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('designation'))
                                        <div class="help-block">  {{ $errors->first('designation') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('designation_bn') ? ' error' : '' }}">
                                    <label for="designation_bn" class="required">Designation (Bangla)</label>
                                    <input type="text" name="designation_bn"  class="form-control" placeholder="Enter Designation in Bangla"
                                           value="@if(isset($manage)){{$manage->designation_bn}} @elseif(old("designation_bn")) {{old("designation_bn")}} @endif"
                                           required data-validation-required-message="Enter Designation in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('designation_bn'))
                                        <div class="help-block">  {{ $errors->first('designation_bn') }}</div>
                                    @endif
                                </div>

                                   <div class="form-group col-md-6 {{ $errors->has('personal_details') ? ' error' : '' }}">
                                    <label for="personal_details" class="required">Personal Details (English)</label>
                                    <textarea
                                        required
                                        data-validation-required-message="Personal Details is required"
                                        class="form-control" name="personal_details" placeholder="Enter Personal Details in English" id="personal_details"
                                        rows="4">{{ old("personal_details") ? old("personal_details") : $personal_details  }}</textarea>

                                    <div class="help-block"></div>
                                    @if ($errors->has('personal_details'))
                                        <div class="help-block">  {{ $errors->first('personal_details') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('personal_details_bn') ? ' error' : '' }}">
                                    <label for="personal_details_bn" class="required">Personal Details (Bangla)</label>
                                    <textarea
                                        required
                                        data-validation-required-message="Personal Details is required"
                                        class="form-control" name="personal_details_bn" placeholder="Enter Personal Details in Bangla" id="personal_details_bn"
                                        rows="4">{{ old("personal_details_bn") ? old("personal_details_bn") : $personal_details_bn }}</textarea>

                                    <div class="help-block"></div>
                                    @if ($errors->has('personal_details_bn'))
                                        <div class="help-block">  {{ $errors->first('personal_details_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('twitter_link') ? ' error' : '' }}">
                                    <label for="twitter_link" >Twitter link</label>
                                    <input type="text" name="twitter_link"  class="form-control" placeholder="Enter link"
                                           value="@if(isset($manage)){{$manage->twitter_link}} @elseif(old("twitter_link")) {{old("twitter_link")}} @endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('twitter_link'))
                                        <div class="help-block">  {{ $errors->first('twitter_link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('linkedin_link') ? ' error' : '' }}">
                                    <label for="linkedin_link" >Linkedin link</label>
                                    <input type="text" name="linkedin_link"  class="form-control" placeholder="Enter link"
                                           value="@if(isset($manage)){{$manage->linkedin_link}} @elseif(old("linkedin_link")) {{old("linkedin_link")}} @endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('linkedin_link'))
                                        <div class="help-block">  {{ $errors->first('linkedin_link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('facebook_link') ? ' error' : '' }}">
                                    <label for="facebook_link" >Facebook link</label>
                                    <input type="text" name="facebook_link"  class="form-control" placeholder="Enter link"
                                           value="@if(isset($manage)){{$manage->facebook_link}} @elseif(old("facebook_link")) {{old("facebook_link")}} @endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('facebook_link'))
                                        <div class="help-block">  {{ $errors->first('facebook_link') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('others_link') ? ' error' : '' }}">
                                    <label for="others_link" >Others link</label>
                                    <input type="text" name="others_link"  class="form-control" placeholder="Enter link"
                                           value="@if(isset($manage)){{$manage->others_link}} @elseif(old("others_link")) {{old("others_link")}} @endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('others_link'))
                                        <div class="help-block">  {{ $errors->first('others_link') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('profile_image') ? ' error' : '' }}">
                                    <label for="alt_text" >Profile Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" class="custom-file-input" id="profile_image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    {{--@if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif--}}
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_image') ? ' error' : '' }}">
                                    <label for="alt_text" >Banner Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="banner_image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    {{--@if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif--}}
                                </div>

                                <div class="form-group col-md-6">
                                    @if(isset($manage))
                                    <img style="height:80px;width:100px;"
                                         src="{{ config('filesystems.file_base_url') . $manage->profile_image }}" id="profile_image_Display">
                                    @else
                                    <img style="height:80px;width:100px; display:none" id="profile_image_Display">
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    @if(isset($manage))
                                    <img style="height:80px;width:100px;"
                                         src="{{ config('filesystems.file_base_url') . $manage->banner_image }}" id="imgDisplay">
                                    @else
                                    <img style="height:80px;width:100px;display:none" id="imgDisplay">
                                    @endif
                                </div>


                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" id="submitForm" style="width:100%" class="btn @if(isset($manage)) btn-success @else btn-info @endif ">
                                            @if(isset($manage)) <i class="la la-check-square-o"></i> Update @else <i class="la la-check-square-o"></i> SAVE @endif
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







