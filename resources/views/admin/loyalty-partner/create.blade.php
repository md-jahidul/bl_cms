@extends('layouts.admin')
@section('title', 'Loyalty Partner Image Upload')
@section('card_name', 'Loyalty Partner Image Upload')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('loyalty-partner-image') }}"> Loyalty Partner Image List</a></li>
    <li class="breadcrumb-item active"> Loyalty Partner Image Upload</li>
@endsection
@section('action')
    <a href="{{ url('loyalty-partner-image') }}" class="btn btn-warning  btn-glow px-2"><i
                class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="loyalty-partner-form" novalidate class="form row" role="form"
                              action="{{ url('loyalty-partner-image') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 {{ $errors->has('platform') ? ' error' : '' }}">
                                        <label for="platform" class="required"> Platform </label>

                                        <select class="product_code" name="platform" required
                                                data-validation-required-message="Please select Platform">
                                            <option value="">Select Platform</option>
                                            <option value="all">All</option>
                                            <option value="web">Web</option>
                                            <option value="app">App</option>
                                            <option value="eselfcare">E-Selfcare</option>
                                        </select>
                                        <span class="text-warning">If item exists in the list, select dropdown. otherwise, type then enter </span>
                                        <small class="text-danger"> @error('platform') {{ $message }} @enderror </small>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="dashboard_card_title" class="required">Title</label>
                                        <input required maxlength="100"
                                               data-validation-required-message="Title is required"
                                               data-validation-maxlength-message="Title can not be more then 200 Characters"
                                               value="{{ old('title') }}" type="text" class="form-control"
                                               placeholder="Enter title in English" name="title">
                                        <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="dashboard_card_sub_title">Description</label>
                                        <textarea rows="4" required name="description" class="form-control"
                                                  placeholder="Enter description in English">{{ old('description') }}</textarea>
                                        <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('partner_category_id') ? ' error' : '' }}">
                                        <label for="partner_category_id" class="required"> Partner Category </label>

                                        <select class="product_code" name="partner_category_id" required
                                                data-validation-required-message="Please select partner Category">
                                            <option value="">Select Category</option>
                                            @foreach($loyaltyPartnerCategories as $item)
                                                <option value="{{$item['id']}}">{{$item['name_en']}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-warning">If item exists in the list, select dropdown. otherwise, type then enter </span>

                                        <div class="help-block"></div>
                                        @if ($errors->has('partner_category_id'))
                                            <div class="help-block">{{ $errors->first('partner_category_id') }}</div>
                                        @endif
                                    </div>

                                    <div id="image-input" class="form-group col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="image_url">Upload Banner Image </label>
                                            <input type="file" id="image_url" name="banner_img" class="dropify_image"
                                                   data-min-width="799" data-min-height="449"
                                                   data-max-width="801" data-min-height="451"
                                                   data-default-file="{{ isset($loyaltyPartnerImage->banner_img) ? url('/' .$loyaltyPartnerImage->banner_img) : ''}}"
                                                   data-allowed-file-extensions="png jpg gif" required/>
                                            <div class="help-block text-warning">
                                                The Dimensions should be <strong>800x450</strong>
                                            </div>
                                            <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                            <small id="message"></small>
                                        </div>
                                    </div>

                                    <div id="image-input" class="form-group col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="image_url">Upload Logo</label>
                                            <input type="file" id="image_url" name="logo_img" class="dropify_image"
                                                   data-min-width="199" data-min-height="199"
                                                   data-min-width="201" data-min-height="201"
                                                   data-default-file="{{ isset($loyaltyPartnerImage->logo_img) ? url('/' .$loyaltyPartnerImage->logo_img) : ''}}"
                                                   data-allowed-file-extensions="png jpg gif" required/>
                                            <div class="help-block text-warning">
                                                The Dimensions should be <strong>200x200</strong>
                                            </div>
                                            <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                            <small id="message"></small>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="status_input">Status: </label>
                                        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                            <input required type="radio" name="status" value="1"
                                                   data-validation-required-message="Please select status"
                                                   id="input-radio-15" {{ old('status') ? 'checked' : '' }}>
                                            <label for="input-radio-15" class="mr-3">Active</label>
                                            <input required type="radio" name="status" value="0"
                                                   data-validation-required-message="Please select status"
                                                   id="input-radio-16" {{ (old('status') == 0) ? 'checked' : '' }}>
                                            <label for="input-radio-16" class="mr-3">Inactive</label>
                                            @if ($errors->has('status'))
                                                <div class="help-block"> {{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-actions col-md-12">
                                        <div class="pull-right">
                                            <button id="save" class="btn btn-primary"><i
                                                        class="la la-check-square-o"></i> Save
                                            </button>
                                        </div>
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
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    {{-- <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('#start_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                showClose: true,
            });
            $('#end_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                useCurrent: false, //Important! See issue #1075
                showClose: true,
            });
            $('.product_code').selectize({
                create: true,
            });
            $('.dropify_image').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });
        });
    </script>

@endpush