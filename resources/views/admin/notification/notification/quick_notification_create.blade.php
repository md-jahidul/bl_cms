@extends('layouts.admin')
@section('title', 'Quick Notification')
@section('card_name', 'Quick Notification')
@section('action')
    <a href="{{route('quick-notification.index')}}" class="btn btn-primary  round btn-glow px-2">
       Quick Notification List
    </a>
@endsection
<?php $scheduleStatus = "inactive"; ?>
@section('content')
<div class="card mb-0 px-1" style="box-shadow:none;">
    <div class="card-content">
        <div class="card-body">
            <form class="form" method="POST" id="sendNotificationForm" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="form-body">
                    <h4 class="form-section"><i class="la la-key"></i>
                        Create Notification
                    </h4>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title" class="required">Title :</label>
                                <input
                                name="title"
                                required
                                maxlength="100"
                                data-validation-required-message="Title is required"
                                data-validation-maxlength-message = "Title can not be more then 100 Characters"

                                style="height:100%" type="text" value="@if(old('title')) {{old('title')}} @endif" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title..">

                                <div class="help-block">
                                    <small class="text-info"> Title can not be more then 100 Characters</small><br>
                                </div>
                                <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id" class="required">
                                    Category :
                                </label>
                                <div class="controls">
                                    <select name="category_id" id="category_id" required class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{ (old("category_id") == $category->id ? "selected":"") }}>{{$category->name}}</option>
                                    @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="device_type" class="required">
                                    Target OS :
                                </label>
                                <div class="controls">
                                    <select name="device_type" id="device_type"  class="form-control" required>
                                    {{-- <option value="">Select OS</option> --}}
                                    <option value="all">All</option>
                                    <option value="ios">IOS</option>
                                    <option value="android">Android</option>
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('device_type') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customer_type" class="required">
                                    Customer type :
                                </label>
                                <div class="controls">
                                    <select name="customer_type" id="customer_type" required class="form-control">
                                    {{-- <option value="">Select Customer Type</option> --}}
                                    <option value="all">All</option>
                                    <option value="prepaid">Prepaid</option>
                                    <option value="postpaid">Postpaid</option>
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('customer_type') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>

{{-- ================================================= --}}


                        <div class="col-md-4" id="action_div">
                            @php
                                $actionList = Helper::navigationActionList();
                            @endphp

                            <div class="form-group">
                                <label class="required">Navigate Action : </label>
                                <select name="navigate_action" class="browser-default custom-select"
                                        id="navigate_action" required>
                                    <option value="">Select Action</option>
                                    @foreach ($actionList as $key => $value)
                                        <option
                                            @if(isset($short_cut_info->component_identifier) && $short_cut_info->component_identifier == $key)
                                            selected
                                            @endif
                                            value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div id="append_div" class="col-md-4">
                            @if(isset($short_cut_info))
                                @if($info = json_decode($short_cut_info->other_info))
                                    <div class="form-group other-info-div">
                                        <label>@if($short_cut_info->component_identifier == "DIAL") Dial Number @else
                                                Redirect
                                                URL @endif </label>
                                        <input type="text" name="external_url" class="form-control" required
                                            value="@if($info) {{$info->content}} @endif">
                                        <div class="help-block"></div>
                                    </div>
                                @endif
                            @endif
                        </div>
{{-- ========================================================= --}}
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-12 d-inline"> --}}

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="image">Upload image :</label>
                                        <input type="file"
                                            id="icon"
                                            name="image"
                                            class="dropify"
                                            {{-- data-allowed-formats="square" --}}
                                            data-allowed-file-extensions="jpeg png jpg"
                                            {{-- data-height="70" --}}
                                            />
                                    <div class="help-block">
                                        <small class="text-danger"> @error('image') {{ $message }} @enderror </small>
                                        {{-- <small class="text-info"> Shortcut icon should be in 1:1 aspect ratio</small> --}}
                                    </div>
                                    <small id="massage"></small>
                                </div>
                            </div>

                            <div class="col-md-7">
                            <div class="form-group">
                                <label for="body" class="required">Body :</label>
                                <textarea
                                required
                                data-validation-required-message="Title is required"
                                class="form-control @error('body') is-invalid @enderror" placeholder="Enter body description....." id="body" name="body" rows="10">@if(old('body')){{old('body')}}@endif</textarea>
                                <div class="help-block"></div>
                                <small class="text-danger"> @error('body') {{ $message }} @enderror </small>
                            </div>
                            </div>

                        {{-- </div> --}}

                        <div class="form-group col-md-12">
                            <label for="message">Upload Customer List</label> <a href="{{ asset('sample-format/customers.xlsx')}}" class="text-info ml-2">Download Sample Format</a></br>
                            <input type="file" class="dropify" name="customer_file" data-height="80"
                                data-allowed-file-extensions="xlsx" required/>
                        </div>
                        <div class="from-group col-md-12">
                            <input type="checkbox" name="is_scheduled" id="is_scheduled"
                                {{ $scheduleStatus == 'active' ? 'checked' : '' }}>
                            <label>Notification Schedule</label>
                            {{ $scheduleStatus == 'active' ? \Carbon\Carbon::parse($schedule->start)->format('Y/m/d h:i A') . ' - ' . \Carbon\Carbon::parse($schedule->end)->format('Y/m/d h:i A') : '' }}
                            <div class='input-group'>
                                <input type='text' {{ $scheduleStatus == 'active' ? '' : 'disabled' }}
                                    class="form-control datetime"
                                    value="{{ old('display_period') ?? "" }}"
                                    name="schedule_time"
                                    id="schedule_time"/>
                                @if($errors->has('display_period'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('display_period') }}</small>
                                    </p>
                                @endif
                            </div>
                            <br>
                        </div>

                        <div class="col-md-6">
                            <input type="hidden" name="type" id="save_type" value="only_save">
                            <div style="display: flex">
                                <input class="btn btn-success" style="width:25%;padding:7.5px 12px; border-radius: 20px; margin-right: 10px;" type="submit" name="submit" value="Save & Submit" id="submit"  onclick="return selectMethord('submit');">
                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>

    <script>

        var auto_save_url = "{{ url('shortcuts-sortable') }}";

        $(function () {

            var date;
            // Date & Time
            date = new Date();
            date.setDate(date.getDate());
            $('.datetime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 1,
                minDate: date,
                locale: {
                    format: 'YYYY/MM/DD h:mm A'
                }
            });

           var content = "";
           var dial_content = "";
           var purchase_content = "";
            var url_html;
            var parse_data;
            let dial_html, other_info = '';


            $('.delete').click(function () {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('shortcuts/destroy') }}/" + id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)

                                function redirect() {
                                    window.location.href = "{{ url('shortcuts/') }}"
                                }
                            }
                        })
                    }
                })
            })

            dial_html = ` <div class="form-group other-info-div">
                                        <label>Dial Number</label>
                                        <input type="text" name="other_attributes" class="form-control" value="${dial_content}" placeholder="Enter Valid Number" required>
                                        <div class="help-block"></div>
                                    </div>`;



            product_html = ` <div class="form-group other-info-div">
                                        <label>Select a product</label>
                                        <select class="product-list form-control" name="external_url">
                                            <option value="${purchase_content}" selected="selected">${purchase_content}</option>
                                         </select>
                                        <div class="help-block"></div>
                                    </div>`;

            url_html = ` <div class="form-group other-info-div">
                                        <label>Redirect External URL</label>
                                        <input type="text" name="external_url" class="form-control" value="${content}" placeholder="Enter Valid URL" required>
                                        <div class="help-block"></div>
                                    </div>`;

            $('#navigate_action').on('change', function () {
                let action = $(this).val();
                if (action == 'DIAL') {
                    $("#append_div").html(dial_html);
                }else if(action == 'URL') {
                    $("#append_div").html(url_html);
                } else if (action == 'PURCHASE') {
                    $("#append_div").html(product_html);
                    $(".product-list").select2({
                        placeholder: "Select a product",
                        minimumInputLength:3,
                        allowClear: true,
                        selectOnClose:true,
                        ajax: {
                            url: "{{ route('notification.productlist.dropdown') }}",
                            dataType: 'json',
                            data: function (params) {
                            var query = {
                                productCode: params.term
                            }
                            // Query parameters will be ?search=[term]&type=public
                            return query;
                            },
                            processResults: function (data) {
                                // Transforms the top-level key of the response object from 'items' to 'results'
                                return {
                                    results: data
                                };
                            }
                        }
                    });
                }  else {
                    $(".other-info-div").remove();
                }
            });
        });
      $(function () {
            $('.delete').click(function () {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('setting/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('setting/') }}"
                                }
                            }
                        })
                    }
                })
            })
        });

        function quickSend() {
            let flag = $('#quick_notification_send').val();

            if(flag == "true") {
                $('#quick_notification_send').val("false");
                $('#submit').val("Save & Send");
                $('#save_type').val("send_notification");
            } else {
                $('#submit').val("Save");
                $('#quick_notification_send').val("true");
                $('#save_type').val("only_save");
            }

            console.log($('#save_type').val);
        }
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an image to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct image file'
                },
                error: {
                    'imageFormat': 'The image ratio must be 1:1.'
                }
            });
        });

        var date;
        // Date & Time
        date = new Date();
        date.setDate(date.getDate());
        $('.datetime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 5,
            startDate: '{{$scheduleStatus == 'active' ? $schedule->start : date('Y-m-d H:i:s')}}',
            endDate: '{{$scheduleStatus == 'active' ? $schedule->end : date('Y-m-d H:i:s', strtotime('+ 6 hours'))}}',
            minDate: date,
            locale: {
                format: 'YYYY/MM/DD h:mm A'
            }
        });

        $('#is_scheduled').change(function () {

            if ($(this).is(':checked')) {
                $('#schedule_time').removeAttr('disabled');
            } else {
                $('#schedule_time').attr('disabled', 'true');
            }

            //alert($(this).is(':checked'))
        })
            /* file handled  */
        $('#sendNotificationForm').submit(function (e) {

            e.preventDefault();
            swal.fire({
                title: 'Data Uploading.Please Wait ...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            let URL="{{ route('quick-notification.store') }}";
            let formData = new FormData($(this)[0]);

            $.ajax({
                url: URL,
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (result) {

                    if (result.success) {
                        swal.fire({
                            title: result.message,
                            type: 'success',
                            timer: 900000,
                            showConfirmButton: false
                        });
                        
                        window.location.href = '{{route("quick-notification.index")}}';

                    } else {
                        swal.close();
                        swal.fire({
                            title: result.message,
                            type: 'error',
                        });
                    }

                },
                error: function (data) {
                    console.log(data);
                    swal.fire({
                        title: 'Failed to send Notifications',
                        type: 'error',
                    });
                }
            });

        });

    </script>

@endpush
