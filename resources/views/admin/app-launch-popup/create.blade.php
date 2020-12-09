@extends('layouts.admin')
@section('title', 'App Launch Popup')
@section('card_name', 'App Launch Popup | Create')

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
                        <form role="form"
                              action="{{ route('app-launch.store')}}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group @if($errors->has('title')) error @endif">
                                        <label for="title" class="required">Title</label>
                                        <input class="form-control"
                                               name="title"
                                               id="title"
                                               value="{{ old("title") ? old("title") : '' }}"
                                               required>
                                        @if($errors->has('title'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type" class="required">Popup Type</label>
                                        <select id="type" name="type" class="form-control" required>
                                            <option value="image">Image </option>
                                            <option value="html">HTML Content</option>
                                            <option value="purchase">Purchase </option>
                                        </select>
                                        @if($errors->has('type'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('type') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4 hidden" id="productCode">
                                    {{-- <div class="form-group " >
                                        <label for="type" class="required col-md-12" style="padding:0px">Product Code</label>
                                        {!!Form::select('product_code',$productList, null, ['class' => 'form-control select2 col-md-12'])!!}
                                        @if($errors->has('product_code'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('product_code') }}</small>
                                            </p>
                                        @endif
                                    </div> --}}
                                </div>
                                {{--                                <div class="col-md-4">--}}
                                {{--                                    --}}
                                {{--                                </div>--}}

                            </div>

                            <div class="row">
                                <div class="col-md-8" id="content_div">
                                    <div class="form-group">
                                        <label class="required">Image</label>
                                        <input type="file"
                                               required
                                               name="content_data"
                                               data-max-file-size="2M"
                                               data-allowed-formats="portrait square"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               class="dropify"/>
                                    </div>
                                    @if($errors->has('content_div'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('content_div') }}</small>
                                        </p>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Recurring Schedule<span class="red">*</span></label>

                                    <div class="skin skin-flat">
                                        <ul class="list list-inline">
                                            <li class="list-inline-item">
                                                <input type="radio" name="recurring_type" value="none" checked>
                                                <label class="small">None</label>
                                            </li>
                                            <li class="list-inline-item">
                                                <input type="radio" name="recurring_type" value="daily">
                                                <label class="small">Daily</label>
                                            </li>
                                            <li class="list-inline-item">
                                                <input type="radio" name="recurring_type" value="weekly">
                                                <label class="small">Weekly</label>
                                            </li>
                                            <li class="list-inline-item">
                                                <input type="radio" name="recurring_type" value="monthly">
                                                <label class="small">Monthly</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Recurring type none (Regular time period) -->
                                    <div class="form-group" id="time_period">
                                        <label class="small">Time Period</label>
                                        <div class='input-group'>
                                            <input type='text'
                                                   class="form-control datetime"
                                                   value="{{ old("display_period") ? old("display_period") : '' }}"
                                                   name="display_period"
                                                   id="display_period"/>
                                            @if($errors->has('display_period'))
                                                <p class="text-left">
                                                    <small class="danger text-muted">{{ $errors->first('display_period') }}</small>
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group" id="time_slot">
                                        <select class="form-control" id="time_range" multiple>
                                            <option value=""></option>
                                            @foreach($hourSlots as $slot)
                                                <option value="{{$slot}}">{{$slot}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Weekday Picker -->
                                    <div class="weekDays-selector" id="weekday_selector">
                                        <input name="weekdays[]" type="checkbox" id="weekday-mon" class="weekday" />
                                        <label  for="weekday-mon">MO</label>
                                        <input name="weekdays[]" type="checkbox" id="weekday-tue" class="weekday" />
                                        <label for="weekday-tue">TU</label>
                                        <input name="weekdays[]" type="checkbox" id="weekday-wed" class="weekday" />
                                        <label for="weekday-wed">WE</label>
                                        <input name="weekdays[]" type="checkbox" id="weekday-thu" class="weekday" />
                                        <label for="weekday-thu">TH</label>
                                        <input name="weekdays[]" type="checkbox" id="weekday-fri" class="weekday" />
                                        <label for="weekday-fri">FR</label>
                                        <input name="weekdays[]" type="checkbox" id="weekday-sat" class="weekday" />
                                        <label for="weekday-sat">SA</label>
                                        <input name="weekdays[]" type="checkbox" id="weekday-sun" class="weekday" />
                                        <label for="weekday-sun">SU</label>
                                    </div>

                                    <div class="form-group" id="dates">
                                        <select name="month_dates" id="month_dates" class="form-control" multiple>
                                            @for($i = 1; $i < 32; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
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
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    {{--    <script src="{{ asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>--}}
    {{--    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script>

        $(function () {
            var date;
            // Date & Time
            date = new Date();
            date.setDate(date.getDate());
            $('.datetime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                minDate: date,
                locale: {
                    format: 'YYYY/MM/DD h:mm A'
                }
            });

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
                    height: 300
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
                }else if(action == 'purchase'){
                    initiatePurchaseImage();
                    $(".select2").css({"min-width": "250px"});
                    $('#productCode').removeClass('hidden').addClass('show');
                    $("#productCode").html(product_html);
                    $(".product-list").select2({
                        placeholder: "Select a product",
                        ajax: {
                            url: "{{ route('myblslider.active-products') }}",
                            processResults: function (data) {
                                // Transforms the top-level key of the response object from 'items' to 'results'
                                return {
                                    results: data
                                };
                            }
                        }
                    });
                } else {
                    initiateTextEditor();
                    $('#productCode').removeClass('show').addClass('hidden');
                }
            });

            $('#select2').select2({
                placeholder: "Please select a product code"
            });

            $("#month_dates").select2({
                placeholder: 'Choose dates of month'
            });

            $("#time_range").select2({
                placeholder: 'Choose time slots'
            });

        })
    </script>
@endpush







