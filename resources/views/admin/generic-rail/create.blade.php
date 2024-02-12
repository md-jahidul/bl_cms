@extends('layouts.admin')
@section('title', 'Create Generic Rail')
@section('card_name', 'Create Generic Rail')
@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ url('generic-rail') }}">Generic Rail List</a>
    </li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('generic-rail.store') }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title_en" class="required">Title English</label>
                                    <input class="form-control"
                                           name="title_en"
                                           id="title_en"
                                           placeholder="Enter English Title"
                                           required>
                                    @if($errors->has('title_en'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('title_en') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title_bn" class="required">Title Bangla</label>
                                    <input class="form-control"
                                           name="title_bn"
                                           id="title_bn"
                                           placeholder="Enter Bangla Title"
                                           required>
                                    @if($errors->has('title_bn'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('title_bn') }}</small>
                                        </p>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="component_for" class="required">Component For: </label>
                                    <select name="component_for" class="form-control custom-select"
                                            id="component_for" required data-validation-required-message="Please select component type">
                                        <option value="" >--Select Tab Section--</option>
                                        @foreach (Config::get('generic-rail.component_for') as $key => $type)
                                            <option value="{{$key}}" >{{$type}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('component_type'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('component_type') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-3 mb-2">
                                    <label class="required" for="is_title_show">Is Title Show: </label>
                                    <div class="form-group {{ $errors->has('is_title_show') ? ' error' : '' }}">
                                        <input required type="radio" name="is_title_show" value="1" id=""/>
                                        <label for="is_title_show" class="mr-3">True</label>
                                        <input required type="radio" name="is_title_show" value="0" id="" checked/>
                                        <label for="is_title_show" class="mr-3">False</label>

                                        @if ($errors->has('is_title_show'))
                                            <div class="help-block">  {{ $errors->first('is_title_show') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                    <label for="title" class="">Android Version Code</label>
                                    <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code" value="905001-999999999">
                                    <div class="help-block"></div>
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('android_version_code'))
                                        <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                    <label for="title" class="">iOS Version Code</label>
                                    <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code" value="904004-999999999">
                                    <div class="help-block"></div>
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('ios_version_code'))
                                        <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('icon') ? ' error' : '' }}">
                                    <label for="title" class="">Icon</label>
                                    <input type="text" name="icon"  class="form-control" placeholder="Enter Icon URL.">
                                    @if ($errors->has('icon'))
                                        <div class="help-block">  {{ $errors->first('icon') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('cta_name_en') ? ' error' : '' }}">
                                    <label for="title" class="">Cta Name EN</label>
                                    <input type="text" name="cta_name_en"  class="form-control" placeholder="Enter Cta Name En.">
                                    @if ($errors->has('cta_name_en'))
                                        <div class="help-block">  {{ $errors->first('cta_name_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('cta_name_bn') ? ' error' : '' }}">
                                    <label for="title" class="">Cta Name Bn</label>
                                    <input type="text" name="cta_name_bn"  class="form-control" placeholder="Enter Cta Name Bn.">
                                    @if ($errors->has('cta_name_bn'))
                                        <div class="help-block">  {{ $errors->first('cta_name_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('deeplink') ? ' error' : '' }}">
                                    <label for="title" class="">Deeplink</label>
                                    <input type="text" name="deeplink"  class="form-control" placeholder="Enter Deeplink.">
                                    @if ($errors->has('deeplink'))
                                        <div class="help-block">  {{ $errors->first('deeplink') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="ft-save"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/weekday-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('app-assets/js/recurring-schedule/recurring.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Icon to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Icon file'
                },
                error: {
                    'imageFormat': 'The image ratio must be 1:1.'
                }
            });
        });
    </script>
@endpush
