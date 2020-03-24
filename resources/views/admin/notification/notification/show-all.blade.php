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

                    <form class="form" method="POST" {{--action="{{route('notification.send')}}"--}} id="sendNotificationForm" enctype="multipart/form-data">
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

                        {{--<div class="form-group">
                        <label for="message">Select Type</label> </br>
                        <select id="user-multiple-selected" name="user_phone[]" multiple="multiple" style="width: auto">
                            @foreach ($users as $user)
                                <option value="{{$user->phone}}">{{$user->phone}}({{$user->name}})</option>
                            @endforeach
                        </select>
                            <label class="radio-inline"><input type="radio" name="optradio" checked>Option 1</label>
                            <label class="radio-inline"><input type="radio" name="optradio">Option 2</label>
                        </div>--}}

                        <div class="form-group">
                            <div class="form-group {{ $errors->has('is_active') ? ' error' : '' }}">
                                <label for="is_active" style="margin-right: 10px; padding: 5px" >Select Type</label>
                                <input type="radio" name="is_active" value="1" id="input-radio-15"  checked>
                                <label for="input-radio-15" class="mr-1">All</label>
                                <input type="radio" name="is_active" value="0" id="input-radio-16">
                                <label for="input-radio-16">Individual</label>
                                @if ($errors->has('is_active'))
                                    <div class="help-block">  {{ $errors->first('is_active') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label id="numbers" for="numbers">Customer mobile number</label>
                            <textarea class="form-control col-md-12" name="ta_numbers" id="ta_numbers"></textarea>
                        </div>


                        <div class="col-md-12" >
                            <div class="form-group float-right" style="margin-top:15px;">
                                <button class="btn btn-success" style="width:100%;padding:7.5px 12px" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection




@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
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
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


    <script>

        $("#numbers").hide();
        $("#ta_numbers").hide();

        $("input[type='radio'][name='is_active']").click(function() {
            if( $(this).attr("value") == "0" ) {
                $("#numbers").show();
                $("#ta_numbers").show();
            }
            else {
                $("#numbers").hide();
                $("#ta_numbers").hide();
            }
        });

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

                let formData = new FormData($(this)[0]);

                $.ajax({
                    url: '{{ route('notification.send')}}',
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
                                timer: 2000,
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


