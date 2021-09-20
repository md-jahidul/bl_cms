@extends('layouts.admin')
@section('title', 'Challenge Create')
@section('card_name', 'Challenge Create')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('event-base-bonus/challenges') }}"> Challenge List</a></li>
<li class="breadcrumb-item active"> Challenge Create</li>
@endsection
@section('action')
<a href="{{ url('event-base-bonus/challenges') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')

<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form id="feed-form" novalidate class="form row" action="{{url('event-base-bonus/challenges')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group col-12 mb-2 file-repeater">
                            <h5 class="menu-title"><strong> Challenge Create Form</strong></h5>
                            <hr>
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

                                <div class="form-group col-md-6 mb-2">
                                    <label for="status_input" class="required">Status: </label>
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <input required type="radio" name="status" value="1" id="input-radio-15" {{ (isset($campaign->status) && $campaign->status == 1) ? 'checked' : '' }}>
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
                                        <input type="file" id="image_url" name="icon_image" class="dropify_image" data-height="80" data-default-file="{{ isset($campaign->icon) ? url('/' .$campaign->icon) : ''}}" data-allowed-file-extensions="png jpg gif" required />
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                        <small id="massage"></small>
                                    </div>
                                </div>
                            </div>


                            <h5 class="menu-title"><strong> Task Setup</strong></h5>
                            <hr>
                            <div class="row mb-1">

                                <div class="form-group col-md-6 mb-2">
                                    <label for="dashboard_card_title" class="required">Day </label>
                                    <input required min="1" max="7" data-validation-required-message="Day is required" value="{{ old('day') }}" type="number" class="form-control" placeholder="Day" name="day">
                                    <small class="text-danger"> @error('day') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 mb-2" id="task_pick_type">
                                    <label for="task_pick_type_input" class="required">Task Pick Type: </label>
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <input required type="radio" name="task_pick_type" value="0" id="input-radio-15" {{ (isset($challenge->task_pick_type) && $campaign->task_pick_type == 0) ? 'checked' : ''  }}>
                                        <label for="input-radio-15" class="mr-3">Random</label>
                                        <input type="radio" name="task_pick_type" value="1" id="input-radio-16" {{ (isset($campaign->task_pick_type) && $campaign->task_pick_type == 1) ? 'checked' : '' }}>
                                        <label for="input-radio-16" class="mr-3">Day Specific</label>
                                        @if ($errors->has('task_pick_type'))
                                        <div class="help-block"> {{ $errors->first('task_pick_type') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <table class="table table-bordered display" id="day_specific_task_table"></table>
                                    <div class="form-group col-md-6 mb-2" id="select2_tasks">
                                        <label for="task_pick_type_input" class="required">Select Tasks</label>
                                        <div id="select2_input">
                                            <select class="select22 task-select form-control" multiple="multiple" required data-validation-required-message="Please select task">
                                                @foreach($tasks as $task)
                                                <option value="{{ $task['id'] }}">{{ $task['title'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2" id="random_select2_input">
                                    <label for="task_pick_type_input" class="required">Select Tasks: </label>
                                    <select class="select22 random-task-select form-control" multiple="multiple" required data-validation-required-message="Please select task">
                                        @foreach($tasks as $task)
                                        <option value="{{ $task['id'] }}">{{ $task['title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mb-2" id="task_per_day">
                                    <label for="dashboard_card_title">Task Per Day </label>
                                    <input value="{{ old('task_per_day') }}" type="number" class="form-control" placeholder="Task Per Day" name="task_per_day">
                                    <small class="text-danger"> @error('task_per_day') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush

@push('page-js')
<script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
{{-- <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
<script src="{{ asset('js/custom-js/image-show.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
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
                'default': 'Browse for an Image to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct Image file'
            },
            error: {
                'imageFormat': 'The image must be valid format'
            }
        });

        $('#task_pick_type').hide();
        $('#task_per_day').hide();
        $('#day_specific_task_table').hide();
        $('#select2_tasks').hide();
        $('#random_select2_input').hide();

        $('input[name=day]').keyup(function(e) {
            $('#task_pick_type').prop('checked', false);
            if ($(event.target).val() > 7) {
                alert('Max no of day exceed');
                $(event.target).val('0');
            } else {
                $('#task_pick_type').show();
                if ($.fn.DataTable.isDataTable('#day_specific_task_table')) {
                    $('#day_specific_task_table').DataTable().destroy();
                    initTaskTable($(event.target).val());
                }
            }
        });

        $('input[name=task_pick_type]').change(function($e) {
            if ($('input[name="task_pick_type"]:checked').val() == 0) {
                $('#task_per_day').show();
                $('#random_select2_input').show();
                $('#random_select2_input .random-task-select').select2();
                $('#day_specific_task_table').hide();
            } else {
                $('#task_per_day').hide();
                days = $('input[name="day"]').val();
                $('#random_select2_input').hide();
                initTaskTable(days);
            }
        });
        $(".select22").on("select2:select", function(evt) {
            var element = evt.params.data.element;
            var $element = $(element);

            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });
    });

    function initTaskTable(data) {
        col = [];
        if (data) {
            for (let i = 0; i < data; i++) {
                col.push({
                    'day': 'Day-' + (i + 1),
                    'task': 'b'
                });
            }
        }
        //reset select2 selections
        $(".task-select").val('').trigger('change');
        $('#day_specific_task_table').show();
        if (!$.fn.DataTable.isDataTable('#day_specific_task_table')) {
            $('#day_specific_task_table').DataTable({
                "bPaginate": false,
                searching: false,
                info: false,
                data: col,
                columns: [{
                        "title": "Day",
                        "data": 'day'
                    },
                    {
                        "title": "Task",
                        "data": "task"
                    }
                ],
                "columnDefs": [{
                    "targets": 1,
                    "data": null,
                    render: function(data, type, row) {
                        var domElement = '<div class="taskInput"></div>';
                        return domElement;
                    },
                }],
            });
            var select2_taskList = $('#select2_input').html();
            $(".taskInput").each(function(e, v) {
                $(this).html(select2_taskList);
                $(".task-select").eq(e).select2();
                $(".task-select").eq(e).attr('name', 'tasks[' + e + '][]');
            });
        }
    }
</script>

@endpush