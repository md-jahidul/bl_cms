@extends('layouts.admin')
@section('title', 'Campaign Edit')
@section('card_name', 'Campaign Edit')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('event-base-bonus/campaigns') }}"> Campaign List</a></li>
<li class="breadcrumb-item active"> Campaign Edit</li>
@endsection
@section('action')
<a href="{{ url('event-base-bonus/campaigns') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')

<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form id="feed-form" novalidate class="form row" action="{{url('event-base-bonus/campaigns/'.$campaign['id'])}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-12 mb-2 file-repeater">
                            <div class="row mb-1">
                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_title" class="required">Title</label>
                                    <input required maxlength="50" data-validation-required-message="Title is required" data-validation-maxlength-message="Title can not be more then 200 Characters" value="{{ $campaign['title'] }}" type="text" class="form-control" placeholder="Enter title" name="title">
                                    <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_title" class="required">Tasks</label>
                                    <select class="select22 form-control" name="task_ids[]" multiple="multiple" required data-validation-required-message="Please select task">
                                        @foreach($tasks as $task)
                                        <option value="{{ $task['id'] }}" {{in_array($task['id'], $taskIds) ? 'selected':''}}>{{ $task['title'] }}</option>
                                        @endforeach

                                    </select>
                                    <small class="text-danger"> @error('task_ids') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_sub_title">Description En</label>
                                    <textarea rows="4" name="description" class="form-control">{{ $campaign['description'] }}</textarea>
                                    <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_sub_title_bn">Description Bn</label>
                                    <textarea rows="4" name="description_bn" class="form-control">{{ $campaign['description_bn'] }}</textarea>
                                    <small class="text-danger"> @error('description_bn') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>



                                <div class="form-group col-md-6 mb-2">
                                    <label class="required">Start Date</label>
                                    <input type='text' class="form-control" name="start_date" id="start_date" value="{{$campaign['start_date']}}" />
                                    <small class="text-danger"> @error('end_date') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label class="required">End Date</label>
                                    <input type='text' class="form-control" name="end_date" id="end_date" value="{{$campaign['end_date']}}" />
                                    <small class="text-danger"> @error('start_date') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('reward_prepaid') ? ' error' : '' }}">
                                    <label for="reward_prepaid" class="required">Reward Prepaid</label>

                                    <select class="product_code" name="reward_product_code_prepaid" data-url="{{ url('product-core/match') }}" required data-validation-required-message="Please select Reward prepaid">
                                        <option value="">Select product code</option>
                                        @foreach($products as $productCodes)
                                            <option value="{{ $productCodes }}" {{$productCodes == $campaign['reward_product_code_prepaid'] ? 'selected':''}}>{{ $productCodes }}</option>
                                        @endforeach
                                        @if(!in_array($campaign['reward_product_code_prepaid'], $products))
                                            <option value="{{ $campaign['reward_product_code_prepaid'] }}"
                                                    selected>{{ $campaign['reward_product_code_prepaid'] }}</option>
                                        @endif

                                    </select>
                                    <span class="text-warning">If item exists in the list, select dropdown otherwise, type then enter</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('reward_prepaid'))
                                    <div class="help-block">{{ $errors->first('reward_prepaid') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('reward_postpaid') ? ' error' : '' }}">
                                    <label for="reward_postpaid" class="required">Reward Postpaid</label>

                                    <select class="product_code" name="reward_product_code_postpaid" data-url="{{ url('product-core/match') }}" required data-validation-required-message="Please select Reward Postpaid">
                                        <option value="">Select product code</option>
                                        @foreach($products as $productCodes)
                                            <option value="{{ $productCodes }}" {{$productCodes == $campaign['reward_product_code_postpaid'] ? 'selected':''}}>{{ $productCodes }}</option>
                                        @endforeach
                                        @if(!in_array($campaign['reward_product_code_postpaid'], $products))
                                            <option value="{{ $campaign['reward_product_code_postpaid'] }}"
                                                    selected>{{ $campaign['reward_product_code_postpaid'] }}</option>
                                        @endif

                                    </select>
                                    <span class="text-warning">If item exists in the list, select dropdown otherwise, type then enter</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('reward_postpaid'))
                                    <div class="help-block">{{ $errors->first('reward_postpaid') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="status_input">Status: </label>
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <input type="radio" name="status" value="1" id="input-radio-15" {{ $campaign['status'] == 1 ? 'checked' : '' }}>
                                        <label for="input-radio-15" class="mr-3">Active</label>
                                        <input type="radio" name="status" value="0" id="input-radio-16" {{ $campaign['status'] == 0 ? 'checked' : '' }}>
                                        <label for="input-radio-16" class="mr-3">Inactive</label>
                                        @if ($errors->has('status'))
                                        <div class="help-block"> {{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div id="image-input" class="form-group col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="image_url">Upload Icon</label>
                                        <input type="file" id="image_url" name="icon_image" class="dropify_image" data-height="80" data-default-file="{{ asset($campaign['icon_image']) }}" data-allowed-file-extensions="png jpg gif" />
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                        <small id="massage"></small>
                                        <input type="hidden" name="icon_image_old" value="{{$campaign['icon_image']}}">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
<script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('js/custom-js/image-show.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<script>
    $(document).ready(function() {
        $(".select22").select2();
        $(".select22").on("select2:select", function(evt) {
            var element = evt.params.data.element;
            var $element = $(element);
            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });
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
                'default': 'Browse for an Image to upload',
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