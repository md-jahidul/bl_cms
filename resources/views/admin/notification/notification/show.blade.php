@extends('layouts.admin')
@section('title', 'Notification')
@section('card_name', 'Notification')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification Send</li>
@endsection
@section('action')
    <a href="{{route('notification.index')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Notification List
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                    <form class="form" method="POST" id="sendNotificationForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control col-md-12" name="title" id="title" value="{{$notification->title}}">
                            <input type="hidden"  name="id" id="id" value="{{$notification->id}}">
                            <input type="hidden"  name="category_id" id="category_id" value="{{$notification->NotificationCategory->id}}">
                            <input type="hidden"  name="category_slug" id="category_slug" value="{{$notification->NotificationCategory->slug}}">
                            <input type="hidden"  name="category_name" id="category_name" value="{{$notification->NotificationCategory->name}}">

                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control col-md-12" name="message" id="message"> {{$notification->body}}</textarea>
                        </div>

                        <div class="form-group">

                            <label for="message">Upload Customer List</label> <a href="{{ asset('sample-format/customers.xlsx')}}" class="text-info ml-2">Download Sample Format</a></br>
                            <input type="file" class="dropify" name="customer_file" data-height="80"
                                   data-allowed-file-extensions="xlsx" required/>

                        </div>

                        <div class="from-group">
                            <input type="checkbox" name="is_scheduled" id="is_scheduled">
                            <label>Notification Schedule</label>
                            <div class='input-group'>
                                <input type='text' disabled
                                       class="form-control datetime"
                                       value="{{ old("display_period") ? old("display_period") : '' }}"
                                       name="schedule_time"
                                       id="schedule_time"/>
                                @if($errors->has('display_period'))
                                    <p class="text-left">
                                        <small class="danger text-muted">{{ $errors->first('display_period') }}</small>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12" >
                            <div class="form-group float-right" style="margin-top:15px; margin-left: 10px;">
                                <input class="btn btn-success" style="width:100%;padding:7.5px 12px" type="submit" name="submit" value="Submit Device" id="submitDevice" onclick="return selectMethord('submitDevice');">
                            </div>
                            <div class="form-group float-right" style="margin-top:15px;">
                                <input class="btn btn-success" style="width:100%;padding:7.5px 12px" type="submit" name="submit" value="Submit" id="submit"  onclick="return selectMethord('submit');">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection


@push('style')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">

    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <style>

        .multiselect-container{
            width: 250px;
        }
        .multiselect-container > li > a > label {
            padding: 3px 5px 3px 10px;
        }
    </style>
@endpush


@push('page-js')

    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>

    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


    <script>

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

        $('#is_scheduled').change(function () {

            if ($(this).is(':checked')) {
                $('#schedule_time').removeAttr('disabled');
            } else {
                $('#schedule_time').attr('disabled', 'true');
            }

            //alert($(this).is(':checked'))
        })


        function selectMethord(buttonId){
            if(buttonId == 'submitDevice'){
                $('#'+buttonId).addClass('e-clicked')
                $("#submit").removeClass('e-clicked');
            }else{
                $('#'+buttonId).addClass('e-clicked')
                $("#submitDevice").removeClass('e-clicked');
            }
            return true;
        }
        $(function () {
            $('#user-multiple-selected').multiselect({
                    includeSelectAllOption: true
                }
            );

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Excel File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

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
                let URL="{{ route('notification.send') }}";
                let formData = new FormData($(this)[0]);
                let clickBtn = $(".e-clicked").val();
                if(clickBtn === "Submit Device" )
                {
                 URL="{{ route('target_wise_notification.send')}}";
                }
                if ($('#is_scheduled').is(':checked')) {
                    URL = "{{route('notification-schedule.send')}}";
                }
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
                                title: 'Notification sent Successfully!',
                                type: 'success',
                                timer: 900000,
                                showConfirmButton: false
                            });

                            window.location.href = '{{route("notification.index")}}';

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
        });

    </script>
@endpush


