@extends('layouts.admin')
@section('title', 'Quick Launch Create')
@section('card_name', 'Quick Launch Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('quick-launch') }}"> Quick Launch List</a></li>
    <li class="breadcrumb-item active"> Quick Launch Create</li>
@endsection
@section('action')
    <a href="{{ url('quick-launch') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("partners/$partner->id") }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('company_name') ? ' error' : '' }}">
                                    <label for="company_name" class="required">Company Name</label>
                                    <input type="text" name="company_name"  class="form-control" placeholder="Enter english title"
                                           value="{{ $partner->company_name }}" required data-validation-required-message="Enter company name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('company_name'))
                                        <div class="help-block">  {{ $errors->first('company_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('ceo_name') ? ' error' : '' }}">
                                    <label for="ceo_name" class="required">CEO Name</label>
                                    <input type="text" name="ceo_name"  class="form-control" placeholder="Enter bangla title"
                                           value="{{ $partner->ceo_name }}" required data-validation-required-message="Enter CEO name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('ceo_name'))
                                        <div class="help-block">  {{ $errors->first('ceo_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('email') ? ' error' : '' }}">
                                    <label for="email" class="required">Email</label>
                                    <input type="text" name="email"  class="form-control" placeholder="Enter english title"
                                           value="{{ $partner->email }}" required data-validation-required-message="Enter email">
                                    <div class="help-block"></div>
                                    @if ($errors->has('email'))
                                        <div class="help-block">  {{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('mobile') ? ' error' : '' }}">
                                    <label for="mobile" class="required">Mobile Number</label>
                                    <input type="text" name="mobile"  class="form-control" placeholder="Enter alt text"
                                           value="{{ $partner->mobile }}" required data-validation-required-message="Enter mobile number">
                                    <div class="help-block"></div>
                                    @if ($errors->has('mobile'))
                                        <div class="help-block">  {{ $errors->first('mobile') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-5 mb-1">--}}
{{--                                    <label for="file">Company Icon</label>--}}
{{--                                    <div class="custom-file">--}}
{{--                                        <input type="file" name="company_logo" class="custom-file-input" id="inputGroupFile01"--}}
{{--                                            value="{{ $partner->company_name }}">--}}
{{--                                        <label class="custom-file-label" for="inputGroupFile01">Select icon</label>--}}
{{--                                    </div>--}}
{{--                                    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-1 mb-0 mt-2" >--}}
{{--                                    <img src="{{ asset('images/partners-logo/'.$partner->company_logo) }}" height="50" width="50" alt="logo">--}}
{{--                                </div>--}}

                                <div class="form-group col-md-6 {{ $errors->has('address') ? ' error' : '' }}">
                                    <label for="address" class="required">Address</label>
                                    <textarea name="address" rows="4" class="form-control" placeholder="Enter website"
                                              required data-validation-required-message="Enter website number">{{ $partner->address }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('address'))
                                        <div class="help-block">  {{ $errors->first('address') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('services') ? ' error' : '' }}">
                                    <label for="services" class="required">Service</label>
                                    <textarea type="text" name="services" rows="4" class="form-control" placeholder="Enter service"
                                              required data-validation-required-message="Enter service number">{{ $partner->services }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('services'))
                                        <div class="help-block">  {{ $errors->first('services') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-0 {{ $errors->has('website') ? ' error' : '' }}">
                                    <label for="website" class="required">Website</label>
                                    <input type="text" name="website"  class="form-control" placeholder="Enter website"
                                           value="{{ $partner->website }}" required data-validation-required-message="Enter website number">
                                    <div class="help-block"></div>
                                    @if ($errors->has('website'))
                                        <div class="help-block">  {{ $errors->first('website') }}</div>
                                    @endif
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('is_active') ? ' error' : '' }}">
                                        <label for="is_active" class="required mr-1">Status:</label>
                                        <input type="radio" name="is_active" value="1" id="input-radio-15" @if($partner->is_active == 1) checked @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>
                                        <input type="radio" name="is_active" value="0" id="input-radio-16" @if($partner->is_active == 0) checked @endif>
                                        <label for="input-radio-16">Inactive</label>
                                        @if ($errors->has('is_active'))
                                            <div class="help-block">  {{ $errors->first('is_active') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>

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







