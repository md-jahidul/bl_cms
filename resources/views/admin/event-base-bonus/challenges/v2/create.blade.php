@extends('layouts.admin')
@section('title', 'Challenge Create')
@section('card_name', 'Challenge Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('event-base-bonus/v2/challenges') }}"> Challenge List</a></li>
    <li class="breadcrumb-item active"> Challenge Create</li>
@endsection
@section('action')
    <a href="{{ url('event-base-bonus/v2/challenges') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')

    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="feed-form" novalidate class="form row" action="{{url('event-base-bonus/v2/challenges')}}" enctype="multipart/form-data" method="POST">
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
                                        <label for="dashboard_card_title" class="required">Start Date</label>
                                        <input type='text' class="form-control" name="start_date" id="start_date" placeholder="Please select start date" />
                                        <small class="text-danger"> @error('start_date') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="dashboard_card_title" class="required">End Date</label>
                                        <input type='text' class="form-control" name="end_date" id="end_date" placeholder="Please select end date" />
                                        <small class="text-danger"> @error('end_date') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="status_input" class="required">Status: </label>
                                        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                            <input required type="radio" name="status" value="1" id="input-radio-15">
                                            <label for="input-radio-15" class="mr-3">Active</label>
                                            <input type="radio" name="status" value="0" id="input-radio-16">
                                            <label for="input-radio-16" class="mr-3">Inactive</label>
                                            @if ($errors->has('status'))
                                                <div class="help-block"> {{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2" id="cta_action">
                                        <label for="redirect_url">Select Base Msisdn Group (If Any)</label>
                                        <select id="base_msisdn_groups_id" name="base_msisdn_groups_id" class="browser-default custom-select" required>
                                            <option value="">Select Base Msisdn Group</option>
                                            @foreach ($baseMsisdnGroups as $key => $value)
                                                <option value="{{ $value->id }}" {{ isset($campaign) && $campaign->base_msisdn_groups_id == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>

                                    <div id="image-input" class="form-group col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="image_url">Upload Icon </label>
                                            <input type="file" id="image_url" name="icon_image" class="dropify_image" data-height="80" data-allowed-file-extensions="png jpg jpeg gif json" required />
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
                                        <label for="dashboard_card_title" class="required">No of Challenge Days </label>
                                        <input required min="1" max="7" data-validation-required-message="Day is required" value="{{ old('day') }}" type="number" class="form-control" placeholder="Day" name="day">
                                        <small class="text-danger"> @error('day') {{ $message }} @enderror </small>
                                        <div class="help-block"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-2" id="task_pick_type">
                                        <label for="task_pick_type_input" class="required">Task Pick Type: </label>
                                        <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                            <input required type="radio" name="task_pick_type" value="0" id="random">
                                            <label for="random" class="mr-3">Random</label>
                                            <input type="radio" name="task_pick_type" value="1" id="day">
                                            <label for="day" class="mr-3">Day Specific</label>
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
                                                <select class="select22 task-select form-control">
                                                    @foreach($tasks as $task)
                                                        <option value="{{ $task['id'] }}">{{ $task['title'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div id="task_per_day" class="mb-2">
                                            <label for="dashboard_card_title">Task Per Day </label>
                                            <input value="{{ old('task_per_day') }}" type="number" class="form-control" placeholder="Task Per Day" name="task_per_day">
                                        </div>
                                        <div id="random_select2_input">
                                            <table class="table table-bordered display" id="random_task_table"></table>
                                        </div>
                                    </div>

                                    <div class="form-actions col-md-12">
                                        <div class="pull-right">
                                            <button id="save" type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save
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

@push('style')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }

        .width-3 {
            width: 3%;
            cursor: pointer;
            text-align: center;
        }

        .width-10 {
            width: 10%;
        }
    </style>
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
    <script src="{{ asset('app-assets/vendors/js/sortable/sortable.min.js') }}"></script>
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
                    'default': 'Browse for an Image/Json to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image/Json file'
                },
                error: {
                    'imageFormat': 'File must be valid format'
                }
            });

            //$('#task_pick_type').hide();
            $('#task_per_day').hide();
            $('#day_specific_task_table').hide();
            $('#select2_tasks').hide();
            $('#random_select2_input').hide();
            $('input[name=day]').keyup(function(e) {
                task_pick_type = $('input[name="task_pick_type"]:checked').val();
                days = $(event.target).val();
                if ($(event.target).val() > 100) {
                    alert('Max no of day exceed');
                    $(event.target).val('1');
                }
                initializeTable(task_pick_type, days);
            });
            $('input[name=task_per_day]').keyup(function(e) {
                task_pick_type = $('input[name="task_pick_type"]:checked').val();
                initializeTable(task_pick_type, $('input[name=day]').val());
            });
            $('input[name=task_pick_type]').change(function($e) {
                task_pick_type = $('input[name="task_pick_type"]:checked').val();
                days = $('input[name=day]').val();
                if (task_pick_type == "0") {
                    $('#day_specific_task_table').hide();
                    $('#task_per_day').show();
                    $('#random_select2_input').show();
                }
                if (task_pick_type == "1") {
                    $('#random_task_table').hide();
                    $('input[name=task_per_day]').val('0');
                    $('#task_per_day').hide();
                    $('#random_select2_input').hide();
                }
                initializeTable(task_pick_type, days);
            });
            $(".select22").on("select2:select", function(evt) {
                var element = evt.params.data.element;
                var $element = $(element);
                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
            $("#save").click(function(e) {
                if (!$('input[name="task_pick_type"]:checked').val()) {
                    alert('Please Select Task Pick Type');
                    return false;
                }
                if ($('input[name="task_pick_type"]:checked').val() == 0) {
                    if (!$('input[name="task_per_day"]').val()) {
                        alert('Please Select Task Per Day');
                        return false;
                    }
                    validateTaskTable("random_task_select") ? true : (e.preventDefault(), alert('Plesae select random tasks'));
                }
                if ($('input[name="task_pick_type"]:checked').val() == 1) {
                    validateTaskTable("daywise_task_select") ? true : (e.preventDefault(), alert('Plesae select day specific tasks'));
                }
            });
        });

        function initTaskTable(task_pick_type, days, table_id) {
            col = [];
            dataColumns = [];
            columnDefs = [];
            if (task_pick_type == "1") {
                if (days) {
                    for (let i = 0; i < days; i++) {
                        col.push({
                            'day': i + 1,
                            'task': i + 1
                        });
                    }
                }
                dataColumns = [{
                    "title": "Day",
                    "data": "day",
                    "className": "width-3"
                },
                    {
                        "title": "Task",
                        "data": "task"
                    },
                ];
                columnDefs = [{
                    "targets": 1,
                    "data": null,
                    render: function(data, type, row) {
                        var domElement = '<div class="taskInput"></div>';
                        return domElement;
                    },
                }];
            }
            if (task_pick_type == "0") {
                taskPerDay = parseInt($('input[name="task_per_day"]').val());
                if (days) {
                    for (let i = 0; i < days * taskPerDay; i++) {
                        col.push({
                            'day': i + 1,
                            'task': i + 1
                        });
                    }
                }
                dataColumns = [{
                    "title": "*"
                },
                    {
                        "title": "SL",
                        "data": "day",
                        "className": "width-3"
                    },
                    {
                        "title": "Task",
                        "data": "task"
                    },
                ];
                columnDefs = [{
                    "targets": 0,
                    "data": null,
                    "className": "width-3",
                    render: function(data, type, row) {
                        var domElement = '<i class="icon-cursor-move icons"></i>';
                        return domElement;
                    }
                },
                    {
                        "targets": 2,
                        "data": null,
                        render: function(data, type, row) {
                            var domElement = '<div class="taskInput"></div>';
                            return domElement;
                        },
                    }
                ];
            }
            //reset select2 selections
            $('#' + table_id + " .task-select").val('').trigger('change');
            $('#' + table_id).show();
            if (!$.fn.DataTable.isDataTable('#' + table_id)) {
                $('#' + table_id).DataTable({
                    'createdRow': function(row, data, dataIndex) {
                        $(row).attr('data-index', data['day']);
                        $(row).attr('data-position', data['day']);
                    },
                    "bPaginate": false,
                    searching: false,
                    info: false,
                    data: col,
                    columns: dataColumns,
                    columnDefs: columnDefs
                });
            }
            var select2_taskList = $('#select2_input').html();

            $('#' + table_id + ' .taskInput').each(function(e, v) {
                $('#' + table_id + ' .taskInput').eq(e).html(select2_taskList);
                if (task_pick_type == "1") {
                    $('#' + table_id + ' .task-select').eq(e).attr('name', 'day_tasks[' + e + '][]');
                    $('#' + table_id + ' .task-select').eq(e).attr('multiple', 'multiple');
                    $('#' + table_id + ' .task-select').eq(e).select2({
                        placeholder: "Select Tasks"
                    });
                    $('#' + table_id + ' .select22').eq(e).addClass('daywise_task_select');
                    $('#' + table_id + ' .select22').eq(e).on("select2:select", function(evt) {
                        var element = evt.params.data.element;
                        var $element = $(element);
                        $element.detach();
                        $(this).append($element);
                        $(this).trigger("change");
                    });
                } else {
                    $('#' + table_id + ' .task-select').eq(e).attr('name', 'random_tasks[' + e + '][]');
                    $('#' + table_id + ' .task-select').eq(e).select2({
                        placeholder: "Select Tasks"
                    });
                    $('#' + table_id + ' .task-select').eq(e).addClass('random_task_select');
                    //ordering
                    $('#' + table_id).addClass('ordering');
                    $('.ordering').sortable({
                        items: 'tbody tr',
                        stop: function(event, ui) {
                            $("#" + table_id + " .taskInput").each(function(e, v) {
                                $("#" + table_id + " " + ".task-select").eq(e).select2({
                                    placeholder: "Select Tasks"
                                });
                                $("#" + table_id + " tr").addClass('drag-handle');
                                $(`#${table_id} tbody .drag-handle:eq(${e}) td:eq(1)`).html(e + 1);
                                $("#" + table_id + " " + ".task-select").eq(e).attr('name', 'random_tasks[' + e + '][]');
                            });
                        }
                    });
                }
            });
            $('#' + table_id + " .task-select").val('').trigger('change');
        }

        function initializeTable(taskPickType, days) {
            if (taskPickType == "0") {
                if ($.fn.DataTable.isDataTable('#random_task_table')) {
                    $('#random_task_table').DataTable().destroy();
                }
                initTaskTable(taskPickType, days, 'random_task_table');
            }
            if (taskPickType == "1") {
                if ($.fn.DataTable.isDataTable('#day_specific_task_table')) {
                    $('#day_specific_task_table').DataTable().destroy();
                }
                initTaskTable(taskPickType, days, 'day_specific_task_table');
            }
        }

        function validateTaskTable(tableId) {
            let task_errors = [];
            $("." + tableId).each(function(k, v) {
                if (tableId = "daywise_task_select") {
                    if ($(this).val().length == 0) {
                        task_errors.push(0);
                    }
                } else {
                    if (!$(this).val()) {
                        task_errors.push(0);
                    }
                }
            });
            if (task_errors.length > 0) {
                return false;
            }
            return true;
        }
    </script>

@endpush