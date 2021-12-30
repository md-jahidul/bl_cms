@extends('layouts.admin')
@section('title', 'Task Create')
@section('card_name', 'Task Create')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('event-base-bonus/tasks') }}"> Task List</a></li>
<li class="breadcrumb-item active"> Task Create</li>
@endsection
@section('action')
<a href="{{ url('event-base-bonus/tasks') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')

<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form id="feed-form" novalidate class="form row" action="{{url('event-base-bonus/tasks')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group col-12 mb-2 file-repeater">
                            <div class="row mb-1">
                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_title" class="required">Title En</label>
                                    <input required maxlength="100" data-validation-required-message="Title is required" data-validation-maxlength-message="Title can not be more then 200 Characters" value="{{ old('title') }}" type="text" class="form-control" placeholder="Enter title in English" name="title">
                                    <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_title" class="required">Title Bn</label>
                                    <input required maxlength="100" data-validation-required-message="Title is required" data-validation-maxlength-message="Title can not be more then 200 Characters" value="{{ old('title_bn') }}" type="text" class="form-control" placeholder="Enter title in Bangla" name="title_bn">
                                    <small class="text-danger"> @error('title_bn') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_sub_title">Description En</label>
                                    <textarea rows="4" required name="description" class="form-control" placeholder="Enter description in English">{{ old('description') }}</textarea>
                                    <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_sub_title_bn">Description Bn</label>
                                    <textarea rows="4" required name="description_bn" class="form-control" placeholder="Enter description in Bangla">{{ old('description_bn') }}</textarea>
                                    <small class="text-danger"> @error('description_bn') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_title" class="required">Btn text En </label>
                                    <input required maxlength="20" data-validation-required-message="Btn Text is required" data-validation-maxlength-message="Btn Text can not be more then 200 Characters" value="{{ old('btn_text') }}" type="text" class="form-control" placeholder="Enter Btn Text in English" name="btn_text">
                                    <small class="text-danger"> @error('btn_text') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_title" class="required">Btn text Bn </label>
                                    <input required maxlength="20" data-validation-required-message="Btn Text is required" data-validation-maxlength-message="Btn Text can not be more then 200 Characters" value="{{ old('btn_text_bn') }}" type="text" class="form-control" placeholder="Enter Btn Text in Bangla" name="btn_text_bn">
                                    <small class="text-danger"> @error('btn_text_bn') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_title" class="required">Recurrence Number </label>
                                    <input required maxlength="100" data-validation-required-message="Recurrence Number is required" data-validation-maxlength-message="Recurrence Number can not be more then 100" value="{{ old('recurrence_number') }}" type="number" class="form-control" placeholder="Recurrence Number" name="recurrence_number">
                                    <small class="text-danger"> @error('recurrence_number') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_title" class="required">Reward text </label>
                                    <input required maxlength="30" data-validation-required-message="Reward text is required" data-validation-maxlength-message="Reward text can not be more then 200 Characters" value="{{ old('reward_text') }}" type="text" class="form-control" placeholder="Enter Reward text" name="reward_text">
                                    <small class="text-danger"> @error('reward_text') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('reward_prepaid') ? ' error' : '' }}">
                                    <label for="reward_prepaid" class="required"> Reward Prepaid </label>

                                    <select class="product_code" name="reward_product_code_prepaid" data-url="{{ url('product-core/match') }}" required data-validation-required-message="Please select Reward prepaid">
                                        <option value="">Select product code </option>
                                        @foreach($products as $productCodes)
                                        <option value="{{ $productCodes['product_code'] }}">{{ $productCodes['commercial_name_en'] . " / " . $productCodes['product_code'] }}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-warning">If item exists in the list, select dropdown. otherwise, type then enter </span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('reward_prepaid'))
                                    <div class="help-block">{{ $errors->first('reward_prepaid') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('reward_postpaid') ? ' error' : '' }}">
                                    <label for="reward_postpaid" class="required">Reward Postpaid </label>

                                    <select class="product_code" name="reward_product_code_postpaid" data-url="{{ url('product-core/match') }}" required data-validation-required-message="Please select Reward Postpaid">
                                        <option value="">Select product code </option>
                                        @foreach($products as $productCodes)
                                        <option value="{{ $productCodes['product_code'] }}">{{ $productCodes['commercial_name_en'] . " / " . $productCodes['product_code'] }}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-warning">If item exists in the list, select dropdown. otherwise, type then enter </span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('reward_postpaid'))
                                    <div class="help-block">{{ $errors->first('reward_postpaid') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('event') ? ' error' : '' }}">
                                    <label for="product_code" class="required">Event</label>

                                    <select class="product_code" name="event" data-url="{{ url('product-core/match') }}" required data-validation-required-message="Please select event">
                                        <option value="">Select product code </option>
                                        @foreach($events as $key => $value)
                                        <option value="{{ $key }}">{{ $value }} </option>
                                        @endforeach

                                    </select>
                                    <span class="text-warning">If item exists in the list, select dropdown. otherwise, type then enter </span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('event'))
                                    <div class="help-block">{{ $errors->first('event') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="status_input">Tracking Type: </label>
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <input type="radio" name="tracking_type" value="1" id="input-radio-155" {{ (isset($campaign->tracking_type) && $campaign->tracking_type == 1) ? 'checked' : '' }}>
                                        <label for="input-radio-155" class="mr-3">Automatic</label>
                                        <input type="radio" name="tracking_type" value="0" id="input-radio-166" {{ (isset($campaign->status) && $campaign->status == 0) ? 'checked' : '' }}>
                                        <label for="input-radio-166" class="mr-3">Manual</label>
                                        @if ($errors->has('tracking_type'))
                                        <div class="help-block"> {{ $errors->first('tracking_type') }}</div>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group col-md-6 mb-2">
                                    <label for="status_input">Status: </label>
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <input type="radio" name="status" value="1" id="input-radio-15" {{ (isset($campaign->status) && $campaign->status == 1) ? 'checked' : '' }}>
                                        <label for="input-radio-15" class="mr-3">Active</label>
                                        <input type="radio" name="status" value="0" id="input-radio-16" {{ (isset($campaign->status) && $campaign->status == 0) ? 'checked' : '' }}>
                                        <label for="input-radio-16" class="mr-3">Inactive</label>
                                        @if ($errors->has('status'))
                                        <div class="help-block"> {{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div id="image-input" class="form-group col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="image_url">Upload Icon </label>
                                        <input type="file" id="image_url" name="icon_image" class="dropify_image" data-height="80" data-default-file="{{ isset($campaign->icon) ? url('/' .$campaign->icon) : ''}}" data-allowed-file-extensions="png jpg gif json" required />
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                        <small id="massage"></small>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button id="save" class="btn btn-primary"><i class="la la-check-square-o"></i> Save
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
<link rel="stylesheet" href="{{ asset('app-assets/vendors/css/dropify/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/vendors/css/bootstrap-multiselect/bootstrap-multiselect.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush

@push('page-js')
<script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
{{-- <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
<script src="{{ asset('js/custom-js/image-show.js')}}"></script>
<script type="text/javascript" src="{{ asset('app-assets/vendors/js/bootstrap-multiselect/bootstrap-multiselect.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/vendors/js/dropify/dropfiy.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function() {

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
                'default': 'Browse for an Image/Json File to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct Image/Json file'
            },
            error: {
                'imageFormat': 'The image must be valid format'
            }
        });
    });
</script>

@endpush