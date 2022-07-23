@extends('layouts.admin')
@section('title', 'App Launch Popup')
@section('card_name', 'App Launch Popup | ' . ucwords($page))

@section('action')
    <a href="{{ route('app-launch.index') }}" class="btn btn-info btn-sm btn-glow px-2">
        Back to List
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" method="POST" class="form" enctype="multipart/form-data"
                              action="{{ $page == 'create' ? route('app-launch.store') : route('app-launch.update', $popup->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type" class="required">Popup Type</label>
                                        @php
                                            $types = [
                                                'image' => 'Image',
                                                'html' => 'HTML Content',
                                                'purchase' => 'Purchase',
                                                'campaign' => 'Campaign'
                                            ];
                                        @endphp
                                        {{ Form::select('type', $types, $page == 'edit' ? $popup->type : old('type'),
                                            ['class' => 'form-control', 'required', 'id' => 'type']) }}
                                        @if($errors->has('type'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('type') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 {{($page == 'edit' && $popup->type == 'purchase') ? '' : 'hidden'}}"
                                     id="productCode">
                                    <div class="form-group ">
                                        <label for="type" class="required col-md-12" style="padding:0px">
                                            Product Code
                                        </label>
                                        <select name="product_code" class="form-control select2 col-md-12">
                                            @if($page == 'edit' && $popup->type == 'purchase')
                                                @foreach($productList as $product)
                                                    <option value="{{$product['id']}}"
                                                        {{$product['id'] == $popup->product_code ? 'selected' : ''}}>
                                                        {{$product['id'] . ' - ' . $product['text']}}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value=""></option>
                                                @foreach($productList as $product)
                                                    <option value="{{$product['id']}}">{{$product['id'] . ' - ' .$product['text']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if($errors->has('product_code'))
                                            <p class="text-left">
                                                <small
                                                    class="danger text-muted">{{ $errors->first('product_code') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 {{($page == 'edit' && $popup->type == 'image') ? '' : 'hidden'}}" id="externalURL">
                                    <div class="form-group">
                                        <label for="external_url" class="required col-md-12" style="padding:0px">External URL</label>
                                        <input class="form-control" name="other_info[external_url]" id="external_url"
                                               value="{{ $page == 'edit' && isset($popup->other_info['external_url']) ? $popup->other_info['external_url'] : old("external_url") }}"
                                               placeholder="Enter valid external URL">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @if($errors->has('title')) error @endif">
                                        <label for="title" class="required">Title English</label>
                                        <input class="form-control" name="title" id="title" maxlength="20"
                                               placeholder="Enter title in English"
                                               value="{{ $page == 'edit' ? $popup->title : old("title") }}" required>
                                        @if($errors->has('title'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @if($errors->has('title')) error @endif">
                                        <label for="title" class="required">Title Bangla</label>
                                        <input class="form-control" name="title_bn" id="title_bn" maxlength="20"
                                               placeholder="Enter title in Bangla"
                                               value="{{ $page == 'edit' ? $popup->title_bn : old("title_bn") }}">
                                        @if($errors->has('title'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" id="content_div">
                                    <div class="form-group">
                                        <label class="required">Image</label>
                                        <input type="file"
                                               name="content_data"
                                               data-max-file-size="2M"
                                               data-allowed-formats="portrait square"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               @if($page == 'edit')
                                                   data-default-file="{{ url('storage/' .$popup->content) }}"
                                               @else
                                                   required
                                               @endif
                                               class="dropify"/>
                                    </div>
                                    @if($errors->has('content_div'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('content_div') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-6" id="content_div">
                                    <div class="form-group">
                                        <label class="required">Thumbnail Image</label>
                                        <input type="file"
                                               name="thumbnail_img"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               @if($page == 'edit')
                                                   data-default-file="{{ url('storage/' .$popup->thumbnail) }}"
                                               @else
                                               @endif
                                               data-min-width="1279" data-min-height="719"
                                               data-max-width="1281" data-min-height="721"
                                               data-allowed-file-extensions="png jpg jpeg gif"
                                               class="dropify"/>
                                    </div>
                                    <div class="help-block"></div>
                                    <div class="help-block text-warning">
                                        The Dimensions should be <strong>1280x720</strong>
                                    </div>
                                    @if($errors->has('content_div'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('content_div') }}</small>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <!-- Recurring schedule -->
                                <div class="col-md-4">
                                    <label class="form-label">Recurring Schedule<span class="red">*</span></label>
                                    @php
                                        $recurringType = isset($popup) ? $popup->recurring_type : 'none';
                                    @endphp
                                    <div class="">
                                        <ul class="list list-inline">
                                            <li class="list-inline-item">
                                                <input type="radio" name="recurring_type" id="none" value="none"
                                                    {{$recurringType == 'none' ? 'checked' : ''}}>
                                                <label for="none" class="small">None</label>
                                            </li>
                                            <li class="list-inline-item">
                                                <input id="daily" type="radio" name="recurring_type" value="daily"
                                                    {{$recurringType == 'daily' ? 'checked' : ''}}>
                                                <label for="daily" class="small">Daily</label>
                                            </li>
                                            <li class="list-inline-item">
                                                <input id="weekly" type="radio" name="recurring_type" value="weekly"
                                                    {{$recurringType == 'weekly' ? 'checked' : ''}}>
                                                <label for="weekly" class="small">Weekly</label>
                                            </li>
                                            <li class="list-inline-item">
                                                <input id="monthly" type="radio" name="recurring_type" value="monthly"
                                                    {{$recurringType == 'monthly' ? 'checked' : ''}}>
                                                <label for="monthly" class="small">Monthly</label>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="row">
                                        <!-- Regular time period (When recurring type is none) -->
                                        <div class="col-md-12">
                                            <div class="form-group" id="time_period">
                                                <label class="small">Date Range</label>
                                                <div class='input-group'>
                                                    <input type='text'
                                                           class="form-control datetime"
                                                           value="{{ $page == 'edit' ? $dateRange : old('display_period') }}"
                                                           name="display_period"
                                                           id="display_period"/>
                                                    @if($errors->has('display_period'))
                                                        <p class="text-left">
                                                            <small class="danger text-muted">
                                                                {{ $errors->first('display_period') }}
                                                            </small>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Weekday Picker -->
                                        <div class="col-md-12">
                                            @php
                                                $weekdays = isset($popup) ? explode(',', optional($popup->schedule)->weekdays) ?? [] : [];
                                            @endphp

                                            <div class="weekDays-selector" id="weekday_selector"
                                                 @if($recurringType != 'weekly')
                                                 style="display: none"
                                                @endif>
                                                <input name="weekdays[]" value="sun" type="checkbox" id="weekday-sun"
                                                       class="weekday" {{in_array('sun', $weekdays) ? 'checked' : ''}}/>
                                                <label for="weekday-sun">SU</label>
                                                <input name="weekdays[]" value="mon" type="checkbox" id="weekday-mon"
                                                       {{in_array('mon', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                <label for="weekday-mon">MO</label>
                                                <input name="weekdays[]" value="tue" type="checkbox" id="weekday-tue"
                                                       {{in_array('tue', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                <label for="weekday-tue">TU</label>
                                                <input name="weekdays[]" value="wed" type="checkbox" id="weekday-wed"
                                                       {{in_array('wed', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                <label for="weekday-wed">WE</label>
                                                <input name="weekdays[]" value="thu" type="checkbox" id="weekday-thu"
                                                       {{in_array('thu', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                <label for="weekday-thu">TH</label>
                                                <input name="weekdays[]" value="fri" type="checkbox" id="weekday-fri"
                                                       {{in_array('fri', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                <label for="weekday-fri">FR</label>
                                                <input name="weekdays[]" value="sat" type="checkbox" id="weekday-sat"
                                                       {{in_array('sat', $weekdays) ? 'checked' : ''}} class="weekday"/>
                                                <label for="weekday-sat">SA</label>
                                            </div>
                                            <br>
                                        </div>

                                        <!-- Month dates selector -->
                                        <div class="col-md-12" id="dates"
                                             @if($recurringType != 'monthly')
                                             style="display: none"
                                            @endif>
                                            <div class="form-group">
                                                @php
                                                    $dates = isset($popup) ? explode(',', optional($popup->schedule)->month_dates) ?? [] : [];
                                                @endphp
                                                <select name="month_dates[]" id="month_dates" class="form-control"
                                                        multiple>
                                                    @for($i = 1; $i < 32; $i++)
                                                        <option
                                                            value="{{$i}}" {{in_array($i, $dates) ? 'selected' : ''}}>
                                                            {{$i}}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Time slot/hour selector -->
                                        <div class="col-md-12" id="time_slot"
                                             @if($recurringType == 'none')
                                             style="display: none"
                                            @endif>
                                            <div class="form-group">
                                                @php
                                                    $slots = isset($popup) ? $popup->timeSlots->each(function ($item) {
                                                        return $item->slot = date('h:i A', strtotime($item->start_time))
                                                        . ' - ' . date('h:i A', strtotime($item->end_time));
                                                        })->pluck('slot')->toArray() ?? [] : [];
                                                @endphp
                                                <select class="form-control" name="time_ranges[]" id="time_range"
                                                        multiple>
                                                    <option value=""></option>
                                                    @foreach($hourSlots as $slot)
                                                        <option
                                                            value="{{$slot}}" {{in_array($slot, $slots) ? 'selected' : ''}}>
                                                            {{$slot}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-2">
                                    <div class="form-group skin skin-flat">
                                        <label class="control-label required">Connection Type</label>
                                        @php
                                            $connectionType = isset($popup) ? $popup->connection_type : 'all';
                                        @endphp
                                        <ul class="list list-group">
                                            <li class="list-inline-item">
                                                <input type="radio" name="connection_type" value="all"
                                                    {{$connectionType == 'all' ? 'checked' : ''}}>
                                                <label class="control-label small">All</label>
                                            </li>
                                            <li class="list-inline-item">
                                                <input type="radio" name="connection_type" value="prepaid"
                                                    {{$connectionType == 'prepaid' ? 'checked' : ''}}>
                                                <label class="control-label small">Prepaid</label>
                                            </li>
                                            <li class="list-inline-item">
                                                <input type="radio" name="connection_type" value="postpaid"
                                                    {{$connectionType == 'postpaid' ? 'checked' : ''}}>
                                                <label class="control-label small">Postpaid</label>
                                            </li>
                                        </ul>
                                    </div>
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
    {{--    <script src="{{ asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>--}}
    {{--    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script>
        var date;
        // Date & Time
        date = new Date();
        date.setDate(date.getDate());

        $('input[name=recurring_type]').change(function () {
           pickerFormat();
        });

        $('input[name=recurring_type]').ready(function () {
            pickerFormat();
        })

        function pickerFormat()
        {
            recurringType = $('input[name=recurring_type]:checked').val();
            let page = "{{$page}}";
            if (page == 'edit') {
                    let startTime = "{{$popup->start_time ?? ""}}";
                    date = new Date(Date.parse(startTime));
                }
            if (recurringType != 'none') {
                $('.datetime').daterangepicker({
                    timePicker: false,
                    minDate: date,
                    locale: {
                        format: 'YYYY/MM/DD'
                    }
                });
            } else {
                $('.datetime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 5,
                    minDate: date,
                    locale: {
                        format: 'YYYY/MM/DD hh:mm A'
                    }
                });
            }
        }

        $(function () {

            function initiateDropify(selector) {
                $(selector).dropify({
                    messages: {
                        'default': 'Browse for an Image to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct Image file'
                    }
                });
            }

            function initiateSummernote(selector) {
                $(selector).summernote({
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['table', ['table']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen']]
                    ],
                    height: 140
                });
            }

            function initiateImage() {
                let html = `<div class="form-group">
                                 <label class="required">Image</label>
                                 <input type="file"
                                               required
                                               name="content_data"
                                               data-max-file-size="2M"
                                               data-allowed-formats="portrait square"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               class="dropify"/>
                              </div>`;
                $("#content_div").html(html);
                initiateDropify('.dropify');
            }

            function initiatePurchaseImage() {
                let html = `<div class="form-group">
                                 <label class="required">Image</label>
                                 <input type="file"
                                               required
                                               name="content_data"
                                               data-allowed-formats="portrait square landscape"
                                               data-max-file-size="2M"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               class="dropify"/>
                              </div>`;
                $("#content_div").html(html);
                initiateDropify('.dropify');
            }

            function initiateTextEditor() {
                let html = `<div class="form-group">
                                    <label for="html_content" class="required">Content</label>
                                    <textarea id="html_content" name="content_data" required></textarea>
                             </div>`;
                $("#content_div").html(html);

                initiateSummernote('#html_content');
            }

            initiateDropify('.dropify');

            product_html = ` <div class="form-group other-info-div">
                                        <label>Select a product</label>
                                        <select class="product-list form-control"  name="product_code" required></select>
                                        <div class="help-block"></div>
                                    </div>`;

            $('#type').on('change', function () {
                let action = $(this).val();
                if (action == 'image') {
                    initiateImage();
                    $('#productCode').removeClass('show').addClass('hidden');
                    $('#externalURL').removeClass('hidden').addClass('show');
                } else if (action == 'campaign') {
                    initiateImage();
                    $('#externalURL').removeClass('hidden').addClass('show');
                    $('#productCode').removeClass('show').addClass('hidden');
                } else if (action == 'purchase') {
                    initiatePurchaseImage();
                    $(".select2").css({"min-width": "400px"});
                    $('#externalURL').removeClass('show').addClass('hidden');
                    $('#productCode').removeClass('hidden').addClass('show');
                    {{--$("#productCode").html(product_html);--}}
                    {{--$(".product-list").select2({--}}
                    {{--    placeholder: "Select a product",--}}
                    {{--    ajax: {--}}
                    {{--        url: "{{ route('myblslider.active-products') }}",--}}
                    {{--        processResults: function (data) {--}}
                    {{--            // Transforms the top-level key of the response object from 'items' to 'results'--}}
                    {{--            return {--}}
                    {{--                results: data--}}
                    {{--            };--}}
                    {{--        }--}}
                    {{--    }--}}
                    {{--});--}}
                } else {
                    initiateTextEditor();
                    $('#externalURL').removeClass('show').addClass('hidden');
                    $('#productCode').removeClass('show').addClass('hidden');
                }
            });

            $('#select2').select2({
                placeholder: "Please select a product code"
            });

            $("#month_dates").select2({
                placeholder: 'Choose dates'
            });

            $("#time_range").select2({
                placeholder: 'Time slots'
            });

            $('.form').submit(function () {
                if ($('input[name=recurring_type]:checked').val() != 'none') {
                    let dateRange = $('#display_period').val().split("-");
                    var start = dateRange[0] + ' 12:00 AM';
                    var end = dateRange[1] + ' 11:59 PM';
                    $('#display_period').val(start + ' - ' + end);
                }
            });
        })
    </script>
@endpush







